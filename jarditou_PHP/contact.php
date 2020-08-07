<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Contact";
    //donne la position de la page dans le menu du header
    $nav = 3;
    //Le header du site sera ici
    require("header.php");
?>
<?php
    //initialisation des variables qui garderont en mémoire le contenu des champs
    $nom = $prenom = $sexe = $naissance = $CP = $adresse = $ville = $email = $sujet = $question = "";
    $accepted = false;

    //variables sur le statut d'un champ, -1 pas de données POST à prendre en compte, 0 la valeur trouver dans le champ n'est pas valide, 1 le contenu du champ est valide
    $nomval = $prenomval = $sexeval = $naissanceval = $CPval = $emailval = $sujetval = $questionval = $acceptedval = -1;

    //variables à changer en fonction des boutons radio et du select
    $fem = $mas = $neu = false;
    $sj1 = true;
    $sj2 = $sj3 = $sj4 = $sj5 = false;

    //on verifie si un POST a été envoyé à la page
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //on admet que tout les champs sont valides, puis on test si ils ne le sont pas
        $nomval = $prenomval = $sexeval = $naissanceval = $CPval = $emailval = $sujetval = $questionval = $acceptedval = 1;

        //test pour le champ Nom
        if (empty($_POST["nom"]))
        {
            $nomval = 0;
        }
        else
        {
            $nom = $_POST["nom"];
        }
        
        //test pour le champ Prénom
        if (empty($_POST["prenom"]))
        {
            $prenomval = 0;
        }
        else
        {
            $prenom = $_POST["prenom"];
        }

        //test pour le champ Sexe
        if (empty($_POST["sexe"]))
        {
            $sexeval = 0;
        }
        else
        {
            $sexe = $_POST["sexe"];
            //switch pour garder le meme bouton radio sélectionner qu'à envoie précédent
            switch ($sexe)
            {
                case "feminin":
                    $fem = true;
                break;

                case "masculin":
                    $mas = true;
                break;

                default:
                    $neu = true;
            }
        }

        //test du champ Date de Naissance
        if (empty($_POST["naissance"]))
        {
            $naissanceval = -2;
        }
        else
        {
            //enregitrement de la Date de Naissance dans une variable de type date
            $naissance = date_create_from_format("Y-m-d", $_POST["naissance"]);
            //test si la date n'est pas du futur
            $dfiff = date_diff(date_create(), $naissance);
            if (intval($dfiff->format("%R%a")) >= 0)
            {
                $naissanceval = 0;
            }
        }
        
        //test du champ Code Postal
        if (empty($_POST["CP"]))
        {
            $CPval = 0;
        }
        else
        {
            $CP = $_POST["CP"];
            //test si le Code Postal est bien composé de 5 chiffres
            if (strspn($CP, "0123456789") != 5 )
            {
                $CPval = 0;
            }
        }
        
        $adresse = $_POST["adresse"];
        $ville = $_POST["ville"];

        //test du champ Email
        if (empty($_POST["email"]))
        {
            $emailval = 0;
        }
        else
        {
            $email = $_POST["email"];
            //test si l'Email est correspond à l'expression régulière d'un mail
            if (preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $email) == false)
            {
                $emailval = 0;
            }
        }
        
        //test du champ Sujet
        if (empty($_POST["sujet"]))
        {
            $sujetval = 0;
        }
        else
        {
            $sujet = $_POST["sujet"];
            //switch pour garder le meme select sélectionner qu'à envoie précédent
            $sj1 = false;
            switch ($sujet)
            {
                case "commandes":
                    $sj2 = true;
                break;

                case "question":
                    $sj3 = true;
                break;

                case "reclamation":
                    $sj4 = true;
                break;

                case "autres":
                    $sj5 = true;
                break;

                default:
                    $sj1 = false;
            }
        }

        //test du champ Votre Question
        if (empty($_POST["question"]))
        {
            $questionval = 0;
        }
        else
        {
            $question = $_POST["question"];
        }

        //test du champ J'accepte
        if (empty($_POST["accepted"]))
        {
            $acceptedval = 0;
        }
        else
        {
            $accepted = $_POST["accepted"];
        }
    }
?>
<?php
    //test si tout les champs obligatoire sont correctement remplis, si ils le sont, la page affichera les données reçues par le serveurs, sinon elle affichera le formulaire
    if ($nomval == 1 && $prenomval == 1 && $sexeval == 1 && $naissanceval == 1 && $CPval == 1 && $emailval == 1 && $sujetval == 1 && $questionval == 1 && $acceptedval == 1)
    {
        require("script.php");
    }
    else
    {
        require("form.php");
    }
?>
<?php
    //Le footer du site sera ici
    require("footer.php");
?>