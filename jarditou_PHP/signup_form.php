<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");
    //donne un nom à la page, que le header utilisera
    $Titre = "Inscription";
    //donne la position de la page dans le menu du header
    $nav = 5;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<?php
    if (verifrole($_SESSION["role"], array(0)))
    {
        if (isset($_SESSION["compte"]))
            {
?>
                <div class="row mx-0 my-sm-2 my-lg-4">
                    <div class="d-sm-none d-lg-block col-lg-4"></div>
                    <div class="col-sm-12 col-lg-4 border shadow">
                        <h2 class="text-success font-weight-bold text-center">Félicitation</h2>
                        <hr>
                        <div class="alert alert-success">
                            <p class="text-justify">Vous avez désormais un compte chez nous.</p>
                            <p class="text-justify">Vous pouvez maintenant vous connecter.</p>
                        </div>
                        <div class="text-center mb-2">
                            <a href="login_form.php" title="Connexion">
                                <button type="button" class="btn btn-primary">
                                    <i class="fa fa-fw fa-plug"></i> Connexion
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="d-sm-none d-lg-block col-lg-4"></div>
                </div>
        <?php } else { ?>
                <div class="row mx-0 my-2">
                    <div class="d-sm-none d-lg-block col-lg-3"></div>
                    <div class="col-sm-12 col-lg-6 border shadow">
                        <h2 class="text-primary font-weight-bold text-center">Inscription</h2>

                        <?php if (isset($_SESSION["signerror"])) { ?>
                            <div class="alert alert-danger">
                                <h3 class="font-weight-bold">Erreur</h3>
                                <hr>
                                <p class="text-justify">
                                    <?php if ($_SESSION["signerror"] == 0) { ?>
                                    Problème de connexion.
                                    <?php } if ($_SESSION["signerror"] == 1) { ?>
                                    Erreur dans les données envoyées.
                                    <?php } if ($_SESSION["signerror"] == 2) { ?>
                                    La vérification du Mot de passe a échoué.
                                    <?php } if ($_SESSION["signerror"] == 3) { ?>
                                    Ce login est déjà pris.
                                    <?php } if ($_SESSION["signerror"] == 4) { ?>
                                    Cet e-mail est déjà lié à un compte utilisateur.
                                    <?php } ?>
                                </p>
                            </div>
                        <?php } else { ?>
                        <hr>
                        <?php }
                        $_SESSION["signerror"] = null;
                        unset($_SESSION["signerror"]);
                        ?>
                        <form action="signup_script.php" method="POST" id="signup" validate>
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Toto" pattern="[\w\-]{3,50}" required value="">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Dupont" pattern="[\w\-]{3,50}" required value="">
                            </div>
                            <div class="form-group">
                                <label for="mail">E-mail</label>
                                <input type="text" class="form-control" name="mail" id="mail" placeholder="toto.dupont@website.com" required value="">
                            </div>
                            <div class="form-group">
                                <label for="log">Identifiant</label>
                                <input type="text" class="form-control" name="log" id="log" placeholder="totodu42" pattern="[\w\-]{3,50}" required value="">
                            </div>
                            <div class="form-group">
                                <label for="mdp">Mot de passe</label>
                                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="D3sL3ttr3s3tD3sChiffr3s" pattern="^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$" required value="">
                            </div>
                            <div class="form-group">
                                <label for="password">Confirmation du mot de passe</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="" pattern="^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$" required value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-fw fa-user-plus"></i> Inscription
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="d-sm-none d-lg-block col-lg-3"></div>
                </div>
    <?php
        }
        $_SESSION["compte"] = null;
        unset($_SESSION["compte"]);
    } else {
    ?>
        <div class="row mx-0 my-sm-2 my-lg-4">
            <div class="d-sm-none d-lg-block col-lg-4"></div>
            <div class="col-sm-12 col-lg-4 border shadow">
                <h2 class="text-success font-weight-bold text-center">Bienvenue</h2>
                <hr>
                <div class="alert alert-success">
                    <p class="text-justify">Vous avez déjà un compte et vous êtes connecté.</p>
                </div>
            </div>
            <div class="d-sm-none d-lg-block col-lg-4"></div>
        </div>
<?php } ?>

<!-- Appel du fichier JavaScript de vérification du formulaire de Connexion 
<script src="assets/js/log.js"></script> -->

<?php
    //Le footer du site sera ici
    require("footer.php");
?>