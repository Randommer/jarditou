<!-- Partie article de la page -->
<h1>Le formulaire est valide !!!</h1>
<p>
    Nom : <?php
        echo $nom;
    ?>
</p>
<p>
    Prénom : <?php
        echo $prenom;
    ?>
</p>
<p>
    Sexe : <?php
        echo $sexe;
    ?>
</p>
<p>
    Date de Naissance : <?php
        echo date_format($naissance, "j F Y");
    ?>
</p>
<p>
    Code Postal : <?php
        echo substr($CP, 0, 2)." ".substr($CP, 2);
    ?>
</p>
<?php
    if ($adresse != "")
    {
        echo "<p>Adresse : ".$adresse."</p>";
    }
    if ($ville != "")
    {
        echo "<p>Ville : ".$ville."</p>";
    }
?>
<p>
    Email : <?php
        echo $email;
    ?>
</p>
<p>
    Sujet : <?php
        echo $sujet;
    ?>
</p>
<p>
    Votre Question : <?php
        echo $question;
    ?>
</p>
<p>
    J'accepte : <?php
        if ($accepted == true)
        {
            echo "OUI !!!";
        }
        else
        {
            echo "Normalement c'est impossible d'avoir ce message, normalement...";
        }
    ?>
</p>