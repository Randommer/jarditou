<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");
    //donne un nom à la page, que le header utilisera
    $Titre = "Tableau";
    //donne la position de la page dans le menu du header
    $nav = 2;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <!-- Tableau responsive -->
    <table class="table table-bordered table-responsive-lg table-striped">
        <!-- Entête du tableau -->
        <thead class="thead-light">
            <?php
                //initialisation d'un tableau pour la gestion des flèches et des liens de tri
                $aff = array(false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false, false);
                //initialisation d'un marqueur pour le tableau
                $affkey = 0;
                ////Ecriture de la requete à envoyer à la base de donnée
                //on vérifie si il existe une valeur by via GET
                if (empty($_GET["by"]))
                {
                    //requete par défaut
                    $requete = "SELECT jpro_id as 'id', jpro_photo as 'photo', jpro_ref as 'ref', jpro_libelle as 'libelle', jpro_prix as 'prix', jpro_stock as 'stock', jpro_couleur as 'couleur', jpro_d_ajout as 'ajout', jpro_d_modif as 'modif', jpro_bloque as 'bloque' FROM jproduits WHERE ISNULL(jpro_bloque) ORDER BY jpro_d_ajout DESC";
                    
                    //On met les deux icones qui correspondent à la requete
                    $aff[14] = true;
                    $aff[18] = true;
                }
                else //il y a une valeur by via GET
                {
                    //on vérifie si by est une valeur numérique
                    if (is_numeric($_GET["by"]))
                    {
                        //on enregistre la valeur by dans le marqueur pour le tableau
                        $affkey = $_GET["by"];
                        //on met l'icone qui correspond au tri qu'on va mettre en requete
                        $aff[$affkey] = true;
                    }
                    //début de la requete
                    $requete = "SELECT jpro_id as 'id', jpro_photo as 'photo', jpro_ref as 'ref', jpro_libelle as 'libelle', jpro_prix as 'prix', jpro_stock as 'stock', jpro_couleur as 'couleur', jpro_d_ajout as 'ajout', jpro_d_modif as 'modif', jpro_bloque as 'bloque' FROM jproduits";
                    //en fonction de la valeur by, on change la fin de la requete
                    switch ($_GET["by"])
                    {
                        case 1:
                            $requete = $requete." ORDER BY jpro_id ASC";
                        break;

                        case 2:
                            $requete = $requete." ORDER BY jpro_id DESC";
                        break;

                        case 3:
                            $requete = $requete." ORDER BY jpro_ref ASC";
                        break;

                        case 4:
                            $requete = $requete." ORDER BY jpro_ref DESC";
                        break;

                        case 5:
                            $requete = $requete." ORDER BY jpro_libelle ASC";
                        break;

                        case 6:
                            $requete = $requete." ORDER BY jpro_libelle DESC";
                        break;

                        case 7:
                            $requete = $requete." ORDER BY jpro_prix ASC";
                        break;

                        case 8:
                            $requete = $requete." ORDER BY jpro_prix DESC";
                        break;

                        case 9:
                            $requete = $requete." ORDER BY jpro_stock ASC";
                        break;

                        case 10:
                            $requete = $requete." ORDER BY jpro_stock DESC";
                        break;

                        case 11:
                            $requete = $requete." ORDER BY jpro_couleur ASC";
                        break;

                        case 12:
                            $requete = $requete." ORDER BY jpro_couleur DESC";
                        break;

                        case 13:
                            $requete = $requete." ORDER BY jpro_d_ajout ASC";
                        break;

                        case 14:
                            $requete = $requete." ORDER BY jpro_d_ajout DESC";
                        break;

                        case 15:
                            $requete = $requete." WHERE jpro_d_modif IS NOT NULL ORDER BY jpro_d_modif ASC";
                        break;

                        case 16:
                            $requete = $requete." WHERE jpro_d_modif IS NOT NULL ORDER BY jpro_d_modif DESC";
                        break;

                        case 17:
                            $requete = $requete." WHERE jpro_bloque IS NOT NULL ORDER BY jpro_id ASC";
                        break;

                        case 18:
                            $requete = $requete." WHERE ISNULL(jpro_bloque) ORDER BY jpro_id ASC";
                        break;

                        default:
                        $requete = $requete." WHERE ISNULL(jpro_bloque) ORDER BY jpro_d_ajout DESC";
                        $aff[14] = true;
                        $aff[18] = true;
                    }
                    //un deuxième ORDER BY pour la requete
                    $requete = $requete.", jpro_id ASC";
                }
            ?>
            <tr class="text-center">
                <th class="align-middle">Photo</th>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[1]){echo 2;}else{echo 1;} ?>" title="Trier par ID">
                        ID<i class="fas fa-sort-<?php if($aff[1]){echo "up";} if($aff[2]){echo "down";} if(!$aff[1] && !$aff[2]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[3]){echo 4;}else{echo 3;} ?>" title="Trier par Référence">
                        Référence<i class="fas fa-sort-<?php if($aff[3]){echo "up";} if($aff[4]){echo "down";} if(!$aff[3] && !$aff[4]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[5]){echo 6;}else{echo 5;} ?>" title="Trier par Libellé">
                        Libellé<i class="fas fa-sort-<?php if($aff[5]){echo "up";} if($aff[6]){echo "down";} if(!$aff[5] && !$aff[6]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[7]){echo 8;}else{echo 7;} ?>" title="Trier par Prix">
                        Prix<i class="fas fa-sort-<?php if($aff[7]){echo "up";} if($aff[8]){echo "down";} if(!$aff[7] && !$aff[8]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[9]){echo 10;}else{echo 9;} ?>" title="Trier par Stock">
                        Stock<i class="fas fa-sort-<?php if($aff[9]){echo "up";} if($aff[10]){echo "down";} if(!$aff[9] && !$aff[10]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[11]){echo 12;}else{echo 11;} ?>" title="Trier par Couleur">
                        Couleur<i class="fas fa-sort-<?php if($aff[11]){echo "up";} if($aff[12]){echo "down";} if(!$aff[11] && !$aff[12]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[13]){echo 14;}else{echo 13;} ?>" title="Trier par Date d'ajout">
                        Date d'ajout<i class="fas fa-sort-<?php if($aff[13]){echo "up";} if($aff[14]){echo "down";} if(!$aff[13] && !$aff[14]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <?php if (verifrole($_SESSION["role"], array(1))) { ?>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[15]){echo 16;}else{echo 15;} ?>" title="Trier par Date de modification">
                        Date de modif<i class="fas fa-sort-<?php if($aff[15]){echo "up";} if($aff[16]){echo "down";} if(!$aff[15] && !$aff[16]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <th class="align-middle">
                    <a href="liste.php?by=<?php if($aff[17]) {echo '18" title="Ne pas ';}else{echo '17" title="';} ?>Afficher les Produits Bloqués">
                        Bloqué<i class="far fa-<?php if($aff[17]){echo "check-square";} if($aff[18]){echo "square";} if(!$aff[17] && !$aff[18]){echo " d-none";} ?> fa-xs"></i>
                    </a>
                </th>
                <?php } ?>
            </tr>
        </thead>
        <!-- Corps du tableau -->
        <tbody>
            <?php
                //Inclusion d'un fonction de connexion à la base de données
                require("connexion_bdd.php");

                //Appel de la fonction de connexion
                $db = connexionBase();
                //Ecriture de la requete à envoyer à la base de donnée
                //$requete = "SELECT jpro_id as 'id', jpro_photo as 'photo', jpro_ref as 'ref', jpro_libelle as 'libelle', jpro_prix as 'prix', jpro_stock as 'stock', jpro_couleur as 'couleur', jpro_d_ajout as 'ajout', jpro_d_modif as 'modif', jpro_bloque as 'bloque' FROM jproduits WHERE ISNULL(jpro_bloque) ORDER BY jpro_d_ajout DESC";

                //Envoie de la requete à la base
                $result = $db->prepare($requete);
                $result->execute();

                //Envoie de la requete à la base via query 
                //$result = $db->query($requete);

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
            ?>
                    <tr>
                        <td colspan='10'>
                            <h1 class='text-danger font-weight-bold'>
                                Le tableau est vide
                            </h1>
                        </td>
                    </tr>
            <?php
                }
                else
                {
                    //Récupération en objet d'une entrée du résultat par tour de boucle
                    while ($produit = $result->fetch(PDO::FETCH_OBJ))
                    {
            ?>
                        <!-- Ouverture d'une ligne du tableau -->
                        <tr class='text-center'>

                        <!-- Remplissage de la case avec une balise image -->
                        <td class='table-warning'>
                            <img src='src/img/<?php echo $produit->id.".".$produit->photo;?>' alt='<?php echo $produit->libelle." ".$produit->couleur; ?>' width='100'>
                        </td> <!-- Photo -->

                        <td><?php echo $produit->id; ?></td> <!-- ID -->
                        <td><?php echo $produit->ref; ?></td> <!-- Référence -->

                        <!-- Remplissage de la case avec un lien vers la page detail du produit -->
                        <td class="table-warning">
                            <a class='text-danger font-weight-bold' href='detail.php?id=<?php echo $produit->id; ?>' title='<?php echo $produit->libelle; ?>'>
                                <u>
                                    <?php echo strtoupper($produit->libelle); ?>
                                </u>
                            </a>
                        </td> <!-- Libellé -->

                        <td>
                            <?php
                                if($produit->prix == round($produit->prix))
                                {
                                    echo round($produit->prix);
                                }
                                else
                                {
                                    echo $produit->prix;
                                }
                            ?>€
                        </td> <!-- Prix -->
                        <td><?php echo $produit->stock; ?></td> <!-- Stock -->
                        <td><?php echo $produit->couleur; ?></td> <!-- Couleur -->
                        <td><?php echo $produit->ajout; ?></td> <!-- Ajout -->
                        <?php if (verifrole($_SESSION["role"], array(1))) { ?>
                        <td><?php echo $produit->modif; ?></td> <!-- Modif -->

                        <!-- vérifie la valeur de pro_bloque et affiche en conséquence -->
                        <td>
                            <?php
                                if ($produit->bloque != null)
                                {
                                    echo "<div class='badge badge-danger'>";
                                    echo "<i class='fas fa-lock fa-2x'></i>";
                                    echo "</div>";
                                }
                            ?>
                        </td> <!-- Bloqué -->
                        <?php } ?>
                        <!-- Fermeture de la ligne du tableau -->
                        </tr>
            <?php
                    }
                }
                //Fermeture du curseur sur les résultats
                $result->closeCursor();
                //Ferme la connexion vers la base de donnée
                $db = null;
            ?>
        </tbody>
    </table>
    <!-- Bouton qui redirige sur le formulaire d'ajout produit -->
    
</div>
<?php if (verifrole($_SESSION["role"], array(1))) { ?>
<div>
    <a href="add_form.php" title="Ajouter">
        <button type="button" class="btn btn-info btn-block mb-2 font-weight-bold" id="ajouter">
            <i class="fa fa-fw fa-plus-square"></i> Ajouter
        </button>
    </a>
</div>
<?php } ?>
<?php
    //Le footer du site sera ici
    require("footer.php");
?>