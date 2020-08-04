<?php
    $Titre = "Page de détail";
    include("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <?php
        require("connexion_bdd.php"); // Inclusion de notrebibliothèque de fonctions

        $db = connexionBase(); // Appel de la fonction deconnexion
        $pro_id = $_GET["id"];
        $requete = "SELECT * FROM produits WHERE pro_id=".$pro_id;

        $result = $db->query($requete);

        // Renvoi de l'enregistrement sous forme d'un objet
        $produit = $result->fetch(PDO::FETCH_OBJ);
    ?>

    <?php echo $produit->pro_libelle; ?> référence <?php echo $produit->pro_ref; ?>
    <br>
    <?php echo $produit->pro_description; ?>
    <br>
    <?php echo $produit->pro_prix; ?>

</div>
<?php
    include("footer.php");
?>