<?php
    //donne un nom à la page, que le header utilisera
    $Titre = "Accueil";
    //donne la position de la page dans le menu du header
    $nav = 1;
    //Le header du site sera ici
    require("header.php");
?>
<!-- Corps du site -->
<div class="row mx-0 mb-1">
    <!-- Partie article de la page -->
    <div class="col-sm-12 col-lg-8 mb-2 shadow">
        <h2>L'entreprise</h2>
        <p class="text-justify">Notre entreprise familiale met tout son savoir-faire à votre disposition dans le domaine du jardin et du paysagisme.</p>
        <p class="text-justify">Créée il y a 70 ans, notre entreprise vend fleurs, arbustes, matériel à main et motorisés.</p>
        <p class="text-justify">Implantés à Amiens, nous intervenons dans tout le département de la Somme : Albert, Doullens, Péronne, Abbeville, Corbie.</p>
        <h2>Qualité</h2>
        <p class="text-justify">Nous mettons à votre disposition un service personnalisé, avec un seul interlocuteur durant tout votre projet.</p>
        <p class="text-justify">Vous serez séduit par notre expertise, nos compétences et notre sérieux.</p>
        <h2>Devis gratuit</h2>
        <p class="text-justify">Vous pouvez bien sûr contacter pour de plus amples informations ou pour une demande d’intervention. Vous souhaitez un devis ? Nous vous le réalisons gratuitement.</p>
    </div>
    <!-- Boite à droite de la partie article -->
    <div class="col-sm-12 col-lg-4 bg-warning pt-2 px-2 pb-1 mb-2 shadow">
        <h2 class="text-center">[Colonne de droite]</h2>

    </div>
</div>
<?php
    //Le footer du site sera ici
    require("footer.php");
?>