<?php
    $Titre = "Page de détail";
    $nav = 2;
    include("header.php");
?>
<!-- Corps du site -->
<?php
    require("connexion_bdd.php"); // Inclusion de notre bibliothèque de fonctions

    $db = connexionBase(); // Appel de la fonction de connexion
    $pro_id = $_GET["id"];
    $requete = "SELECT * FROM produits WHERE pro_id=".$pro_id;

    $result = $db->query($requete);

    // Renvoi de l'enregistrement sous forme d'un objet
    $produit = $result->fetch(PDO::FETCH_OBJ);
    $result->closeCursor();


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
    if ($produit->pro_bloque == null)
    {
        $block = false;
    }
    else
    {
        $block = true;
    }
?>

<div class="row mx-0 mb-1">
    <div class="col-4"></div>
    <div class="col-4">
        <?php echo "<img class='img-fluid' src='src/img/".$produit->pro_id.".".$produit->pro_photo."' alt='".$produit->pro_libelle." ".$produit->pro_couleur."'>"; ?>
    </div>
    <div class="col-4"></div>
</div>

<form>

    <div class="form-group d-none">
        <label for="id">ID :</label>
        <input type="text" class="form-control" placeholder="L'ID sera donné à l'enregistrement" disabled value="<?php echo $produit->pro_id; ?>">
        <input type="hidden" class="form-control" name="id" id="id" disabled value="<?php echo $produit->pro_id; ?>">
    </div>

    <div class="form-group">
        <label for="ref">Référence :</label>
        <input type="text" class="form-control" name="ref" id="ref" placeholder="Exemple : Produit4" pattern="[\w\-]{1,10}" required disabled value="<?php echo $produit->pro_ref; ?>">
    </div>

    <div class="form-group">
        <label for="cat">Catégorie :</label>
        <select class="form-control" name="cat" id="cat" required disabled>
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
    </div>

    <div class="form-group">
        <label for="lib">Libellé :</label>
        <input type="text" class="form-control" name="lib" id="lib" placeholder="Exemple : Produit numéro 4" pattern="[\w\-àáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{1,200}" required disabled value="<?php echo $produit->pro_libelle; ?>">
    </div>

    <div class="form-group">
        <label for="des">Description :</label>
        <textarea class="form-control" name="des" id="des" row="2" placeholder="Exemple : Courte description de Produit numéro 4 (peut rester vide)" maxlength="1000" disabled><?php echo $produit->pro_description; ?></textarea>
    </div>

    <div class="form-group">
        <label for="prix">Prix :</label>
        <input type="text" class="form-control" name="prix" id="prix" placeholder="Exemple : 12.99 (utilisez un point pas une virgule)" pattern="[0-9]{1,6}[.]{0,1}[0-9]{0,2}" required disabled value="<?php echo $produit->pro_prix; ?>">
    </div>

    <div class="form-group">
        <label for="stock">Stock :</label>
        <input type="text" class="form-control" name="stock" id="stock" placeholder="Exemple : 2 (peut se mettre à zéro)" pattern="[0-9]{0,11}" disabled value="<?php echo $produit->pro_stock; ?>">
    </div>

    <div class="form-group">
        <label for="color">Couleur :</label>
        <input type="text" class="form-control" name="color" id="color" placeholder="Exemple : Café (peut rester vide)" pattern="[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{0,30}" disabled value="<?php echo $produit->pro_couleur; ?>">
    </div>

    <div class="form-group d-none">
        <label for="ext">Extension de la photo :</label>
        <input type="hidden" class="form-control" name="ext" id="ext" placeholder="jpg" pattern="[\w]{0,4}" disabled value="<?php echo $produit->pro_photo; ?>">
    </div>

    <div class="form-group">
        <label for="block">Produit bloqué ? :</label>
        <br>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="block" id="blocked" disabled <?php if ($block) { echo "checked"; } ?> value="blocked">
                <label class="form-check-label" for="blocked"> Oui</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="block" id="unblocked" disabled <?php if (!$block) { echo "checked"; } ?> value="unblocked">
                <label class="form-check-label" for="unblocked"> Non</label>
            </div>
    </div>

    <div class="form-group">
        <label for="ajout">Date d'ajout :</label>
        <input type="date" class="form-control" name="ajout" id="ajout" disabled value="<?php echo $produit->pro_d_ajout; ?>">
    </div>

    <div class="form-group">
        <label for="modif">Date de modification :</label>
        <input type="text" class="form-control" name="modif" id="modif" placeholder="Ce Produit n'a jamais été modifié" disabled value="<?php echo $produit->pro_d_modif; ?>">
    </div>

    <div class="form-group">
        <a href="liste.php" title="Retour">
            <button type="button" class="btn btn-secondary " id="retour">Retour</button>
        </a>

        <a href="<?php echo 'update_form.php?id='.$pro_id; ?>" title="Modifier">
            <button type="button" class="btn btn-warning" id="modifier">Modifier</button>
        </a>

        <a href="<?php echo 'delete_form.php?id='.$pro_id; ?>" title="Supprimer">
            <button type="button" class="btn btn-danger" id="supprimer">Supprimer</button>
        </a>
    </div>

</form>

<?php
    include("footer.php");
?>