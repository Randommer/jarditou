<?php
    $Titre = "Modification dans la base";
    $nav = 2;
    include("header.php");
    function verifstring($chaine)
    {
        if (is_string($chaine))
        {
            $chaine = trim($chaine);
            $chaine = stripslashes($chaine);
            return htmlspecialchars($chaine);
        }
        else
        {
            return null;
        }
    }
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
            $verif = true;

            if (is_numeric($_POST["id"]) && $_POST["id"] > 0)
            {
                $pro_id = intval($_POST["id"]);
            }
            else
            {
                $verif = false;
            }
            
            if (is_numeric($_POST["cat"]) && $_POST["cat"] != 0)
            {
                $pro_cat_id = intval($_POST["cat"]);
            }
            else
            {
                $verif = false;
            }
            
            $pro_ref = verifstring($_POST["ref"]);
            if (preg_match("/[\w\-]{1,10}/", $pro_ref) == false)
            {
                $verif = false;
            }
            
            $pro_libelle = verifstring($_POST["lib"]);
            if (preg_match("/[\w\-àáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{1,200}/", $pro_libelle) == false)
            {
                $verif = false;
            }

            if (empty($_POST["des"]))
            {
                $pro_description = "";
            }
            else
            {
                $pro_description = verifstring($_POST["des"]);
                if (strlen($pro_description) > 1000)
                {
                    $verif = false;
                }
            }

            if (is_numeric($_POST["prix"]) && $_POST["prix"] > 0 && preg_match("/[0-9]{1,6}[.]{0,1}[0-9]{0,2}/", $_POST["prix"]))
            {
                $pro_prix = floatval($_POST["prix"]);
            }
            else
            {
                $verif = false;
            }

            if (empty($_POST["stock"]))
            {
                $pro_stock = 0;
            }
            else
            {
                if (is_numeric($_POST["stock"]) && $_POST["stock"] >= 0 && preg_match("/[0-9]{0,11}/", $_POST["stock"]))
                {
                    $pro_stock = intval($_POST["stock"]);
                }
                else
                {
                    $verif = false;
                }

            }

            if (empty($_POST["color"]))
            {
                $pro_couleur = NULL;
            }
            else
            {
                $pro_couleur = verifstring($_POST["color"]);
                if (preg_match("/[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{0,30}/", $pro_couleur) == false)
                {
                    $verif = false;
                }
            }

            if (empty($_POST["ext"]))
            {
                $pro_photo = "jpg";
            }
            else
            {
                $pro_photo = verifstring($_POST["ext"]);
                if (preg_match("/[\w]{0,4}/", $pro_photo) == false)
                {
                    $verif = false;
                }
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
        
            require("connexion_bdd.php"); // Inclusion de notre bibliothèque de fonctions

            if ($verif)
            {
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
            else
            {
                echo "Erreur dans les données envoyées.";
            }
        }
    }
    header("Location: liste.php");
?>
<?php
    include("footer.php");
?>