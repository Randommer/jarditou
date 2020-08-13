<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Page de détail";
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

    <!-- l'entête de notre description contiendra l'image du produit -->
    <div class="row mx-0 mb-1">
        <div class="col-4"></div>
        <div class="col-4">
            <!-- On crée une balise image avec l'adresse préremplie, à laquelle on ajoute le ID produit et l'extension photo trouvés donnés par la base -->
            <img class='img-fluid' src='src/img/<?php echo $produit->pro_id.".".$produit->pro_photo; ?>' alt='<?php echo $produit->pro_libelle." ".$produit->pro_couleur; ?>'>
        </div>
        <div class="col-4"></div>
    </div>

    <!-- On crée un formulaire qui nous servira de présentation pour la description produit, tout les champs sont disabled car il s'agit juste d'affichage des données produit -->
    <!-- Tout les champs ont leurs value remplie avec les valeurs obtenues dans la base -->
    <!-- Ce formulaire sert de base à celui d'ajout et de modification, il a donc plein de truc que ne servent pas, mais qui servent dans d'autres pages (qui sont de base un copier coller de celle-ci) -->
    <form>

        <!-- Champ ID du produit, ici il ne s'affiche pas -->
        <div class="form-group d-none">
            <label for="id">ID :</label>
            <input type="text" class="form-control" placeholder="L'ID sera donné automatiquement à l'enregistrement" disabled value="<?php echo $produit->pro_id; ?>">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $produit->pro_id; ?>">
        </div>

        <!-- Champ Référence -->
        <div class="form-group">
            <label for="ref">Référence :</label>
            <input type="text" class="form-control" name="ref" id="ref" placeholder="Exemple : Produit4" pattern="[\w\-]{1,10}" required disabled value="<?php echo $produit->pro_ref; ?>">

        </div>

        <!-- Champ Catégorie -->
        <div class="form-group">
            <label for="cat">Catégorie :</label>
            <select class="form-control" name="cat" id="cat" required disabled>
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

        </div>

        <!-- Champ Libellé -->
        <div class="form-group">
            <label for="lib">Libellé :</label>
            <input type="text" class="form-control" name="lib" id="lib" placeholder="Exemple : Produit numéro 4" pattern="[\w\-àáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{1,200}" required disabled value="<?php echo $produit->pro_libelle; ?>">

        </div>

        <!-- Champ Description -->
        <div class="form-group">
            <label for="des">Description :</label>
            <textarea class="form-control" name="des" id="des" row="2" placeholder="Exemple : Courte description de Produit numéro 4 (peut rester vide)" maxlength="1000" disabled><?php echo $produit->pro_description; ?></textarea>
        </div>

        <!-- Champ Prix -->
        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="text" class="form-control" name="prix" id="prix" placeholder="Exemple : 12.99 (utilisez un point pas une virgule)" pattern="[0-9]{1,6}[.]{0,1}[0-9]{0,2}" required disabled value="<?php echo $produit->pro_prix; ?>">

        </div>

        <!-- Champ Stock -->
        <div class="form-group">
            <label for="stock">Stock :</label>
            <input type="text" class="form-control" name="stock" id="stock" placeholder="Exemple : 2 (peut se mettre à zéro)" pattern="[0-9]{0,11}" disabled value="<?php echo $produit->pro_stock; ?>">

        </div>

        <!-- Champ Couleur -->
        <div class="form-group">
            <label for="color">Couleur :</label>
            <input type="text" class="form-control" name="color" id="color" placeholder="Exemple : Café (peut rester vide)" pattern="[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{0,30}" disabled value="<?php echo $produit->pro_couleur; ?>">

        </div>

        <!-- Champ Extension de la photo -->
        <div class="form-group d-none">
            <label for="ext">Extension de la photo :</label>
            <input type="hidden" class="form-control" name="ext" id="ext" placeholder="jpg" pattern="[\w]{0,4}" disabled value="<?php echo $produit->pro_photo; ?>">

        </div>

        <!-- Bouton radio Produit bloqué -->
        <div class="form-group">
            <label for="block">Produit bloqué ? :</label>
            <br>
                    <!-- On récupère le booléen créé plus haut si dans la base le produit n'est pas bloqué à la vente, Non sera checked, sinon ça sera Oui -->
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="block" id="blocked" disabled <?php if ($block) { echo "checked"; } ?> value="blocked">
                    <label class="form-check-label" for="blocked"> Oui</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="block" id="unblocked" disabled <?php if (!$block) { echo "checked"; } ?> value="unblocked">
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

        <!-- Boutons en bas de page pour quitter la page de Détail -->
        <div class="form-group">
            <!-- Bouton Retour qui envoie à la page de la liste des produits -->
            <a href="liste.php" title="Retour">
                <button type="button" class="btn btn-secondary " id="retour">Retour</button>
            </a>

            <!-- Bouton Modifier qui envoie sur le formulaire de Modification produit, l'adresse change en fonction de l'ID produit, pour le donner en GET -->
            <a href='update_form.php?id=<?php echo $produit->pro_id; ?>' title='Modifier'>
                <button type="button" class="btn btn-warning" id="modifier">Modifier</button>
            </a>

            <!-- Bouton Supprimer qui envoie sur le formulaire de Suppression produit, l'adresse change en fonction de l'ID produit, pour le donner en GET -->
            <a href='delete_form.php?id=<?php echo $produit->pro_id; ?>' title='Supprimer'>
                <button type="button" class="btn btn-danger" id="supprimer">Supprimer</button>
            </a>
        </div>

    </form>

    <?php
    }
    //Le footer du site sera ici
    require("footer.php");
?>