//--
//Fonctions de vérifications des champs du formulaire de Connexion
//--

//Fonction qui vérifie si le champ d'Identifiant correspond à une expression régulière
function LogVerif()
{
    //On récupère le champ d'Identifiant
    var log = document.getElementById("log");
    //Initialisation d'une expression régulière pour d'Identifiant
    REGEX = new RegExp("^[\w\-]{3,50}$");
    //Test si l'Identifiant ne respecte pas l'expression régulière
    if (REGEX.test(log.value) == false)
    {
        //retire la class Bootstrap pour rendre le champ vert
        log.classList.remove('is-valid');
        //ajoute la class Bootstrap pour rendre le champ rouge
        log.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Référence respecte l'expression régulière
    {
        //retire la class Bootstrap pour rendre le champ rouge
        log.classList.remove('is-invalid');
        //ajoute la class Bootstrap pour rendre le champ vert
        log.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Fonction qui vérifie si le champ de Mot de passe correspond à une expression régulière
function MdpVerif()
{
    //On récupère le champ de Mot de passe
    var mdp = document.getElementById("mdp");
    //Initialisation d'une expression régulière pour de Mot de passe
    REGEX = new RegExp("^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$");
    //Test si le Mot de passe ne respecte pas l'expression régulière
    if (REGEX.test(mdp.value) == false)
    {
        //retire la class Bootstrap pour rendre le champ vert
        mdp.classList.remove('is-valid');
        //ajoute la class Bootstrap pour rendre le champ rouge
        mdp.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Référence respecte l'expression régulière
    {
        //retire la class Bootstrap pour rendre le champ rouge
        mdp.classList.remove('is-invalid');
        //ajoute la class Bootstrap pour rendre le champ vert
        mdp.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du formulaire, active la fonction LoginVerif quand le bouton Submit est cliqué
document.getElementById("login").addEventListener("submit", function(event){ LoginVerif(event); });

//Fonction de vérification du formulaire de Connexion
function LoginVerif(event)
{
    document.getElementById("login").classList.add('was-validated');

    //Initialisation d'un entier qui comptera le nombre d'erreur dans le formulaire
    var nmbError = 0;

    //On incrémente nmbError avec les résultats de toutes les fonctions de vérification de champ
    //les fonctions renvoient 1 si ils ont une erreur et 0 quand le champ est correct
    //nmbError compte donc le nombre d'erreurs du formulaire
    nmbError = nmbError + LogVerif();
    nmbError = nmbError + MdpVerif();

    //test si le formulaire à des erreurs
    if (nmbError > 0)
    {
        //empêche l'envoie du formulaire
        event.preventDefault();
    }
    //Ne rien faire à event, envoie le formulaire normalement vers son script de destination
}