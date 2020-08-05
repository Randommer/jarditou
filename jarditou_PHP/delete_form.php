<?php
    $Titre = "Êtes-vous sûr ?";
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
<div class="row mx-0 mb-1">
    <div class="col-4"></div>
    <div class="col-4">
        <h1><?php echo $produit->pro_libelle; ?></h1>
        <p>
            Êtes vous sûr de vouloir supprimer <?php echo $produit->pro_libelle; ?> de la base de données ?
        </p>
    </div>
    <div class="col-4"></div>
</div>
<div class="row mx-0 mb-1">
    <div class="col-4"></div>
    <div class="col-4">
        <form action="delete_script.php" method="POST">
            <input type="hidden" name="id" id="id" value="<?php echo $produit->pro_id; ?>">
            <input type="submit" class="btn btn-danger">
            <a href="liste.php" title="Annuler">
                <button type="button" class="btn btn-success">Annuler</button>
            </a>
        </form>
    </div>
    <div class="col-4"></div>
</div>
<?php
    include("footer.php");
?>