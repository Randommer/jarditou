<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");

    //on vérifie si un POST a été envoyé à la page
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //on vérifie que les champs Identifiant et Mot de passe ont été renseignés
        if (empty($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["mail"]) || empty($_POST["log"]) || empty($_POST["mdp"]) || empty($_POST["password"]))
        {
            //
            $_SESSION["signerror"] = 0;
        }
        else //les Identifiant et Mot de passe sont renseignés
        {
            //Initialisation d'un booléen qui déterminera la validité ou non des données POST
            //si il est vrai, on pourra faire appel à la base de donnée
            //si il est faux, on donnera un message d'erreur et on redirige le navigateur vers la page de connexion
            $verif = true;

            //on passe la valeur POST de l'Identifiant par verifstring et le stock dans une variable
            $post_prenom = verifstring($_POST["prenom"]);
            //on cherche si l'Identifiant ne respecte pas son expression régulière
            if (preg_match("/[\w\-]{3,50}/", $post_prenom) == false)
            {
                //données invalides
                $verif = false;
            }

            //on passe la valeur POST de l'Identifiant par verifstring et le stock dans une variable
            $post_nom = verifstring($_POST["nom"]);
            //on cherche si l'Identifiant ne respecte pas son expression régulière
            if (preg_match("/[\w\-]{3,50}/", $post_nom) == false)
            {
                //données invalides
                $verif = false;
            }

            //on passe la valeur POST de l'Identifiant par verifstring et le stock dans une variable
            $post_mail = verifstring($_POST["mail"]);
            //on cherche si l'Identifiant ne respecte pas son expression régulière
            if (filter_var($post_mail, FILTER_VALIDATE_EMAIL) == false)
            {
                //données invalides
                $verif = false;
            }

            //on passe la valeur POST de l'Identifiant par verifstring et le stock dans une variable
            $post_login = verifstring($_POST["log"]);
            //on cherche si l'Identifiant ne respecte pas son expression régulière
            if (preg_match("/[\w\-]{3,50}/", $post_login) == false)
            {
                //données invalides
                $verif = false;
            }

            //on passe la valeur POST du Mot de passe par verifstring et le stock dans une variable
            $post_mdp = verifstring($_POST["mdp"]);
            //on cherche si le Mot de passe ne respecte pas son expression régulière
            if (preg_match("/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/", $post_mdp) == false)
            {
                //données invalides
                $verif = false;
            }

            //on passe la valeur POST du Mot de passe par verifstring et le stock dans une variable
            $post_password = verifstring($_POST["password"]);
            //on cherche si le Mot de passe ne respecte pas son expression régulière
            if (preg_match("/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/", $post_password) == false)
            {
                //données invalides
                $verif = false;
            }

            if ($post_mdp != $post_password)
            {
                //données invalides
                $verif = false;
                $_SESSION["signerror"] = 2;
            }
            else
            {
                $hash_mdp = password_hash($post_mdp, PASSWORD_DEFAULT);
            }

            //Inclusion d'un fonction de connexion à la base de données
            require("connexion_bdd.php");

            //on vérifie qu'il n'y aucune erreur dans les données
            if ($verif)
            {
                //Appel de la fonction de connexion
                $db = connexionBase();

                $result = $db->prepare("SELECT DISTINCT jusr_id as 'id', jusr_login as 'login' FROM jusers WHERE jusr_login = :jlogin OR jusr_mail = :mail");
                $result->bindValue(":jlogin", $post_login);
                $result->bindValue(":mail", $post_mail);
                $result->execute();

                if ($result->rowCount() > 0)
                {
                    while ($user = $result->fetch(PDO::FETCH_OBJ))
                    {
                        if ($user->login == $post_login)
                        {
                            $_SESSION["signerror"] = 3;
                        }
                    }
                    if (!isset($_SESSION["signerror"]))
                    {
                        $_SESSION["signerror"] = 4;
                    }
                }
                else
                {
                    //Préparation de la requete à envoyer à la base de donnée
                    $insert = $db->prepare("INSERT INTO jusers (jusr_prenom, jusr_nom, jusr_mail, jusr_login, jusr_mdp, jusr_d_inscription) VALUES
                    (:prenom, :nom, :mail, :jlogin, :hashmdp, CURRENT_DATE)");

                    //On met les données récupérées dans la requete
                    $insert->bindValue(":prenom", $post_prenom);
                    $insert->bindValue(":nom", $post_nom);
                    $insert->bindValue(":mail", $post_mail);
                    $insert->bindValue(":jlogin", $post_login);
                    $insert->bindValue(":hashmdp", $hash_mdp);

                    //Exécute la requete
                    $insert->execute();

                    //Fermeture du curseur sur le résultat
                    $insert->closeCursor();

                    $_SESSION["compte"] = "ok";
                }
                //Fermeture du curseur sur le résultat
                $result->closeCursor();
                //Ferme la connexion vers la base de donnée
                $db = null;
            }
            else
            {
                if (!isset($_SESSION["signerror"]))
                {
                    $_SESSION["signerror"] = 1;
                }
            }
        }
    }
    else
    {
        $_SESSION["signerror"] = 0;
    }
    header("Location: signup_form.php");
?>