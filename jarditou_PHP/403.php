<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");

    header("Refresh:5;URL=index.php");

    //donne un nom à la page, que le header utilisera
    $Titre = "Erreur 403";
    //donne la position de la page dans le menu du header
    $nav = null;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 my-2">
    <div class="d-sm-none d-lg-block col-lg-4"></div>
    <div class="col-sm-12 col-lg-4 border shadow">
        <h2 class="text-warning font-weight-bold text-center">Erreur 403</h2>
        <div class="alert alert-warning">
            <h3 class="font-weight-bold">Accès interdit</h3>
            <hr>
            <p class="text-justify">Vous n'avez pas les permissions pour accèder à cette page.</p>
            <p class="text-justify"> Vous allez être redirigé dans 5 secondes.</p>
        </div>
    </div>
    <div class="d-sm-none d-lg-block col-lg-4"></div>
</div>

<?php
    //Le footer du site sera ici
    require("footer.php");
?>