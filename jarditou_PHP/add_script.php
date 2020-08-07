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
    if ($_SERVER["REQUEST_METHOD"] == "POST" )
    {
        if (empty($_POST["cat"]) || empty($_POST["ref"]) || empty($_POST["lib"]) || empty($_POST["prix"]))
        {
            header("Location: liste.php");
        }
        else
        {
            //$pro_id = $_POST["id"]*1;
            $pro_cat_id = $_POST["cat"]*1;
            $pro_ref = trim($_POST["ref"]);
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

            //$pro_d_ajout  = getdate();
            //$pro_d_modif = null;

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

            require("connexion_bdd.php"); // Inclusion de notre bibliothèque de fonctions

            $db = connexionBase(); // Appel de la fonction de connexion
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

            $requete = "SELECT MAX(pro_id) AS 'pro_id' FROM produits WHERE pro_ref = '".$pro_ref."'";
            $result = $db->query($requete);
            $produit = $result->fetch(PDO::FETCH_OBJ);

        }
    }
    
    if ($_FILES["img"]["error"] == 0)
    {
        $types = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $_FILES["img"]["tmp_name"]);
        finfo_close($finfo);

        if (in_array($mimetype, $types))
        {
            $extension = substr(strrchr($_FILES["img"]["name"], "."), 1);
            echo $extension;
            move_uploaded_file($_FILES["img"]["tmp_name"], "src/img/".$produit->pro_id.".".$extension);
            $requete = $db->prepare("UPDATE produits SET pro_photo = :pro_photo WHERE pro_id = :pro_id");
            $requete->bindValue(":pro_id", $produit->pro_id);
            $requete->bindValue(":pro_photo", $extension);
            $requete->execute();
        }
        else
        {
            echo "Le format de l'image n'est pas supporté";
        }
    }
    else
    {
        echo "Erreur durant l'importation";
    }
    $db = null;
    header("Location: liste.php");
?>
<?php
    include("footer.php");
?>