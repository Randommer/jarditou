<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Tableau";
    //donne la position de la page dans le menu du header
    $nav = 2;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <!-- Tableau responsif -->
    <table class="table table-bordered table-responsive-lg table-striped">
        <!-- Entête du tableau -->
        <thead class="thead-light">
            <?php
                $aff2 = $aff4 = $aff6 = $aff8 = $aff10 = $aff12 = $aff14 = $aff16 = $aff18 = false;
                //echo var_dump($_SERVER);
                if (empty($_GET["by"]))
                {
                    $requete = "SELECT pro_id, pro_photo, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits WHERE ISNULL(pro_bloque) ORDER BY pro_d_ajout DESC";
                }
                else
                {
                    $requete = "SELECT pro_id, pro_photo, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits";
                    switch ($_GET["by"])
                    {
                        case 1:
                            $requete = $requete." ORDER BY pro_id ASC";
                            $aff2 = true;
                        break;

                        case 2:
                            $requete = $requete." ORDER BY pro_id DESC";
                        break;

                        case 3:
                            $requete = $requete." ORDER BY pro_ref ASC";
                            $aff4 = true;
                        break;

                        case 4:
                            $requete = $requete." ORDER BY pro_ref DESC";
                        break;

                        case 5:
                            $requete = $requete." ORDER BY pro_libelle ASC";
                            $aff6 = true;
                        break;

                        case 6:
                            $requete = $requete." ORDER BY pro_libelle DESC";
                        break;

                        case 7:
                            $requete = $requete." ORDER BY pro_prix ASC";
                            $aff8 = true;
                        break;

                        case 8:
                            $requete = $requete." ORDER BY pro_prix DESC";
                        break;

                        case 9:
                            $requete = $requete." ORDER BY pro_stock ASC";
                            $aff10 = true;
                        break;

                        case 10:
                            $requete = $requete." ORDER BY pro_stock DESC";
                        break;

                        case 11:
                            $requete = $requete." ORDER BY pro_couleur ASC";
                            $aff12 = true;
                        break;

                        case 12:
                            $requete = $requete." ORDER BY pro_couleur DESC";
                        break;

                        case 13:
                            $requete = $requete." ORDER BY pro_d_ajout ASC";
                            $aff14 = true;
                        break;

                        case 14:
                            $requete = $requete." ORDER BY pro_d_ajout DESC";
                        break;

                        case 15:
                            $requete = $requete." WHERE pro_d_modif IS NOT NULL ORDER BY pro_d_modif ASC";
                            $aff16 = true;
                        break;

                        case 16:
                            $requete = $requete." WHERE pro_d_modif IS NOT NULL ORDER BY pro_d_modif DESC";
                        break;

                        case 17:
                            $requete = $requete." WHERE pro_bloque IS NOT NULL ORDER BY pro_id ASC";
                            $aff18 = true;
                        break;

                        case 18:
                            $requete = $requete." WHERE ISNULL(pro_bloque) ORDER BY pro_id ASC";
                        break;

                        default:
                        $requete = $requete." WHERE ISNULL(pro_bloque) ORDER BY pro_d_ajout DESC";
                    }
                    $requete = $requete.", pro_id ASC";
                }
            ?>
            <tr>
                <th>Photo</th>
                <th><a href="liste.php?by=<?php if($aff2) {echo 2;}else{echo 1;} ?>">ID</a></th>
                <th><a href="liste.php?by=<?php if($aff4) {echo 4;}else{echo 3;} ?>">Référence</a></th>
                <th><a href="liste.php?by=<?php if($aff6) {echo 6;}else{echo 5;} ?>">Libellé</a></th>
                <th><a href="liste.php?by=<?php if($aff8) {echo 8;}else{echo 7;} ?>">Prix</a></th>
                <th><a href="liste.php?by=<?php if($aff10) {echo 10;}else{echo 9;} ?>">Stock</a></th>
                <th><a href="liste.php?by=<?php if($aff12) {echo 12;}else{echo 11;} ?>">Couleur</a></th>
                <th><a href="liste.php?by=<?php if($aff14) {echo 14;}else{echo 13;} ?>">Ajout</a></th>
                <th><a href="liste.php?by=<?php if($aff16) {echo 16;}else{echo 15;} ?>">Modif</a></th>
                <th><a href="liste.php?by=<?php if($aff18) {echo 18;}else{echo 17;} ?>">Bloqué</a></th>
            </tr>
        </thead>
        <!-- Corps du tableau -->
        <tbody>
            <?php
                //Inclusion d'un fonction de connexion à la base de donnéee
                require("connexion_bdd.php");

                //Appel de la fonction de connexion
                $db = connexionBase();
                //Ecriture de la requète à envoyer à la base de donnée
                //$requete = "SELECT pro_id, pro_photo, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits WHERE ISNULL(pro_bloque) ORDER BY pro_d_ajout DESC";

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
                    echo "<tr>";
                    echo "<td colspan='10'><h1 class='text-danger font-weight-bold'>Le tableau est vide</h1></td>";
                    echo "</tr>";
                }
                else
                {
                    //Récupération en objet d'une entrée du résultat par tour de boucle
                    while ($row = $result->fetch(PDO::FETCH_OBJ))
                    {
                        //Ouverture d'une ligne du tableau
                        echo "<tr class='text-center'>";

                        //Remplissage de la case avec une balise image
                        echo "<td class='table-warning'><img src='src/img/".$row->pro_id.".".$row->pro_photo."' width='100' alt='".$row->pro_libelle." ".$row->pro_couleur."'></td>";//Photo

                        echo "<td>".$row->pro_id."</td>";//ID
                        echo "<td>".$row->pro_ref."</td>";//Référence

                        //Remplissage de la case avec un lien vers la page detail du produit
                        echo '<td class="table-warning"><a class="text-danger font-weight-bold" href="detail.php?id='.$row->pro_id.'" title="'.$row->pro_libelle.'"><u>'.strtoupper($row->pro_libelle).'</u></a></td>';//Libellé

                        echo "<td>".$row->pro_prix." €</td>";//Prix
                        echo "<td>".$row->pro_stock."</td>";//Stock
                        echo "<td>".$row->pro_couleur."</td>";//Couleur
                        echo "<td>".$row->pro_d_ajout."</td>";//Ajout
                        echo "<td>".$row->pro_d_modif."</td>";//Modif

                        //vérifie la valeur de pro_bloque et affiche en conséquence
                        if ($row->pro_bloque != null)
                        {
                            echo "<td><div class='badge badge-danger'>BLOQUÉ</div></td>";//Bloqué
                        }
                        else
                        {
                            echo "<td></td>";//Bloqué
                        }
                        //Fermeture de la ligne du tableau
                        echo"</tr>";
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
    <a href="add_form.php" title="Ajouter">
        <button type="button" class="btn btn-info " id="ajouter">Ajouter</button>
    </a>
</div>
<?php
    //Le footer du site sera ici
    require("footer.php");
?>