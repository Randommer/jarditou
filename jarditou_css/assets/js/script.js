//Récupération du formulaire sous la forme d'un objet
var contact = document.getElementById('contact');
//Ajout d'une écoute pour quand le formulaire est envoyé, il fera tourner la fonction Validation
contact.addEventListener("submit", function(event){ Validation(contact, event); });

//Fonction de validation du formulaire de contact de JardiTou
function Validation(contact, event)
{
    //Initialisation d'un booléen qui déterminera la validité ou non du formulaire
    //si il est vrai, le formulaire sera envoyé
    //si il est faux, on restera sur la page
    var check = true;
    //Initialisation d'une expresion régulière pour futur vérifications de valeurs
    var REGEX;

    //test si le champ Nom n'est pas rempli
    if (contact.elements['nom'].value.length == 0)
    {
        //retire la classe valid
        contact.elements['nom'].classList.remove('valid');
        //ajout la classe error pour rendre le champ rouge
        contact.elements['nom'].classList.add('error');
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-nom').textContent = "Entrez un nom valide.";
        //formulaire invalide
        check = false;
    }
    else //si le champ Nom est rempli
    {
        //retire la classe error qui rend le champ rouge
        contact.elements['nom'].classList.remove('error');
        //ajout de la classe valid
        contact.elements['nom'].classList.add('valid');
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-nom').textContent = "";
    }

    //test si le champ Prénom n'est pas rempli
    if (contact.elements['prenom'].value.length == 0)
    {
        //ajout la classe error pour rendre le champ rouge
        contact.elements['prenom'].classList.remove('valid');
        contact.elements['prenom'].classList.add('error');
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-prenom').textContent = "Entrez un prénom valide.";
        //formulaire invalide
        check = false;
    }
    else //si le champ Prénom est rempli
    {
        //retire la classe error qui rend le champ rouge
        contact.elements['prenom'].classList.remove('error');
        contact.elements['prenom'].classList.add('valid');
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-prenom').textContent = "";
    }

    //test si un bouton radio Sexe n'est pas sélectionné
    if (contact.elements['sexe'].value.length == 0)
    {
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-sexe').textContent = "Selectionnez un sexe.";
        //formulaire invalide
        check = false;
    }
    else //si un bouton radio Sexe est sélectionné
    {
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-sexe').textContent = "";
    }

    //test si le champ Date de Naissance n'est pas rempli ou rempli avec une date future
    if (Date.parse(contact.elements['naissance'].value) >= Date.now() || contact.elements['naissance'].value == "")
    {
        //ajout la classe error pour rendre le champ rouge
        contact.elements['naissance'].classList.remove('valid');
        contact.elements['naissance'].classList.add('error');
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-naissance').textContent = "Selectionnez une date.";
        //formulaire invalide
        check = false;
        //test si le champ Date de Naissance est rempli avec une date future
        if (Date.parse(contact.elements['naissance'].value) >= Date.now())
        {
            //changement du texte d'erreur pour indiquer à l'utilisateur qu'il n'est pas né dans le futur
            document.getElementById('invalid-naissance').textContent = "A part si vous êtes né dans le futur, selectionnez une date passée ;-)";
        }
    }
    else //si le champ Date de Naissance est rempli avec une date antérieure à aujourd'hui
    {
        //retire la classe error qui rend le champ rouge
        contact.elements['naissance'].classList.remove('error');
        contact.elements['naissance'].classList.add('valid');
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-naissance').textContent = "";
    }

    //Mise en place de l'expression régulière pour le Code Postal
    REGEX = new RegExp("^[0-9]{5}$");
    //Test si le Code Postal ne respecte pas l'expression régulière
    if (REGEX.test(contact.elements['CP'].value) == false)
    {
        //ajout la classe error pour rendre le champ rouge
        contact.elements['CP'].classList.remove('valid');
        contact.elements['CP'].classList.add('error');
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-CP').textContent = "Entrez un Code Postal valide.";
        //formulaire invalide
        check = false;
    }
    else //si le Code Postal respecte l'expression régulière
    {
        //retire la classe error qui rend le champ rouge
        contact.elements['CP'].classList.remove('error');
        contact.elements['CP'].classList.add('valid');
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-CP').textContent = "";
    }

    //Mise en place de l'expression régulière pour le mail
    REGEX = new RegExp("[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})");
    //Test si l'Email ne respecte pas l'expression régulière
    if (REGEX.test(contact.elements['email'].value) == false)
    {
        //ajout la classe error pour rendre le champ rouge
        contact.elements['email'].classList.remove('valid');
        contact.elements['email'].classList.add('error');
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-email').textContent = "Entrez une adresse e-mail valide.";
        //formulaire invalide
        check = false;
    }
    else //si l'Email respecte l'expression régulière
    {
        //retire la classe error qui rend le champ rouge
        contact.elements['email'].classList.remove('error');
        contact.elements['email'].classList.add('valid');
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-email').textContent = "";
    }

    //test si un Sujet de la liste déroualante n'est pas sélectionné
    if (contact.elements['sujet'].value.length == 0)
    {
        //ajout la classe error pour rendre le champ rouge
        contact.elements['sujet'].classList.remove('valid');
        contact.elements['sujet'].classList.add('error');
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-sujet').textContent = "Selectionnez un sujet pour votre demande.";
        //formulaire invalide
        check = false;
    }
    else //si un Sujet de la liste déroualante est sélectionné
    {
        //retire la classe error qui rend le champ rouge
        contact.elements['sujet'].classList.remove('error');
        contact.elements['sujet'].classList.add('valid');
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-sujet').textContent = "";
    }

    //test si le champ Question n'est pas rempli
    if (contact.elements['question'].value.length == 0)
    {
        //ajout la classe error pour rendre le champ rouge
        contact.elements['question'].classList.remove('valid');
        contact.elements['question'].classList.add('error');
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-question').textContent = "Formulez votre demande en quelques mots s'il vous plait.";
        //formulaire invalide
        check = false;
    }
    else //si le champ Question est rempli
    {
        //retire la classe error qui rend le champ rouge
        contact.elements['question'].classList.remove('error');
        contact.elements['question'].classList.add('valid');
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-question').textContent = "";
    }

    //test si la case J'accepte n'a pas été cochée (checkValidity, vérifie par rapport aux critères de validité écrit dans les balises HTML de l'input)
    if (!(contact.elements['accepted'].checkValidity()))
    {
        //injecte un message d'erreur dans la page HTML
        document.getElementById('invalid-accepted').textContent = "Cocher cette case est obligatoire.";
        //formulaire invalide
        check = false;
    }
    else //si la case J'accepte a été cochée
    {
        //retire le message d'erreur dans la page HTML
        document.getElementById('invalid-accepted').textContent = "";
    }

    //vérifie si le formulaire est faux
    if(check == false)
    {
        //empèche l'envoie du formulaire 
        event.preventDefault();
    }
}