<?php
    $Titre = "Contact";
    include("header.php");
?>
<?php
    $nom = $prenom = $sexe = $naissance = $CP = $adresse = $ville = $email = $sujet = $question = "";
    $accepted = false;

    $nomval = $prenomval = $sexeval = $naissanceval = $CPval = $emailval = $sujetval = $questionval = $acceptedval = -1;

    $fem = $mas = $neu = false;
    $sj1 = true;
    $sj2 = $sj3 = $sj4 = $sj5 = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nomval = $prenomval = $sexeval = $naissanceval = $CPval = $emailval = $sujetval = $questionval = $acceptedval = 1;

        if (empty($_POST["nom"]))
        {
            $nomval = 0;
        }
        else
        {
            $nom = $_POST["nom"];
        }
        
        if (empty($_POST["prenom"]))
        {
            $prenomval = 0;
        }
        else
        {
            $prenom = $_POST["prenom"];
        }

        if (empty($_POST["sexe"]))
        {
            $sexeval = 0;
        }
        else
        {
            $sexe = $_POST["sexe"];
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

        if (empty($_POST["naissance"]))
        {
            $naissanceval = -2;
        }
        else
        {
            $naissance = date_create_from_format("Y-m-d", $_POST["naissance"]);
            $dfiff = date_diff(date_create(), $naissance);
            if (intval($dfiff->format("%R%a")) >= 0)
            {
                $naissanceval = 0;
            }
        }
        
        if (empty($_POST["CP"]))
        {
            $CPval = 0;
        }
        else
        {
            $CP = $_POST["CP"];
            if (strspn($CP, "0123456789") != 5 )
            {
                $CPval = 0;
            }
        }
        
        $adresse = $_POST["adresse"];
        $ville = $_POST["ville"];

        if (empty($_POST["email"]))
        {
            $emailval = 0;
        }
        else
        {
            $email = $_POST["email"];
            if (preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $email) == false)
            {
                $emailval = 0;
            }
        }
        
        if (empty($_POST["sujet"]))
        {
            $sujetval = 0;
        }
        else
        {
            $sujet = $_POST["sujet"];
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

        if (empty($_POST["question"]))
        {
            $questionval = 0;
        }
        else
        {
            $question = $_POST["question"];
        }

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
    if ($nomval == 1 && $prenomval == 1 && $sexeval == 1 && $naissanceval == 1 && $CPval == 1 && $emailval == 1 && $sujetval == 1 && $questionval == 1 && $acceptedval == 1)
    {
        include("script.php");
    }
    else
    {
        include("form.php");
    }
?>
<?php
    include("footer.php");
?>