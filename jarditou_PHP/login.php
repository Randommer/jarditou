<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Connexion";
    //donne la position de la page dans le menu du header
    $nav = 4;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 my-2">
    <div class="d-sm-none d-lg-block col-lg-4"></div>
    <div class="col-sm-12 col-lg-4 border shadow">
        <h2 class="text-primary font-weight-bold">Connexion</h2>
        <form action="login_script.php" method="POST" id="" validate>
            <div class="form-group">
                <label for="login">Identifiant</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="login" required value="">
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="mot de passe" required value="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-fw fa-plug"></i> Connexion
                </button>
            </div>
        </form>
        <hr>
        <p class="text-justify">Pas encore de compte ? Créez un <a href="signup.php" title="Inscription">compte</a>.</p>
    </div>
    <div class="d-sm-none d-lg-block col-lg-4"></div>
</div>
<?php
    //Le footer du site sera ici
    require("footer.php");
?>