<?php
    $Titre = "Page d'ajout";
    $nav = 2;
    include("header.php");
?>
<!-- Corps du site -->
<?php
    require("connexion_bdd.php"); // Inclusion de notre bibliothèque de fonctions

    $db = connexionBase(); // Appel de la fonction de connexion
    /*$pro_id = $_GET["id"];
    $requete = "SELECT * FROM produits WHERE pro_id=".$pro_id;

    $result = $db->query($requete);

    // Renvoi de l'enregistrement sous forme d'un objet
    $produit = $result->fetch(PDO::FETCH_OBJ);
    $result->closeCursor();
    */

    //
    $requeteCat = "SELECT cat_id, cat_nom FROM categories ORDER by cat_id";

    $result = $db->query($requeteCat);

    if (!$result)
    {
        $tableauErreurs = $db->errorInfo();
        echo $tableauErreur[2];
        die("Erreur dans la requête");
    }

    if ($result->rowCount() == 0)
    {
        // Pas d'enregistrement
        die("La table est vide");
    }

    $cats = array();
    $cats["0"] = "Sélectionnez une catégorie";
    while ($row = $result->fetch(PDO::FETCH_OBJ))
    {
        $cats["".$row->cat_id] = $row->cat_nom;
    }
    $result->closeCursor();

    //
    class Prod
    {
        function __construct()
        {
            $this->pro_id = "";
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
    //
    $produit = new Prod();

    //
    if ($produit->pro_bloque == null)
    {
        $block = false;
    }
    else
    {
        $block = true;
    }
?>

<div class="row mx-0 mb-1 mt-1">
    <div class="col-5"></div>
    <div class="col-2">
        <span style="color: green;">
            <i class="far fa-file-alt fa-6x"></i>
        </span>
        <?php //echo "<img class='img-fluid' src='src/img/".$produit->pro_id.".".$produit->pro_photo."' alt='".$produit->pro_libelle." ".$produit->pro_couleur."'>"; ?>
    </div>
    <div class="col-5"></div>
</div>

<form action="add_script.php" method="POST" enctype="multipart/form-data" class="was-validated" id="theform" validate>

    <div class="form-group">
        <label for="id">ID :</label>
        <input type="text" class="form-control" placeholder="L'ID sera donné automatiquement à l'enregistrement" disabled value="<?php echo $produit->pro_id; ?>">
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $produit->pro_id; ?>">
    </div>

    <div class="form-group">
        <label for="ref">Référence :</label>
        <input type="text" class="form-control" name="ref" id="ref" placeholder="Exemple : Produit4" pattern="[\w\-]{1,10}" required value="<?php echo $produit->pro_ref; ?>">
        <div class="invalid-feedback">La Référence doit faire entre 1 et 10 caractères, sans accents et ne comporte pas d'espace (chiffres et tirets sont acceptés).</div>
    </div>

    <div class="form-group">
        <label for="cat">Catégorie :</label>
        <select class="form-control" name="cat" id="cat" required>
            <?php
                foreach($cats as $i => $kitten)
                {
                    echo "<option ";
                    if ($i == "0")
                    {
                        echo "disabled ";
                    }
                    if ($produit->pro_cat_id == $i)
                    {
                        echo "selected ";
                    }
                    echo 'value="'.($i).'">';
                    echo $kitten;
                    echo "</option>";

                }
            ?>
        </select>
        <div class="invalid-feedback">Sélectionner une Catégorie est obligatoire pour pouvoir enregistrer un produit.</div>
    </div>

    <div class="form-group">
        <label for="lib">Libellé :</label>
        <input type="text" class="form-control" name="lib" id="lib" placeholder="Exemple : Produit numéro 4" pattern="[\w\-àáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{1,200}" required value="<?php echo $produit->pro_libelle; ?>">
        <div class="invalid-feedback">Le Libellé doit faire entre 1 et 200 caractères (chiffres, espaces, apostrophes et tirets sont acceptés).</div>
    </div>

    <div class="form-group">
        <label for="des">Description :</label>
        <textarea class="form-control" name="des" id="des" row="2" placeholder="Exemple : Courte description de Produit numéro 4 (peut rester vide)" maxlength="1000"><?php echo $produit->pro_description; ?></textarea>
    </div>

    <div class="form-group">
        <label for="prix">Prix :</label>
        <input type="text" class="form-control" name="prix" id="prix" placeholder="Exemple : 12.99 (utilisez un point pas une virgule)" pattern="[0-9]{1,6}[.]{0,1}[0-9]{0,2}" required value="<?php echo $produit->pro_prix; ?>">
        <div class="invalid-feedback">Le Prix doit avoir au moins un chiffre avant le point (la virgule n'est pas acceptée) et deux chiffres max après.</div>
    </div>

    <div class="form-group">
        <label for="stock">Stock :</label>
        <input type="text" class="form-control" name="stock" id="stock" placeholder="Exemple : 2 (peut se mettre à zéro)" pattern="[0-9]{0,11}" value="<?php echo $produit->pro_stock; ?>">
        <div class="invalid-feedback">Le Stock doit être égal ou supérieur à zéro.</div>
    </div>

    <div class="form-group">
        <label for="color">Couleur :</label>
        <input type="text" class="form-control" name="color" id="color" placeholder="Exemple : Café (peut rester vide)" pattern="[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{0,30}" value="<?php echo $produit->pro_couleur; ?>">
        <div class="invalid-feedback">La Couleur peut faire jusqu'à 30 caractères (espaces et apostrophes sont acceptés).</div>
    </div>

    <div class="form-group">
        <label for="ext">Extension de la photo :</label>
        <input type="text" class="form-control" name="ext" id="ext" placeholder="jpg" pattern="[\w]{0,4}" value="<?php echo $produit->pro_photo; ?>">
        <div class="invalid-feedback">L'Extension peut faire jusqu'à 4 caractères (chiffres et lettres).</div>
    </div>

    <div class="form-group">
        <label for="block">Produit bloqué ? :</label>
        <br>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="block" id="blocked" <?php if ($block) { echo "checked"; } ?> value="blocked">
                <label class="form-check-label" for="blocked"> Oui</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="block" id="unblocked" <?php if (!$block) { echo "checked"; } ?> value="unblocked">
                <label class="form-check-label" for="unblocked"> Non</label>
            </div>
    </div>

    <div class="form-group d-none">
        <label for="ajout">Date d'ajout :</label>
        <input type="date" class="form-control" name="ajout" id="ajout" disabled value="<?php echo $produit->pro_d_ajout; ?>">
    </div>

    <div class="form-group d-none">
        <label for="modif">Date de modification :</label>
        <input type="text" class="form-control" name="modif" id="modif" placeholder="Ce Produit n'a jamais été modifié" disabled value="<?php echo $produit->pro_d_modif; ?>">
    </div>

    <div class="form-group">
        <label for="img">Fichier image :</label>
        <input type="file" class="form-control" name="img" id="img" accept="image/*">
        <div class="valid-feedback">Importer une image n'est pas obligatoire pour l'Enregistrement du produit.</div>
    </div>

    <div class="form-group">
        <input type="reset" class="btn btn-info" value="Réinitialiser le formulaire">
    </div>

    <div class="form-group">
        <a href="liste.php" title="Retour">
            <button type="button" class="btn btn-secondary " id="retour">Retour</button>
        </a>

        <input type="submit" class="btn btn-success" value="Ajouter">
    </div>

</form>

<!-- Appel du fichier JavaScript de vérification du Formulaire -->
<script src="assets/js/verif.js"></script>

<?php
    include("footer.php");
?>