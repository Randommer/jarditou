<?php
    $Titre = "Tableau";
    $nav = 2;
    include("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <table class="table table-bordered table-responsive-lg table-striped">
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
        <tbody>
            <?php
                require("connexion_bdd.php"); // Inclusion de notre bibliothèque de fonctions
                $db = connexionBase(); // Appel de la fonction de connexion
                $requete = "SELECT pro_photo, pro_id, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits WHERE ISNULL(pro_bloque) ORDER BY pro_d_ajout DESC";

                $result = $db->query($requete);

                if (!$result)
                {
                    $tableauErreurs = $db->errorInfo();
                    echo $tableauErreur[2];
                    die("Erreur dans la requête");
                }

                if ($result->rowCount() == 0)
                {
                    // Pas d'enregistrement
                    die("La table est vide");
                }

                while ($row = $result->fetch(PDO::FETCH_OBJ))
                {
                    echo"<tr class='text-center'>";
                    echo "<td class='table-warning'><img src='src/img/".$row->pro_id.".".$row->pro_photo."' width='100'></td>";//Photo
                    echo "<td>".$row->pro_id."</td>"; //ID
                    echo "<td>".$row->pro_ref."</td>"; //Référence
                    echo '<td class="table-warning"><a class="text-danger font-weight-bold" href="detail.php?id='.$row->pro_id.'" title="'.$row->pro_libelle.'">'.strtoupper($row->pro_libelle).'</a></td>'; //Libellé
                    echo "<td>".$row->pro_prix." €</td>"; //Prix
                    echo "<td>".$row->pro_stock."</td>"; //Stock
                    echo "<td>".$row->pro_couleur."</td>"; //Couleur
                    echo "<td>".$row->pro_d_ajout."</td>"; //Ajout
                    echo "<td>".$row->pro_d_modif."</td>"; //Modif
                    echo "<td class='text-danger font-weight-bold'>".$row->pro_bloque."</td>"; //Bloqué
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    include("footer.php");
?>