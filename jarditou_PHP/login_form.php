<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");
    //donne un nom à la page, que le header utilisera
    $Titre = "Connexion";
    //donne la position de la page dans le menu du header
    $nav = 4;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 my-sm-2 my-lg-4">
    <div class="d-sm-none d-lg-block col-lg-4"></div>
    <div class="col-sm-12 col-lg-4 border shadow">
        <?php if (verifrole($_SESSION["role"], array(0))) { ?>
            <h2 class="text-primary font-weight-bold text-center">Connexion</h2>
            
            <?php if (isset($_SESSION["logerror"])) { ?>
                <div class="alert alert-danger">
                    <h3 class="font-weight-bold">Erreur</h3>
                    <hr>
                    <p class="text-justify">
                        <?php if ($_SESSION["logerror"] == 0) { ?>
                        Problème de connexion.
                        <?php } if ($_SESSION["logerror"] == 1) { ?>
                        Erreur dans les données envoyées.
                        <?php } if ($_SESSION["logerror"] == 2) { ?>
                        Erreur de login.
                        <?php } if ($_SESSION["logerror"] == 3) { ?>
                        Erreur de login/mot de passe.
                        <?php } ?>
                    </p>
                </div>
            <?php } else { ?>
            <hr>
            <?php }
            $_SESSION["logerror"] = null;
            unset($_SESSION["logerror"]);
            ?>
            <form action="login_script.php" method="POST" id="login" validate>
                <div class="form-group">
                    <label for="log">Identifiant</label>
                    <input type="text" class="form-control" name="log" id="log" placeholder="login" pattern="[\w\-]{3,50}" required value="">
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control" name="mdp" id="mdp" placeholder="mot de passe" pattern="^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$" required value="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-fw fa-plug"></i> Connexion
                    </button>
                </div>
            </form>
            <hr>
            <p class="text-justify">Pas encore de compte ? Créez un <a href="signup_form.php" title="Inscription">compte</a>.</p>
        <?php } else { ?>
            <h2 class="text-success font-weight-bold text-center">Bienvenue</h2>
            <hr>
            <div class="alert alert-success">
                <p class="text-justify">Vous êtes bien connecté <?php echo $_SESSION["prenom"]; ?>.</p>
            </div>
        <?php } ?>
    </div>
    <div class="d-sm-none d-lg-block col-lg-4"></div>
</div>

<!-- Appel du fichier JavaScript de vérification du formulaire de Connexion 
<script src="assets/js/log.js"></script> -->

<?php
    //Le footer du site sera ici
    require("footer.php");
?>