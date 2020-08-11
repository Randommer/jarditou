<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Suppression dans la base";
    //donne la position de la page dans le menu du header
    $nav = 2;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <!-- Message à l'utilisateur si la base de données met du temps à répondre -->
    <p>
        Votre produit se supprime de la base de données, vous allez être redirigé.
    </p>
</div>
<?php
    //on verifie si un POST a été envoyé à la page
    if ($_SERVER["REQUEST_METHOD"] == "POST" )
    {
        //on vérifie que le champ ID a été renseigné
        if (empty($_POST["id"]))
        {
            //on redirige le navigateur vers la liste produit
            header("Location: liste.php");
        }
        else //le champ ID est renseigné
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

            //Inclusion d'un fonction de connexion à la base de donnéee
            require("connexion_bdd.php");

            //on verifie qu'il n'y aucune erreur dans les données
            if ($verif)
            {
                //Appel de la fonction de connexion
                $db = connexionBase();

                //Préparation de la requète à envoyer à la base de donnée
                $requete = $db->prepare("DELETE FROM produits WHERE pro_id = :pro_id");

                //On met les données récupérées dans la requète
                $requete->bindValue(":pro_id", $pro_id);

                
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