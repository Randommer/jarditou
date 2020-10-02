<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS des icons Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Lien vers style CSS écran normal -->
    <link rel="stylesheet" media="screen and (min-width: 992px)" href="assets/css/styles.css">
    <!-- Lien vers style CSS écran mobile -->
    <link rel="stylesheet" media="screen and (max-width: 992px)" href="assets/css/mobile.css">
    <title>JardiTou - <?php echo $Titre;//reprend le titre que la page lui donne ?></title>
    
</head>
<body>
    <!-- Container du site -->
    <div class="container">
        <!-- Barre de titre du site -->
        <div class="row d-none d-lg-flex align-items-center">
            <!-- Logo du site -->
            <div class="col-sm-12 col-lg-3">
                <a href="index.php" title="JardiTou"><img class="img-fluid" src="src/img/jarditou_logo.jpg" alt="Logo JardiTou"></a>
            </div>
            <div class="d-sm-none d-lg-block col-lg-4"></div>
            <!-- Slogan du site -->
            <div class="col-sm-12 col-lg-5">
                <h1 class="text-center">La qualité depuis 70 ans</h1>
            </div>
        </div>
        <!-- Barre de navigation haute du site -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">JardiTou.com</a>
            <!-- Bouton Burger pour la version mobile de la barre -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHaute">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Boutons du menu -->
            <div class="collapse navbar-collapse" id="navbarHaute">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($nav == 1) { echo "active"; }//active le bouton que la page lui donne ?>">
                        <a class="nav-link" href="index.php" title="Accueil">
                            <i class="fa fa-fw fa-home"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item <?php if ($nav == 2) { echo "active"; }//active le bouton que la page lui donne ?>">
                        <a class="nav-link" href="liste.php" title="Tableau">
                            <i class="fa fa-fw fa-list"></i> Tableau
                        </a>
                    </li>
                    <li class="nav-item <?php if ($nav == 3) { echo "active"; }//active le bouton que la page lui donne ?>">
                            <a class="nav-link" href="contact.php" title="Contact">
                                <i class="fa fa-fw fa-envelope"></i> Contact
                            </a>
                        </li>
                </ul>
            </div>
            <!-- Champ de recherche du menu -->
            <form class="form-inline d-none d-lg-block my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Votre promotion" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <i class="fa fa-fw fa-search"></i> Rechercher
                </button>
            </form>
            <!-- Bouton de Connexion/Déconnexion -->
            <div>
                <?php if ($_SESSION["role"] == 0) { ?>
                    <a href="login_form.php" title="Connexion">
                        <button type="button" class="btn btn-<?php if ($nav == 4) { echo "outline-"; } ?>primary ml-sm-0 ml-lg-2 <?php if ($nav == 4) { echo "font-weight-bold"; } ?>" id="logbut">
                            <i class="fa fa-fw fa-user" id="logicon"></i> Connexion
                        </button>
                    </a>
                <?php } else { ?>
                    <form action="logout_script.php" method="POST">
                        <button type="submit" class="btn btn-outline-danger ml-sm-0 ml-lg-2" id="logbut">
                            <i class="fa fa-fw fa-user" id="logicon"></i> Déconnexion
                        </button>
                    </form>
                <?php } ?>
            </div>
        </nav>
        <?php if ($nav < 4 && $_SESSION["role"] == 0) { ?>
        <!-- Bannière promo du site -->
        <div class="row">
            <div class="col-sm-12"><img class="img-fluid" src="src/img/promotion.jpg" alt="Bannière de promotion"></div>
        </div>
        <?php } ?>