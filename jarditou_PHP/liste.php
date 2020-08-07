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
            <tr>
                <th>Photo</th>
                <th>ID</th>
                <th>Référence</th>
                <th>Libellé</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Couleur</th>
                <th>Ajout</th>
                <th>Modif</th>
                <th>Bloqué</th>
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
                $requete = "SELECT pro_photo, pro_id, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits WHERE ISNULL(pro_bloque) ORDER BY pro_d_ajout DESC";

                //Envoie de la requète à la base
                $result = $db->query($requete);

                //Gestion d'erreurs si la requète pose problème
                if (!$result)
                {
                    $tableauErreurs = $db->errorInfo();
                    echo $tableauErreur[2];
                    die("Erreur dans la requête");
                }

                //Gestion si le résultat de la réquète est vide
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