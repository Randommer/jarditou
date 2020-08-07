<?php
    $Titre = "Modification dans la base";
    $nav = 2;
    include("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <p>
        Votre modification produit s'enregistre dans la base de données, vous allez être redirigé.
    </p>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" )
    {
        if (empty($_POST["id"]) || empty($_POST["cat"]) || empty($_POST["ref"]) || empty($_POST["lib"]) || empty($_POST["prix"]))
        {
            header("Location: liste.php");
        }
        else
        {
            $pro_id = $_POST["id"]*1;
            $pro_cat_id = $_POST["cat"]*1;
            $pro_ref = trim($_POST["ref"]);
            //stripslashes
            //htmlspecialchars
            $pro_libelle = trim($_POST["lib"]);
            $pro_prix = $_POST["prix"]*1;

            if (empty($_POST["des"]))
            {
                $pro_description = "";
            }
            else
            {
                $pro_description = trim($_POST["des"]);
            }

            if (empty($_POST["stock"]))
            {
                $pro_stock = 0;
            }
            else
            {
                $pro_stock = $_POST["stock"]*1;
            }

            if (empty($_POST["color"]))
            {
                $pro_couleur = NULL;
            }
            else
            {
                $pro_couleur = trim($_POST["color"]);
            }

            if (empty($_POST["ext"]))
            {
                $pro_photo = "jpg";
            }
            else
            {
                $pro_photo = trim($_POST["ext"]);
            }

            //$pro_d_ajout  = $_POST["pro_d_ajout"];
            //$pro_d_modif = getdate();

            if (empty($_POST["block"]))
            {
                $pro_bloque = NULL;
            }
            else
            {
                if ($_POST["block"] == "blocked")
                {
                    $pro_bloque = 0;
                }
                else
                {
                    $pro_bloque = NULL;
                }
            }
        
            require("connexion_bdd.php"); // Inclusion de notr bibliothèque de fonctions

            $db = connexionBase(); // Appel de la fonction de connexion
            $requete = $db->prepare("UPDATE produits SET pro_cat_id = :pro_cat_id, pro_ref = :pro_ref, pro_libelle = :pro_libelle, pro_description = :pro_description, pro_prix = :pro_prix, pro_stock = :pro_stock, pro_couleur = :pro_couleur, pro_photo = :pro_photo, pro_d_modif = CURRENT_TIME(), pro_bloque = :pro_bloque WHERE pro_id = :pro_id");
            $requete->bindValue(":pro_id", $pro_id);
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
        }
    }
    header("Location: liste.php");
?>
<?php
    include("footer.php");
?>