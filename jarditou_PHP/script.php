<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <!-- Partie article de la page -->
    <div  class="col-sm-12 mb-2">
        <h1>Le formulaire est valide !!!</h1>
        <dl>
            <dt>Nom : </dt>
            <dd>
                <?php echo $nom;//affiche le nom ?>
            </dd>

            <dt>Prénom : </dt>
            <dd>
                <?php echo $prenom;//affiche le prénom ?>
            </dd>

            <dt>Sexe : </dt>
            <dd>
                <?php echo $sexe;//affiche le sexe coché ?>
            </dd>

            <dt>Date de Naissance : </dt>
            <dd>
                <?php echo date_format($naissance, "j F Y");//affiche la date de naissance dans un format lisible ?>
            </dd>

            <dt>Code Postal : </dt>
            <dd>
                <?php echo substr($CP, 0, 2)." ".substr($CP, 2);//affiche le code poste avec un espace entre le département et le reste ?>
            </dd>

            <?php
                //si l'utilisateur a rentré une adresse, affiche l'adresse
                if ($adresse != "")
                {
            ?>
                    <dt>Adresse : </dt>
                    <dd>
                        <?php echo $adresse; ?>
                    </dd>
            <?php
                }
                
                //si l'utilisateur a rentré une ville, affiche la ville
                if ($ville != "")
                {
            ?>
                    <dt>Ville : </dt>
                    <dd>
                        <?php echo $ville; ?>
                    </dd>
            <?php
                }
            ?>

            <dt>Email : </dt>
            <dd>
                <?php echo $email;//affiche le mail ?>
            </dd>

            <dt>Sujet : </dt>
            <dd>
                <?php echo $sujet;//affiche le sujet sélectionné ?>
            </dd>

            <dt>Votre Question : </dt>
            <dd>
                <?php echo $question;//affiche la question écrite ?>
            </dd>

            <dt>J'accepte : </dt>
            <dd>
                <?php
                    //vérifie si l'utilisateur a coché j'accepte et affiche OUI !!!
                    if ($accepted == true)
                    {
                        echo "OUI !!!";
                    }
                    else //else qui ne sert à rien, car normalement l'une des condition qui doit être remplie pour appeler ce code est que $accepted soit true
                    {
                        echo "Normalement c'est impossible d'avoir ce message, normalement...";
                    }
                ?>
            </dd>
        </dl>
    </div>
</div>