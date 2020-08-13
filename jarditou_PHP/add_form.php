<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Page d'ajout";
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



    /////On veut récupérer les noms des différentes catégories disponible dans la base
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

    ////Pour pouvoir réutiliser le code du formulaire de modification produit, on a besoin d'un produit, nous créons donc un objet produit à l'identique ceux que fetch(PDO::FETCH_OBJ)) nous crée quand il nous sort un produit de la base
    //objet produit, qu'on appelle Prod
    class Prod
    {
        //constructeur de l'objet
        function __construct()
        {
            ////tout les champs avec les meme noms que dans la base, mais ici vide ou null
            $this->pro_id = "";
            //le champ pro_cat_id est mis à 0 pour que le champ par défaut du Select soit selectionné au chargement de la page
            $this->pro_cat_id = "0";
            $this->pro_ref = "";
            $this->pro_libelle = "";
            $this->pro_description = null;
            $this->pro_prix = "";
            $this->pro_stock = "";
            $this->pro_couleur = "";
            $this->pro_photo = "";
            $this->pro_d_ajout = null;
            $this->pro_d_modif = null;
            $this->pro_bloque = null;
        }
    }
    //On crée un objet Prod $produit à comme on aurai fait en récupérant un produit de la base
    $produit = new Prod();

    //Pour facilité l'affichage du bouton radio de bloqcage de vente, on assigne un booléen en fonction de la valeur dans la base
    //Donc ici comme notre produit n'existe pas encore dans la base, il est mis à faux
    if ($produit->pro_bloque == null)
    {
        $block = false;
    }
    else
    {
        $block = true;
    }
?>

<!-- l'entête de notre formulaire contient une icone -->
<div class="row mx-0 mb-1 mt-1">
    <div class="col-5"></div>
    <div class="col-2">
        <!-- Icone de Font Awesome -->
        <span style="color: green;">
            <i class="far fa-file-alt fa-6x"></i>
        </span>
    </div>
    <div class="col-5"></div>
</div>

<!-- On crée un formulaire -->
<!-- Tout les champs ont leurs value remplie avec les valeurs obtenues dans objet Prod "vide" -->
<!-- Le formulaire enverra les données en POST sur le script add_script.php qui changera les valeurs produits dans la base -->
<!-- On utilise la class was-validated de Bootstrap pour mettre les champs en rouge  quand ils ne respectent pas le pattern et le required -->
<!-- Avec was-validated, Bootstrap a la class invalid-feedback qui ne s'affiche que quand le champ est incorrect, on l'utilise ici pour guider l'utilisateur sur comment remplir le champ -->
<!-- Pour éviter les petits malins qui bidouillent aux pattern et required, un JavaScript fait aussi la vérification et les données sont revérifiés au début de add_script.php -->
<form action="add_script.php" method="POST" enctype="multipart/form-data" class="was-validated" id="theform" validate>

    <!-- Champ ID du produit -->
    <!-- Pourquoi, on garde ce champ, après le copier-coller du formulaire de modification ? Je sais pas trop, je l'ai laissé mais on pourrai ne pas l'afficher voir le supprimer. Ca habille le haut du formulaire ? -->
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
                        ////Au chargement de ce formulaire, la case par défaut sera toujours selectionné, si tout va bien ;)
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

    <!-- Champ Date d'ajout, ici il ne s'affiche pas -->
    <div class="form-group d-none">
        <label for="ajout">Date d'ajout :</label>
        <input type="date" class="form-control" name="ajout" id="ajout" disabled value="<?php echo $produit->pro_d_ajout; ?>">
    </div>

    <!-- Champ Date de modification, ici il ne s'affiche pas -->
    <div class="form-group d-none">
        <label for="modif">Date de modification :</label>
        <input type="text" class="form-control" name="modif" id="modif" placeholder="Ce Produit n'a jamais été modifié" disabled value="<?php echo $produit->pro_d_modif; ?>">
    </div>

    <!-- Champ Fichier image -->
    <div class="form-group">
        <label for="img">Fichier image :</label>
        <input type="file" class="form-control" name="img" id="img" accept="image/*">
        <!-- la class valid-feedback de Bootstrap permet d'indiquer un message quand un input est correctement correctement rentrée. Ici l'image n'étant pas obligatoire, on dit à l'utilisateur qu'il a la possibilité de charger une image sur le site -->
        <div class="valid-feedback">Importer une image n'est pas obligatoire pour l'Enregistrement du produit.</div>
    </div>

    <!-- Bouton de type reset, remmettra les valeurs données au chargement de la page aux champs, donc leurs valeurs dans la base de données -->
    <div class="form-group">
        <input type="reset" class="btn btn-info" value="Réinitialiser le formulaire">
    </div>

    <!-- Boutons en bas de page pour quitter la page d'Ajout -->
    <div class="form-group">
        <!-- Bouton Retour qui envoie à la page de la liste des produits -->
        <a href="liste.php" title="Retour">
            <button type="button" class="btn btn-secondary " id="retour">Retour</button>
        </a>

        <!-- Bouton Ajouter de type submit qui envoie sur les données rentrées dans les champs du formulaire en POST à un Script PHP qui les ajoutera dans la base (voir add_script.php) -->
        <input type="submit" class="btn btn-success" value="Ajouter">
    </div>

</form>

<!-- Appel du fichier JavaScript de vérification du Formulaire -->
<script src="assets/js/verif.js"></script>

<?php
    //Le footer du site sera ici
    require("footer.php");
?>