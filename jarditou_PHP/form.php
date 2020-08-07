<!-- Partie article de la page -->
<!-- Zone de formulaire -->
<!-- novalidate désactive la validation du coté HTML pour permettre de la faire côté JavaScript -->
<form action="<?php echo $_SERVER["PHP_SELF"];//le formulaire s'enverra sur la page courante ?>" method="POST" id="contact" name="contact" novalidate>
    <p>* Ces zones sont oligatoires</p>
    <h1>Vos coordonnées</h1>
    <!-- Champ pour le nom -->
    <div class="form-group">
        <label for="nom">Nom*</label>
        <input type="text" class="form-control <?php if ($nomval != -1) { if ($nomval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" name="nom" id="nom" placeholder="Veuillez saisir votre nom" required <?php echo "value='".$nom."'";//récupère une valeur pour le champs ?>>
        <!-- texte qui s'affiche si le nom est validé par la vérif -->
        <div class="valid-feedback">C'est validé mais en vrai j'ai pas trouvé l'expression régulière qui prend en compte les particules, les noms composés et les O' anglophones en même temps donc le champ accepte meme les chiffres...</div>
        <!-- texte qui s'affiche si le nom n'est pas validé par la vérif -->
        <div class="invalid-feedback">Entrez un nom valide.</div>
    </div>
    <!-- Champ pour le prénom -->
    <div class="form-group">
        <label for="prenom">Prénom*</label>
        <input type="text" class="form-control <?php if ($prenomval != -1) { if ($prenomval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" name="prenom" id="prenom" placeholder="Veuillez saisir votre prénom" required <?php echo "value='".$prenom."'";//récupère une valeur pour le champs ?>>
        <!-- texte qui s'affiche si le prénom est validé par la vérif -->
        <div class="valid-feedback">C'est validé mais même problème qu'avec Nom, peu importe l'expression régulière, j'arrivais pas à prendre en compte un prénom composé...</div>
        <!-- texte qui s'affiche si le prénom n'est pas validé par la vérif -->
        <div class="invalid-feedback">Entrez un prénom valide.</div>
    </div>
    <!-- Boutons radio pour le sexe -->
    <div class="form-group">
        <label for="sexe">Sexe*</label>
        <br>
            <div class="form-check-inline">
                <input class="form-check-input <?php if ($sexeval != -1) { if ($sexeval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" type="radio" name="sexe" id="feminin" value="feminin" required <?php if ($fem) { echo "checked"; }//coche la valeur si elle l'a été sélectionnée en POST ?>>
                <label class="form-check-label" for="feminin"> Féminin</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input <?php if ($sexeval != -1) { if ($sexeval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" type="radio" name="sexe" id="masculin" value="masculin" required <?php if ($mas) { echo "checked"; }//coche la valeur si elle l'a été sélectionnée en POST ?>>
                <label class="form-check-label" for="masculin"> Masculin</label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input <?php if ($sexeval != -1) { if ($sexeval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" type="radio" name="sexe" id="neutre" value="neutre" required <?php if ($neu) { echo "checked"; }//coche la valeur si elle l'a été sélectionnée en POST ?>>
                <label class="form-check-label" for="neutre"> Neutre</label>
                <!-- texte qui s'affiche si un sexe est sélectionné lors de la vérif -->
                <div class="valid-feedback"></div>
                <!-- texte qui s'affiche si aucun sexe n'est sélectionné lors de la vérif -->
                <div class="invalid-feedback" style="margin-left: 1em;"><br>Selectionnez un sexe.</div>
            </div>
    </div>
    <!-- Champ pour la date de naissance -->
    <div class="form-group">
        <label for="naissance">Date de Naissance*</label>
        <div class="input-group">
            <input type="date" class="form-control <?php if ($naissanceval != -1) { if ($naissanceval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" name="naissance" id="naissance" required <?php if ($naissanceval > -1) { echo "value=".date_format($naissance, "Y-m-d"); }//récupère une valeur pour le champs ?>>
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
            </div>
            <!-- texte qui s'affiche si la date naissance est validée par la vérif -->
            <div class="valid-feedback"></div>
            <!-- texte qui s'affiche si la date naissance n'est pas validée par la vérif -->
            <div class="invalid-feedback" id="naissance-invalid">Selectionnez une date<?php if ($naissanceval == 0) { echo " passée"; }//bonus gestion d'erreur ?>.</div>
        </div>
    </div>
    <!-- Champ pour le code postal -->
    <div class="form-group">
        <label for="CP">Code Postal*</label>
        <input type="text" class="form-control <?php if ($CPval != -1) { if ($CPval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" name="CP" id="CP" required <?php echo "value='".$CP."'";//récupère une valeur pour le champs ?>>
        <!-- texte qui s'affiche si le code postal est validé par la vérif -->
        <div class="valid-feedback"></div>
        <!-- texte qui s'affiche si le code postal n'est pas validé par la vérif -->
        <div class="invalid-feedback">Entrez un Code Postal valide.</div>
    </div>
    <!-- Champ pour l'adresse -->
    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" name="adresse" id="adresse" <?php echo "value='".$adresse."'";//récupère une valeur pour le champs ?>>
    </div>
    <!-- Champ pour la ville -->
    <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" name="ville" id="ville" <?php echo "value='".$ville."'";//récupère une valeur pour le champs ?>>
    </div>
    <!-- Champ pour le mail -->
    <div class="form-group">
        <label for="email">Email*</label>
        <input type="email" class="form-control <?php if ($emailval != -1) { if ($emailval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" name="email" id="email" placeholder="dave.loper@afpa.fr" pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})" required <?php echo "value='".$email."'";//récupère une valeur pour le champs ?>>
        <!-- texte qui s'affiche si le mail est validé par la vérif -->
        <div class="valid-feedback"></div>
        <!-- texte qui s'affiche si le mail n'est pas validé par la vérif -->
        <div class="invalid-feedback">Entrez une adresse e-mail valide.</div>
    </div>
    <h1>Votre demande</h1>
    <!-- Champ de selection du sujet -->
    <div class="form-group">
        <label for="sujet">Sujet*</label>
        <select class="form-control <?php if ($sujetval != -1) { if ($sujetval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" name="sujet" id="sujet" required>
            <option value="" disabled <?php if ($sj1) { echo "selected"; }//sélectionne la valeur si elle l'a été sélectionnée en POST ?>>Veuillez sélectionner un sujet</option>
            <option value="commandes" <?php if ($sj2) { echo "selected"; }//sélectionne la valeur si elle l'a été sélectionnée en POST ?>>Mes commandes</option>
            <option value="question" <?php if ($sj3) { echo "selected"; }//sélectionne la valeur si elle l'a été sélectionnée en POST ?>>Question sur un produit</option>
            <option value="reclamation" <?php if ($sj4) { echo "selected"; }//sélectionne la valeur si elle l'a été sélectionnée en POST ?>>Réclamation</option>
            <option value="autres" <?php if ($sj5) { echo "selected"; }//sélectionne la valeur si elle l'a été sélectionnée en POST ?>>Autres</option>
        </select>
        <!-- texte qui s'affiche si un sujet est sélectionné lors de la vérif -->
        <div class="valid-feedback"></div>
        <!-- texte qui s'affiche si un sujet n'est pas sélectionné lors de la vérif -->
        <div class="invalid-feedback">Selectionnez un sujet pour votre demande.</div>
    </div>
    <!-- Champ d'écriture libre pour la question -->
    <div class="form-group">
        <label for="question">Votre question* :</label>
        <textarea class="form-control <?php if ($questionval != -1) { if ($questionval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" name="question" id="question" rows="2" required><?php echo $question;//récupère une valeur pour le champs ?></textarea>
        <!-- texte qui s'affiche si un texte est écrit lors de la vérif -->
        <div class="valid-feedback">En vrai ici, ça vérifie juste qu'il y a au moins un caractère, donc ça fonctionne même si la personne entre un espace, pas idéal mais bon</div>
        <!-- texte qui s'affiche si rien n'est écrit lors de la vérif -->
        <div class="invalid-feedback">Formulez votre demande en quelques mots s'il vous plait.</div>
    </div>
    <!-- Case à cocher pour accepter les conditions d'utilisation du traitement des données -->
    <div class="form-group form-check">
        <input class="form-check-input <?php if ($acceptedval != -1) { if ($acceptedval == 1) { echo "is-valid"; }else{ echo "is-invalid"; } }//ajoute la classe Bootstrap en fonction de la validité du champ ?>" type="checkbox" name="accepted" id="accepted" value=true required <?php if ($accepted) { echo "checked"; }//coche la valeur si elle l'a été sélectionnée en POST ?>>
        <label class="form-check-label" for="accepted">J'accepte le traitement informatique de ce formulaire.</label>
        <!-- texte qui s'affiche si la case est cochée lors de la vérif -->
        <div class="valid-feedback"></div>
        <!-- texte qui s'affiche si la case n'est pas cochée lors de la vérif -->
        <div class="invalid-feedback">Cocher cette case est obligatoire.</div>
    </div>
    <!-- Boutons du formulaire -->
    <div class="form-group">
        <!-- bouton submit du formulaire -->
        <input class="btn btn-primary bg-dark" type="submit" value="Envoyer">
        <!-- bouton qui remet à zéro tout les input du formulaire -->
        <input class="btn btn-primary bg-dark" type="reset" value="Annuler">
    </div>
</form>