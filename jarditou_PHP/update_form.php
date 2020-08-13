<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Page de modification";
    //donne la position de la page dans le menu du header
    $nav = 2;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<?php
    //Inclusion d'un fonction de connexion à la base de donnéee
    require("connexion_bdd.php");

    //Appel de la fonction de connexion
    $db = connexionBase();
    //Récupération de l'ID produit passé en GET
    $pro_id = $_GET["id"];
    //Ecriture de la requète à envoyer à la base de donnée
    $requete = "SELECT * FROM produits WHERE pro_id=".$pro_id;

    //Envoie de la requète à la base
    $result = $db->query($requete);

    //Gestion d'erreurs si la requète pose problème
    if (!$result)
    {
        $tableauErreurs = $db->errorInfo();
        echo $tableauErreur[2];
        die("Erreur dans la requête");
    }

    //Gestion si le résultat de la requète est vide
    if ($result->rowCount() == 0)
    {
        echo "L'ID ".$_GET["id"]." ne correspond à aucun produit de la base";
    }
    else
    {
        //Récupération en objet du produit demandé en requète
        $produit = $result->fetch(PDO::FETCH_OBJ);
        //Fermeture du curseur sur le résultat
        $result->closeCursor();
        
        ////On veut récupérer les noms des différentes catégories disponible dans la base
        //Ecriture de la requète à envoyer à la base de donnée
        $requeteCat = "SELECT cat_id, cat_nom FROM categories ORDER by cat_id";

        //Envoie de la requète à la base
        $result = $db->query($requeteCat);

        //Gestion d'erreurs si la requète pose problème
        if (!$result)
        {
            $tableauErreurs = $db->errorInfo();
            echo $tableauErreur[2];
            die("Erreur dans la requête");
        }

        //Gestion si le résultat de la requète est vide
        if ($result->rowCount() == 0)
        {
            die("Il n'existe plus aucune catégorie dans la base");
        }

        //Création d'un tableau pour enregistrer les catégories
        $cats = array();
        //Sa première case gèrera le champ select par défaut
        $cats["0"] = "Sélectionnez une catégorie";
        //Récupération en objet d'une entrée du résultat par tour de boucle
        while ($row = $result->fetch(PDO::FETCH_OBJ))
        {
            //Les clés du tableau seront les ID de la catégorie (on le met en chaine de caracère dans le cas où des ID ont été supprimés), on rempli la case par le nom de la catégorie
            $cats["".$row->cat_id] = $row->cat_nom;
        }
        //Fermeture du curseur sur les résultats
        $result->closeCursor();
        //Ferme la connexion vers la base de donnée
        $db = null;

        //Pour facilité l'affichage du bouton radio de bloqcage de vente, on assigne un booléen en fonction de la valeur dans la base
        if ($produit->pro_bloque == null)
        {
            $block = false;
        }
        else
        {
            $block = true;
        }
    ?>

    <!-- l'entête de notre formulaire contiendra l'image du produit -->
    <div class="row mx-0 mb-1">
        <div class="col-4"></div>
        <div class="col-4">
            <!-- On crée une balise image avec l'adresse préremplie, à laquelle on ajoute le ID produit et l'extension photo trouvés donnés par la base -->
            <?php echo "<img class='img-fluid' src='src/img/".$produit->pro_id.".".$produit->pro_photo."' alt='".$produit->pro_libelle." ".$produit->pro_couleur."'>"; ?>
        </div>
        <div class="col-4"></div>
    </div>

    <!-- On crée un formulaire -->
    <!-- Tout les champs ont leurs value remplie avec les valeurs obtenues dans la base -->
    <!-- Le formulaire enverra les données en POST sur le script update_script.php qui changera les valeurs produits dans la base -->
    <!-- On utilise la class was-validated de Bootstrap pour mettre les champs en rouge  quand ils ne respectent pas le pattern et le required -->
    <!-- Avec was-validated, Bootstrap a la class invalid-feedback qui ne s'affiche que quand le champ est incorrect, on l'utilise ici pour guider l'utilisateur sur comment remplir le champ -->
    <!-- Pour éviter les petits malins qui bidouillent aux pattern et required, un JavaScript fait aussi la vérification et les données sont revérifiés au début de update_script.php -->
    <form action="update_script.php" method="POST" class="was-validated" id="theform" validate>

        <!-- Champ ID du produit -->
        <!-- Pourquoi, il y a un champ text et un champ hidden ? Un champ disabled, ne s'envoie pas par POST, du coup on utilise le champ text pour l'affichage et celui hidden pour envoyer la valeur -->
        <div class="form-group">
            <label for="id">ID :</label>
            <input type="text" class="form-control" placeholder="L'ID sera donné automatiquement à l'enregistrement" disabled value="<?php echo $produit->pro_id; ?>">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $produit->pro_id; ?>">
        </div>

        <!-- Champ Référence -->
        <div class="form-group">
            <label for="ref">Référence :</label>
            <!-- L'Expression Régulière respecte la structure de la base de donnée, la référence est une valeur obligatoire de 10 caractères au plus -->
            <input type="text" class="form-control" name="ref" id="ref" placeholder="Exemple : Produit4" pattern="[\w\-]{1,10}" required value="<?php echo $produit->pro_ref; ?>">
            <div class="invalid-feedback">La Référence doit faire entre 1 et 10 caractères, sans accents et ne comporte pas d'espace (chiffres et tirets sont acceptés).</div>
        </div>

        <!-- Champ Catégorie -->
        <div class="form-group">
            <label for="cat">Catégorie :</label>
            <select class="form-control" name="cat" id="cat" required>
                <?php
                    //Pour Catégorie, on fait une boucle qui crée une entrée du Selec par catégorie
                    foreach($cats as $i => $kitten)
                    {
                ?>
                        <option 
                        <?php
                        //Cas de la case défaut qui sera disabled
                        if ($i == "0")
                        {
                            echo "disabled ";
                        }
                        //Cas de la catégorie trouvée dans la base, qui sera donc afficher par défaut au chargement
                        if ($produit->pro_cat_id == $i)
                        {
                            echo "selected ";
                        }
                        //en value, on met l'ID de la catégorie
                        echo 'value="'.($i).'"';
                        ?>
                        >
                        <!-- le champ prend le nom de la catégorie -->
                        <?php echo $kitten; ?>
                        </option>
                <?php
                    }
                ?>
            </select>
            <div class="invalid-feedback">Sélectionner une Catégorie est obligatoire pour pouvoir enregistrer un produit.</div>
        </div>

        <!-- Champ Libellé -->
        <div class="form-group">
            <label for="lib">Libellé :</label>
            <!-- L'Expression Régulière respecte la structure de la base de donnée, le libellé est une valeur obligatoire de 200 caractères au plus -->
            <input type="text" class="form-control" name="lib" id="lib" placeholder="Exemple : Produit numéro 4" pattern="[\w\-àáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{1,200}" required value="<?php echo $produit->pro_libelle; ?>">
            <div class="invalid-feedback">Le Libellé doit faire entre 1 et 200 caractères (chiffres, espaces, apostrophes et tirets sont acceptés).</div>
        </div>

        <!-- Champ Description -->
        <div class="form-group">
            <label for="des">Description :</label>
            <!-- Ici nous vérifions simplement que la description entrée par l'utilisateur ne dépasse pas les 1000 caractères, un limite de la valeur dans la base -->
            <textarea class="form-control" name="des" id="des" row="2" placeholder="Exemple : Courte description de Produit numéro 4 (peut rester vide)" maxlength="1000"><?php echo $produit->pro_description; ?></textarea>
        </div>

        <!-- Champ Prix -->
        <div class="form-group">
            <label for="prix">Prix :</label>
            <!-- L'Expression Régulière respecte la structure de la base de donnée, le prix est une valeur obligatoire avec 6 chiffres maximum avant la virgule et 2 chiffres après, pour faciliter l'insertion, la virgule devra obligatoirement être représentée par un point -->
            <input type="text" class="form-control" name="prix" id="prix" placeholder="Exemple : 12.99 (utilisez un point pas une virgule)" pattern="[0-9]{1,6}[.]{0,1}[0-9]{0,2}" required value="<?php echo $produit->pro_prix; ?>">
            <div class="invalid-feedback">Le Prix doit avoir au moins un chiffre avant le point (la virgule n'est pas acceptée) et deux chiffres max après.</div>
        </div>

        <!-- Champ Stock -->
        <div class="form-group">
            <label for="stock">Stock :</label>
            <!-- L'Expression Régulière respecte la structure de la base de donnée, le stock est une valeur entière jusqu'à 11 chiffres et peut rester vide -->
            <input type="text" class="form-control" name="stock" id="stock" placeholder="Exemple : 2 (peut se mettre à zéro)" pattern="[0-9]{0,11}" value="<?php echo $produit->pro_stock; ?>">
            <div class="invalid-feedback">Le Stock doit être égal ou supérieur à zéro.</div>
        </div>

        <!-- Champ Couleur -->
        <div class="form-group">
            <label for="color">Couleur :</label>
            <!-- L'Expression Régulière respecte la structure de la base de donnée, la couleur est une chaine de 30 caractères maximum et peut rester vide -->
            <input type="text" class="form-control" name="color" id="color" placeholder="Exemple : Café (peut rester vide)" pattern="[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{0,30}" value="<?php echo $produit->pro_couleur; ?>">
            <div class="invalid-feedback">La Couleur peut faire jusqu'à 30 caractères (espaces et apostrophes sont acceptés).</div>
        </div>

        <!-- Champ Extension de la photo -->
        <div class="form-group">
            <label for="ext">Extension de la photo :</label>
            <!-- L'Expression Régulière respecte la structure de la base de donnée, l'extension de la photo est une chaine de 4 caractères maximum et peut rester vide -->
            <input type="text" class="form-control" name="ext" id="ext" placeholder="jpg" pattern="[\w]{0,4}" value="<?php echo $produit->pro_photo; ?>">
            <div class="invalid-feedback">L'Extension peut faire jusqu'à 4 caractères (chiffres et lettres).</div>
        </div>

        <!-- Bouton radio Produit bloqué -->
        <div class="form-group">
            <label for="block">Produit bloqué ? :</label>
            <br>
                    <!-- On récupère le booléen créé plus haut si dans la base le produit n'est pas bloqué à la vente, Non sera checked, sinon ça sera Oui -->
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="block" id="blocked" <?php if ($block) { echo "checked"; } ?> value="blocked">
                    <label class="form-check-label" for="blocked"> Oui</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="block" id="unblocked" <?php if (!$block) { echo "checked"; } ?> value="unblocked">
                    <label class="form-check-label" for="unblocked"> Non</label>
                </div>
        </div>

        <!-- Champ Date d'ajout -->
        <div class="form-group">
            <label for="ajout">Date d'ajout :</label>
            <input type="date" class="form-control" name="ajout" id="ajout" disabled value="<?php echo $produit->pro_d_ajout; ?>">
        </div>

        <!-- Champ Date de modification -->
        <div class="form-group">
            <label for="modif">Date de modification :</label>
            <input type="text" class="form-control" name="modif" id="modif" placeholder="Ce Produit n'a jamais été modifié" disabled value="<?php echo $produit->pro_d_modif; ?>">
        </div>

        <!-- Bouton de type reset, remmettra les valeurs données au chargement de la page aux champs, donc leurs valeurs dans la base de données -->
        <div class="form-group">
            <input type="reset" class="btn btn-info" value="Remettre les valeurs de base">
        </div>

        <!-- Boutons en bas de page pour quitter la page d'Update -->
        <div class="form-group">
            <!-- Bouton Retour qui envoie à la page de la liste des produits -->
            <a href="liste.php" title="Retour">
                <button type="button" class="btn btn-secondary " id="retour">Retour</button>
            </a>

            <!-- Bouton Enregistrer de type submit qui envoie sur les données rentrées dans les champs du formulaire en POST à un Script PHP qui les ajoutera dans la base (voir update_script.php) -->
            <input type="submit" class="btn btn-success" value="Enregistrer">
        </div>

    </form>

    <!-- Appel du fichier JavaScript de vérification du Formulaire -->
    <script src="assets/js/verif.js"></script>

    <?php
    }
    //Le footer du site sera ici
    require("footer.php");
?>