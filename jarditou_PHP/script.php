<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <!-- Partie article de la page -->
    <div  class="col-sm-12 mb-2">
        <h1>Le formulaire est valide !!!</h1>
        <dl>
            <dt>Nom : </dt>
            <dd>
                <?php echo $nom; ?>
            </dd>

            <dt>Prénom : </dt>
            <dd>
                <?php echo $prenom; ?>
            </dd>

            <dt>Sexe : </dt>
            <dd>
                <?php echo $sexe; ?>
            </dd>

            <dt>Date de Naissance : </dt>
            <dd>
                <?php echo date_format($naissance, "j F Y"); ?>
            </dd>

            <dt>Code Postal : </dt>
            <dd>
                <?php echo substr($CP, 0, 2)." ".substr($CP, 2); ?>
            </dd>

            <?php
                if ($adresse != "")
                {
                    echo "<dt>Adresse : </dt>";
                    echo "<dd>";
                    echo $adresse;
                    echo "</dd>";
                }
                if ($ville != "")
                {
                    echo "<dt>Ville : </dt>";
                    echo "<dd>";
                    echo $ville;
                    echo "</dd>";
                }
            ?>

            <dt>Email : </dt>
            <dd>
                <?php echo $email; ?>
            </dd>

            <dt>Sujet : </dt>
            <dd>
                <?php echo $sujet; ?>
            </dd>

            <dt>Votre Question : </dt>
            <dd>
                <?php echo $question; ?>
            </dd>

            <dt>J'accepte : </dt>
            <dd>
                <?php
                    if ($accepted == true)
                    {
                        echo "OUI !!!";
                    }
                    else
                    {
                        echo "Normalement c'est impossible d'avoir ce message, normalement...";
                    }
                ?>
            </dd>
        </dl>
    </div>
</div>