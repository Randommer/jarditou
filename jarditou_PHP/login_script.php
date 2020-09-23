<?php
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

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["login"]) || empty($_POST["mdp"]))
        {
            header("Location: login.php");
        }
        else
        {
            $verif = true;

            $post_login = verifstring($_POST["login"]);
            /*if (preg_match(, $post_login) == false)
            {
                $verif = false;
            }*/

            $post_mdp = verifstring($_POST["mdp"]);
            /*if (preg_match(, $post_mdp) == false)
            {
                $verif = false;
            }*/

            require("connexion_bdd.php");

            if ($verif)
            {
                $db = connexionBase();
                $result = $db->prepare("SELECT jusr_mdp as 'mdp' FROM jusers WHERE jusr_login = :jlogin");

                $result->bindValue(":jlogin", $post_login);

                $result->execute();

                if ($result->rowCount() == 0)
                {
                    echo "Pas d'utilisateur avec ce login.";
                }
                else
                {
                    $user = $result->fetch(PDO::FETCH_OBJ);

                    echo $user->mdp;
                }
            }
            else
            {
                echo "Erreur dans les données envoyées.";
            }
        }
    }
    //header("Location: login.php");
?>