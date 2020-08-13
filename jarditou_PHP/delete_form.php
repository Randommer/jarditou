<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Êtes-vous sûr ?";
    //donne la position de la page dans le menu du header
    $nav = 2;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<?php
    //Inclusion d'un fonction de connexion à la base de donnéee
    require("connexion_bdd.php");

    //Appel de la fonction de connexion
    $db = connexionBase();
    //Récupération de l'ID produit passé en GET
    $pro_id = $_GET["id"];
    //Ecriture de la requète à envoyer à la base de donnée
    $requete = "SELECT * FROM produits WHERE pro_id=".$pro_id;

    //Envoie de la requète à la base
    $result = $db->query($requete);

    //Gestion d'erreurs si la requète pose problème
    if (!$result)
    {
        $tableauErreurs = $db->errorInfo();
        echo $tableauErreur[2];
        die("Erreur dans la requête");
    }

    //Gestion si le résultat de la requète est vide
    if ($result->rowCount() == 0)
    {
        echo "L'ID ".$_GET["id"]." ne correspond à aucun produit de la base";
    }
    else
    {
        //Récupération en objet du produit demandé en requète
        $produit = $result->fetch(PDO::FETCH_OBJ);
        //Fermeture du curseur sur le résultat
        $result->closeCursor();

    ?>
    <!-- l'entête de notre formulaire contiendra l'image du produit -->
    <div class="row mx-0 mb-1">
        <div class="col-4"></div>
        <div class="col-4">
            <!-- On crée une balise image avec l'adresse préremplie, à laquelle on ajoute le ID produit et l'extension photo trouvés donnés par la base -->
            <img class='img-fluid' src='src/img/<?php echo $produit->pro_id.".".$produit->pro_photo; ?>' alt='<?php echo $produit->pro_libelle." ".$produit->pro_couleur; ?>'>
        </div>
        <div class="col-4"></div>
    </div>
    <!-- On écrit en gros le Libellé du produit pour que l'utilisateur sache qu'elle produit possiblement supprimer -->
    <div class="row mx-0 mb-1">
        <div class="col-4"></div>
        <div class="col-4">
            <h1><?php echo $produit->pro_libelle; ?></h1>
        </div>
        <div class="col-4"></div>
    </div>
    <!-- On demande à l'utilisateur si il est sûr de vouloir supprimer le prduit de la base -->
    <div class="row mx-0 mb-1">
        <div class="d-sm-none d-lg-block col-lg-3"></div>
        <div class="col-sm-12 col-lg-5">
            <p>
                Êtes vous sûr de vouloir supprimer <?php echo $produit->pro_libelle; ?> de la base de données ?
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

                <!-- Champ ID du produit, ici hidden pour l'envoyer en POST sans avor à l'afficher -->
                <input type="hidden" name="id" id="id" value="<?php echo $produit->pro_id; ?>">

                <!-- Bouton Annuler qui envoie à la page de la liste des produits -->
                <a href="liste.php" title="Annuler">
                    <button type="button" class="btn btn-success">Annuler</button>
                </a>

                <!-- Bouton Supprimer de type submit qui envoie sur l'ID du produit en POST à un Script PHP qui le supprimera de la base (voir delete_script.php) -->
                <input type="submit" class="btn btn-danger" value="Supprimer">
            </form>
        </div>
        <div class="d-sm-none d-lg-block col-lg-4"></div>
    </div>
    <?php
    }
    //Le footer du site sera ici
    require("footer.php");
?>