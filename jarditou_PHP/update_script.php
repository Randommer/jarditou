<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Modification dans la base";
    //donne la position de la page dans le menu du header
    $nav = 2;
    //Le header du site sera ici
    require("header.php");

    //Fonction de sécurité qui prend une chaine de caractères, y retire des blancs, les antislashs et transforme les caractères spéciaux en entités HTML
    function verifstring($chaine)
    {
        //verifie que le paramètre est bien une chaine de caractères
        if (is_string($chaine))
        {
            //on lui retire les espaces au début et en fin de chaine
            $chaine = trim($chaine);
            //on lui retire les antislashs
            $chaine = stripslashes($chaine);
            //on transforme les caractères spéciaux en entités HTML, puis retourne la nouvelle chaine
            return htmlspecialchars($chaine);
        }
        else //le paramètre n'est pas une chaine de caractères
        {
            //on revoie rien
            return null;
        }
    }
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <!-- Message à l'utilisateur si la base de données met du temps à répondre -->
    <p>
        Votre modification produit s'enregistre dans la base de données, vous allez être redirigé.
    </p>
</div>
<?php
    //on verifie si un POST a été envoyé à la page
    if ($_SERVER["REQUEST_METHOD"] == "POST" )
    {
        //on vérifie que les champs ID, Catégorie, Référence, Libellé et Prix ont été renseignés
        if (empty($_POST["id"]) || empty($_POST["cat"]) || empty($_POST["ref"]) || empty($_POST["lib"]) || empty($_POST["prix"]))
        {
            //on redirige le navigateur vers la liste produit
            header("Location: liste.php");
        }
        else //les champs ID, Catégorie, Référence, Libellé et Prix sont renseignés
        {
            //Initialisation d'un booléen qui déterminera la validité ou non des données POST
            //si il est vrai, on pourra faire appel à la base de donnée
            //si il est faux, on donnera un message d'erreur et on redirige le navigateur vers la liste produit
            $verif = true;

            //on verifie que ID est une valeur numérique, supérieur à 0
            if (is_numeric($_POST["id"]) && $_POST["id"] > 0)
            {
                //les valeurs POST sont des chaines de caractères, on change ID en entier et le stock dans une variable
                $pro_id = intval($_POST["id"]);
            }
            else //ID n'est pas numérique ou supérieur à 0
            {
                //données invalides
                $verif = false;
            }
            
            //on verifie que Catégorie est une valeur numérique, différente de 0
            if (is_numeric($_POST["cat"]) && $_POST["cat"] != 0)
            {
                //les valeurs POST sont des chaines de caractères, on change Catégorie en entier et le stock dans une variable
                $pro_cat_id = intval($_POST["cat"]);
            }
            else //Catégorie n'est pas numérique ou différente de 0
            {
                //données invalides
                $verif = false;
            }
            
            //on passe la valeur POST de Référence par verifstring et le stock dans une variable
            $pro_ref = verifstring($_POST["ref"]);
            //on cherche si Référence ne respecte pas son expression regulière 
            if (preg_match("/[\w\-]{1,10}/", $pro_ref) == false)
            {
                //données invalides
                $verif = false;
            }
            
            //on passe la valeur POST de Libellé par verifstring et le stock dans une variable
            $pro_libelle = verifstring($_POST["lib"]);
            //on cherche si Libellé ne respecte pas son expression regulière
            if (preg_match("/[\w\-àáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{1,200}/", $pro_libelle) == false)
            {
                //données invalides
                $verif = false;
            }

            //on vérifie que le champ Description a été renseigné
            if (empty($_POST["des"]))
            {
                //on stock une valeur vide dans une variable
                $pro_description = NULL;
            }
            else //le champ Description est renseigné
            {
                //on passe la valeur POST de Description par verifstring et le stock dans une variable
                $pro_description = verifstring($_POST["des"]);
                //on cherche si Description depasse sa limite de 1000 caractères
                if (strlen($pro_description) > 1000)
                {
                    //données invalides
                    $verif = false;
                }
            }

            //on verifie que Prix est une valeur numérique, supérieur à 0 et respecte son expression regulière
            if (is_numeric($_POST["prix"]) && $_POST["prix"] > 0 && preg_match("/[0-9]{1,6}[.]{0,1}[0-9]{0,2}/", $_POST["prix"]))
            {
                //les valeurs POST sont des chaines de caractères, on change Prix en décimal et le stock dans une variable
                $pro_prix = floatval($_POST["prix"]);
            }
            else //Prix n'est pas numérique, supérieur à 0 ou ne respecte pas son expression regulière
            {
                //données invalides
                $verif = false;
            }

            //on vérifie que le champ Stock a été renseigné
            if (empty($_POST["stock"]))
            {
                //on stock 0 dans une variable
                $pro_stock = 0;
            }
            else //le champ Stock est renseigné
            {
                //on verifie que Stock est une valeur numérique, supérieur ou égal à 0 et respecte son expression regulière
                if (is_numeric($_POST["stock"]) && $_POST["stock"] >= 0 && preg_match("/[0-9]{0,11}/", $_POST["stock"]))
                {
                    //les valeurs POST sont des chaines de caractères, on change Stock en entier et le stock dans une variable
                    $pro_stock = intval($_POST["stock"]);
                }
                else //Stock n'est pas numérique, supérieur ou égal à 0 ou ne respecte pas son expression regulière
                {
                    //données invalides
                    $verif = false;
                }

            }

            //on vérifie que le champ Couleur a été renseigné
            if (empty($_POST["color"]))
            {
                //on stock une valeur vide dans une variable
                $pro_couleur = NULL;
            }
            else //le champ Couleur est renseigné
            {
                //on passe la valeur POST de Couleur par verifstring et le stock dans une variable
                $pro_couleur = verifstring($_POST["color"]);
                //on cherche si Couleur ne respecte pas son expression regulière
                if (preg_match("/[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{0,30}/", $pro_couleur) == false)
                {
                    //données invalides
                    $verif = false;
                }
            }

            //on vérifie que le champ Extension de la photo a été renseigné
            if (empty($_POST["ext"]))
            {
                //on stock la chaine "jpg" dans une variable (valeur par défaut dans la base)
                $pro_photo = "jpg";
            }
            else //le champ Extension de la photo est renseigné
            {
                //on passe la valeur POST de Extension de la photo par verifstring et le stock dans une variable
                $pro_photo = verifstring($_POST["ext"]);
                //on cherche si Extension de la photo ne respecte pas son expression regulière
                if (preg_match("/[\w]{0,4}/", $pro_photo) == false)
                {
                    //données invalides
                    $verif = false;
                }
            }

            //on vérifie que le bouton radio Produit bloqué a été renseigné
            if (empty($_POST["block"]))
            {
                //on stock une valeur vide dans une variable (valeur par défaut dans la base)
                $pro_bloque = NULL;
            }
            else //le bouton radio Produit bloqué est renseigné
            {
                //on cherche si le Oui de Produit bloqué a été sélectionné
                if ($_POST["block"] == "blocked")
                {
                    //on stock 0 dans une variable
                    $pro_bloque = 0;
                }
                else //le Non de Produit bloqué a été sélectionné
                {
                    //on stock une valeur vide dans une variable
                    $pro_bloque = NULL;
                }
            }
        
            //Inclusion d'un fonction de connexion à la base de donnéee
            require("connexion_bdd.php");

            //on verifie qu'il n'y aucune erreur dans les données
            if ($verif)
            {
                //Appel de la fonction de connexion
                $db = connexionBase();

                //Préparation de la requète à envoyer à la base de donnée
                //On change la valeur pro_d_modif par le date et heure actuelle avec CURRENT_TIME
                $requete = $db->prepare("UPDATE produits SET pro_cat_id = :pro_cat_id, pro_ref = :pro_ref, pro_libelle = :pro_libelle, pro_description = :pro_description, pro_prix = :pro_prix, pro_stock = :pro_stock, pro_couleur = :pro_couleur, pro_photo = :pro_photo, pro_d_modif = CURRENT_TIME(), pro_bloque = :pro_bloque WHERE pro_id = :pro_id");

                //On met les données récupérées dans la requète
                $requete->bindValue(":pro_id", $pro_id);
                $requete->bindValue(":pro_cat_id", $pro_cat_id);
                $requete->bindValue(":pro_ref", $pro_ref);
                $requete->bindValue(":pro_libelle", $pro_libelle);
                $requete->bindValue(":pro_description", $pro_description);
                $requete->bindValue(":pro_prix", $pro_prix);
                $requete->bindValue(":pro_stock", $pro_stock);
                $requete->bindValue(":pro_couleur", $pro_couleur);
                $requete->bindValue(":pro_photo", $pro_photo);
                $requete->bindValue(":pro_bloque", $pro_bloque);

                //Exécute la requète
                $requete->execute();

                //Ferme la connexion vers la base de donnée
                $db = null;
            }
            else //au moins une donnée n'est pas valide
            {
                //Message d'erreur
                echo "Erreur dans les données envoyées.";
            }
        }
    }
    //on redirige le navigateur vers la liste produit
    header("Location: liste.php");
?>
<?php
    //Le footer du site sera ici
    require("footer.php");
?>