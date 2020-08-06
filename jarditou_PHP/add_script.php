<?php
    $Titre = "Enregistrement dans la base";
    $nav = 2;
    include("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <p>
        Votre produit s'enregistre dans la base de données, vous allez être redirigé.
    </p>
</div>
<?php
    //$pro_id = $_POST["id"];
    $pro_cat_id = $_POST["cat"];
    $pro_ref = $_POST["ref"];
    $pro_libelle = $_POST["lib"];
    $pro_description = $_POST["des"];
    $pro_prix = $_POST["prix"];
    $pro_stock = $_POST["stock"];
    $pro_couleur = $_POST["color"];
    $pro_photo = $_POST["ext"];


    //$pro_d_ajout  = getdate();
    //$pro_d_modif = null;

    if ($_POST["block"] == true)
    {
        $pro_bloque = 0;
    }
    else
    {
        $pro_bloque = "NULL";
    }

    require("connexion_bdd.php"); // Inclusion de notrebibliothèque de fonctions

    $db = connexionBase(); // Appel de la fonction deconnexion
    $requete = $db->prepare("INSERT INTO produits (pro_cat_id, pro_ref, pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_photo, pro_d_ajout, pro_d_modif, pro_bloque) VALUES (:pro_cat_id, :pro_ref, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_photo, CURRENT_DATE(), NULL, :pro_bloque)");
    //$requete->bindValue(":pro_id", $pro_id);
    $requete->bindValue(":pro_cat_id", $pro_cat_id);
    $requete->bindValue(":pro_ref", $pro_ref);
    $requete->bindValue(":pro_libelle", $pro_libelle);
    $requete->bindValue(":pro_description", $pro_description);
    $requete->bindValue(":pro_prix", $pro_prix);
    $requete->bindValue(":pro_stock", $pro_stock);
    $requete->bindValue(":pro_couleur", $pro_couleur);
    $requete->bindValue(":pro_photo", $pro_photo);
    //$requete->bindValue(":pro_d_ajout", $pro_d_ajout);
    //$requete->bindValue(":pro_d_modif", $pro_d_modif);
    $requete->bindValue(":pro_bloque", $pro_bloque);

    $requete->execute();

    $db = null;
    header("Location:liste.php");
?>
<?php
    include("footer.php");
?>