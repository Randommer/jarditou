<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");

    if (!verifrole($_SESSION["role"], array(1)))
    {
        header("Location: 403.php");
    }

    //donne un nom à la page, que le header utilisera
    $Titre = "Êtes-vous sûr ?";
    //donne la position de la page dans le menu du header
    $nav = 2;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<?php
    //Inclusion d'un fonction de connexion à la base de données
    require("connexion_bdd.php");

    //Appel de la fonction de connexion
    $db = connexionBase();
    //Récupération de l'ID produit passé en GET
    $get_id = $_GET["id"];
    //Préparation de la requete à envoyer à la base de donnée
    $requete = "SELECT jpro_id as 'id', jpro_photo as 'photo', jpro_ref as 'ref', jpro_jcat_id as 'cat_id', jpro_libelle as 'libelle', jpro_description as 'description', jpro_prix as 'prix', jpro_stock as 'stock', jpro_couleur as 'couleur', jpro_bloque as 'bloque', jpro_d_ajout as 'ajout', jpro_d_modif as 'modif' FROM jproduits WHERE jpro_id = :id";
    $result = $db->prepare($requete);

    //On met les données récupérées dans la requete
    $result->bindValue(":id", $get_id);

    //Exécute la requete
    $result->execute();

    //Gestion d'erreurs si la requete pose problème
    if (!$result)
    {
        $tableauErreurs = $db->errorInfo();
        echo $tableauErreur[2];
        die("Erreur dans la requête");
    }

    //Gestion si le résultat de la requete est vide
    if ($result->rowCount() == 0)
    {
        echo "L'ID ".$_GET["id"]." ne correspond à aucun produit de la base";
    }
    else
    {
        //Récupération en objet du produit demandé en requete
        $produit = $result->fetch(PDO::FETCH_OBJ);
        //Fermeture du curseur sur le résultat
        $result->closeCursor();

    ?>
    <!-- l'entête de notre formulaire contiendra l'image du produit -->
    <div class="row mx-0 mb-1">
        <div class="col-4"></div>
        <div class="col-4">
            <!-- On crée une balise image avec l'adresse préremplie, à laquelle on ajoute le ID produit et l'extension photo trouvés donnés par la base -->
            <img class='img-fluid' src='src/img/<?php echo $produit->id.".".$produit->photo; ?>' alt='<?php echo $produit->libelle." ".$produit->couleur; ?>'>
        </div>
        <div class="col-4"></div>
    </div>
    <!-- On écrit en gros le Libellé du produit pour que l'utilisateur sache qu'elle produit possiblement supprimer -->
    <div class="row mx-0 mb-1">
        <div class="col-4"></div>
        <div class="col-4">
            <h1><?php echo $produit->libelle; ?></h1>
        </div>
        <div class="col-4"></div>
    </div>
    <!-- On demande à l'utilisateur si il est sûr de vouloir supprimer le produit de la base -->
    <div class="row mx-0 mb-1">
        <div class="d-sm-none d-lg-block col-lg-3"></div>
        <div class="col-sm-12 col-lg-5">
            <p>
                Êtes vous sûr de vouloir supprimer <?php echo $produit->libelle; ?> de la base de données ?
            </p>
        </div>
        <div class="d-sm-none d-lg-block col-lg-2"></div>
    </div>
    <!-- Boutons en bas de page pour quitter la page de Delete -->
    <div class="row mx-0 mb-1">
        <div class="d-sm-none d-lg-block col-lg-4"></div>
        <div class="col-sm-12 col-lg-4">

            <!-- On crée un formulaire -->
            <!-- Le champ a sa value remplie avec la valeur obtenue dans la base -->
            <!-- Le formulaire enverra les données en POST sur le script delete_script.php supprimera le produit de la base -->
            <form action="delete_script.php" method="POST">

                <!-- Champ ID du produit, ici hidden pour l'envoyer en POST sans avoir à l'afficher -->
                <input type="hidden" name="id" id="id" value="<?php echo $produit->id; ?>">

                <!-- Bouton Annuler qui envoie à la page de la liste des produits -->
                <a href="liste.php" title="Retour">
                    <button type="button" class="btn btn-secondary">
                        <i class="fa fa-fw fa-arrow-left"></i> Retour
                    </button>
                </a>

                <!-- Bouton Supprimer de type submit qui envoie sur l'ID du produit en POST à un Script PHP qui le supprimera de la base (voir delete_script.php) -->
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-fw fa-trash"></i> Supprimer
                </button>
            </form>
        </div>
        <div class="d-sm-none d-lg-block col-lg-4"></div>
    </div>
    <?php
    }
    //Le footer du site sera ici
    require("footer.php");
?>