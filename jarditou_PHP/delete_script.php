<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");
    
    //on vérifie si un POST a été envoyé à la page
    if ($_SERVER["REQUEST_METHOD"] == "POST" )
    {
        //on vérifie que le champ ID a été renseigné
        if (empty($_POST["id"]))
        {
            //on redirige le navigateur vers la liste produit
            header("Location: liste.php");
            exit;
        }
        else //le champ ID est renseigné
        {
            //Initialisation d'un booléen qui déterminera la validité ou non des données POST
            //si il est vrai, on pourra faire appel à la base de donnée
            //si il est faux, on donnera un message d'erreur et on redirige le navigateur vers la liste produit
            $verif = true;

            //on vérifie que ID est une valeur numérique, supérieur à 0
            if (is_numeric($_POST["id"]) && $_POST["id"] > 0)
            {
                //les valeurs POST sont des chaines de caractères, on change ID en entier et le stock dans une variable
                $post_id = intval($_POST["id"]);
            }
            else //ID n'est pas numérique ou supérieur à 0
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
                $requete = $db->prepare("DELETE FROM jproduits WHERE jpro_id = :id");

                //On met les données récupérées dans la requete
                $requete->bindValue(":id", $post_id);

                
                //Exécute la requete
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
    exit;
?>