<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");

    //on vérifie si un POST a été envoyé à la page
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //on vérifie que les champs Identifiant et Mot de passe ont été renseignés
        if (empty($_POST["log"]) || empty($_POST["mdp"]))
        {
            //
            $_SESSION["logerror"] = 0;
        }
        else //les Identifiant et Mot de passe sont renseignés
        {
            //Initialisation d'un booléen qui déterminera la validité ou non des données POST
            //si il est vrai, on pourra faire appel à la base de donnée
            //si il est faux, on donnera un message d'erreur et on redirige le navigateur vers la page de connexion
            $verif = true;

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

            //Inclusion d'un fonction de connexion à la base de données
            require("connexion_bdd.php");

            //on vérifie qu'il n'y aucune erreur dans les données
            if ($verif)
            {
                //Appel de la fonction de connexion
                $db = connexionBase();

                //Préparation de la requete à envoyer à la base de donnée
                $result = $db->prepare("SELECT jusr_id as 'id', jusr_prenom as 'prenom', jusr_mdp as 'mdp', jusr_role_id as 'role' FROM jusers WHERE jusr_login = :jlogin");

                //On met les données récupérées dans la requete
                $result->bindValue(":jlogin", $post_login);

                //Exécute la requete
                $result->execute();

                //Gestion si le résultat de la requete est vide
                if ($result->rowCount() == 0)
                {
                    $_SESSION["logerror"] = 2;
                }
                else
                {
                    //Récupération en objet de l'Utilisateur demandé en requete
                    $user = $result->fetch(PDO::FETCH_OBJ);

                    if (password_verify($post_mdp, $user->mdp))
                    {
                        //Préparation de la requete à envoyer à la base de donnée
                        $update = $db->prepare("UPDATE jusers SET jusr_last_connexion = CURRENT_TIME WHERE jusr_id = :id");

                        //On met les données récupérées dans la requete
                        $update->bindValue(":id", $user->id);

                        //Exécute la requete
                        $update->execute();

                        //Fermeture du curseur sur le résultat
                        $update->closeCursor();

                        $_SESSION = array();
                        if (ini_get("session.use_cookies")) 
                        {
                            setcookie(session_name(), '', time()-42);
                        }
                        session_destroy();

                        session_start();
                        if (ini_get("session.use_cookies"))
                        {
                            setcookie(session_name(), '', time()+86400);
                        }
                        $_SESSION["role"] = $user->role;
                        $_SESSION["prenom"] = $user->prenom;
                    }
                    else
                    {
                        $_SESSION["logerror"] = 3;
                    }

                }
                //Fermeture du curseur sur le résultat
                $result->closeCursor();
                //Ferme la connexion vers la base de donnée
                $db = null;
            }
            else
            {
                $_SESSION["logerror"] = 1;
            }
        }
    }
    else
    {
        $_SESSION["logerror"] = 0;
    }
    header("Location: login_form.php");
?>