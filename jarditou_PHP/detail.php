<?php
    $Titre = "Page de détail";
    $nav = 2;
    include("header.php");
?>
<!-- Corps du site -->
<?php
    require("connexion_bdd.php"); // Inclusion de notrebibliothèque de fonctions

    $db = connexionBase(); // Appel de la fonction deconnexion
    $pro_id = $_GET["id"];
    $requete = "SELECT * FROM produits WHERE pro_id=".$pro_id;

    $result = $db->query($requete);

    // Renvoi de l'enregistrement sous forme d'un objet
    $produit = $result->fetch(PDO::FETCH_OBJ);
    $result->closeCursor();
?>
<div class="row mx-0 mb-1">
    <div class="col-4"></div>
    <div class="col-4">
        <?php echo "<img class='img-fluid' src='src/img/".$produit->pro_id.".".$produit->pro_photo."' alt='".$produit->pro_libelle." ".$produit->pro_couleur."'>"; ?>
    </div>
    <div class="col-4"></div>
</div>

<form method="POST">

    <div class="form-group">
        <label for="ref">Référence :</label>
        <input type="text" class="form-control" name="ref" id="ref" disabled value="<?php echo $produit->pro_ref; ?>">
    </div>

    <?php
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
    ?>
    <div class="form-group">
        <label for="cat">Catégorie :</label>
        <select class="form-control" name="cat" id="cat" disabled>
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
        <input type="text" class="form-control" name="lib" id="lib" disabled value="<?php echo $produit->pro_libelle; ?>">
    </div>

    <div class="form-group">
        <label for="des">Description :</label>
        <textarea class="form-control" name="des" id="des" row="2" disabled value=""><?php echo $produit->pro_description; ?></textarea>
    </div>

    <div class="form-group">
        <label for="prix">Prix :</label>
        <input type="text" class="form-control" name="prix" id="prix" disabled value="<?php echo $produit->pro_prix; ?>">
    </div>

    <div class="form-group">
        <label for="stock">Stock :</label>
        <input type="text" class="form-control" name="stock" id="stock" disabled value="<?php echo $produit->pro_stock; ?>">
    </div>

    <div class="form-group">
        <label for="color">Couleur :</label>
        <input type="text" class="form-control" name="color" id="color" disabled value="<?php echo $produit->pro_couleur; ?>">
    </div>

    <div class="form-group d-none">
        <label for="ext">Extension de la photo :</label>
        <input type="hidden" class="form-control" name="ext" id="ext" disabled value="<?php echo $produit->pro_photo; ?>">
    </div>

    <div class="form-group">
        <label for="block">Produit bloqué ? :</label>
        <?php
            if ($produit->pro_bloque == null)
            {
                $block = false;
            }
            else
            {
                $block = true;
            }
        ?>
        <br>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="block" id="blocked" disabled <?php if ($block) { echo "checked"; } ?> value=true>
                <label class="form-check-label" for="blocked"> Oui</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="block" id="unblocked" disabled <?php if (!$block) { echo "checked"; } ?> value=false>
                <label class="form-check-label" for="unblocked"> Non</label>
            </div>
    </div>

    <div class="form-group">
        <label for="ajout">Date d'ajout :</label>
        <input type="date" class="form-control" name="ajout" id="ajout" disabled value="<?php echo $produit->pro_d_ajout; ?>">
    </div>

    <div class="form-group">
        <label for="modif">Date de modification :</label>
        <input type="text" class="form-control" name="modif" id="modif" disabled value="<?php echo $produit->pro_d_modif; ?>">
    </div>

</form>

<div class="row mx-0 mb-1">
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

<?php
    include("footer.php");
?>