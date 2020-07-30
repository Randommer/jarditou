<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification du Formulaire</title>
</head>
<body>
    <?php
        //check
        $check = true;
        $errors = array();

        //Nom
        if (empty($_POST["nom"]))
        {
            $errors[] = "Entrez un nom valide.";
        }

        //Prénom
        if (empty($_POST["prenom"]))
        {
            $errors[] = "Entrez un prénom valide.";
        }

        //Sexe
        if (empty($_POST["sexe"]))
        {
            $errors[] = "Selectionnez un sexe.";
        }

        //Date de Naissance
        if (empty($_POST["naissance"]))
        {
            $errors[] = "Selectionnez une date.";
        }
        else
        {
            //echo var_dump($_POST["naissance"]);
            $naissance = date_create_from_format("Y-m-d", $_POST["naissance"]);
            $dfiff = date_diff(date_create(), $naissance);
            if (intval($dfiff->format("%R%a")) >= 0)
            {
                $errors[] = "A part si vous êtes né dans le futur, selectionnez une date passée ;-)";
            }
        }

        //Code Postal
        if (empty($_POST["CP"]))
        {
            $errors[] = "Entrez un Code Postal valide";
        }
        else
        {
            if (strspn($_POST["CP"], "0123456789") != 5 )
            {
                $errors[] = "Entrez un Code Postal valide";
            }
        }

        //Mail
        if (empty($_POST["email"]))
        {
            $errors[] = "Entrez une adresse e-mail valide.";
        }
        else
        {
            if (preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $_POST["email"]) == false)
            {
                $errors[] = "Entrez une adresse e-mail valide.";
            }
        }

        //Sujet
        if (empty($_POST["sujet"]))
        {
            $errors[] = "Selectionnez un sujet pour votre demande.";
        }

        //Question
        if (empty($_POST["question"]))
        {
            $errors[] = "Formulez votre demande en quelques mots s'il vous plait.";
        }

        //J'accepte
        if (empty($_POST["accepted"]))
        {
            $errors[] = "Cocher la case \"J'accepte\" est obligatoire.";
        }

        //test check
        if (count($errors) == 0)
        {
            //Affichage form
            echo "<h1>Le formulaire est valide !!!</h1>";
            /* foreach ($_POST as $champ => $contenu)
            {
                echo "<p>".$champ." : ".$contenu."</p>";
            } */
            echo "<p>Nom : ".$_POST["nom"]."</p>";
            echo "<p>Prénom : ".$_POST["prenom"]."</p>";
            echo "<p>Sexe : ".$_POST["sexe"]."</p>";
            echo "<p>Date de Naissance : ".date_format($naissance, "j F Y")."</p>";
            echo "<p>Code Postal : ".substr($_POST["CP"],0,2)." ".substr($_POST["CP"],2)."</p>";
            if (empty($_POST["adresse"]) != true) { echo "<p>Adresse : ".$_POST["adresse"]."</p>"; }
            if (empty($_POST["ville"]) != true) { echo "<p>Ville : ".$_POST["ville"]."</p>"; }
            echo "<p>Email : ".$_POST["email"]."</p>";
            echo "<p>Sujet : ".$_POST["sujet"]."</p>";
            echo "<p>Votre Question : ".$_POST["question"]."</p>";
            echo "<p>J'accepte : ".$_POST["accepted"]."</p>";
        }
        else
        {
            //Affichage erreurs
            echo "<h1>Le formulaire n'est pas rempli correctement, il contient les erreurs suivantes :</h1>";
            echo "<ul>";
            foreach ($errors as $erreur)
            {
                echo "<li>".$erreur."</li>";
            }
            echo "</ul>";
        }
    ?>
</body>
</html>