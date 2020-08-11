//--
//Fonctions de vérifications des champs des formulaires d'Ajout et de Modification produit
//--


//Ecoute du champ Référence, active la fonction RefVerif quand le champ perd le focus
document.getElementById("ref").addEventListener("blur", RefVerif);

//Fonction qui vérifie si le champ Référence correspond à une expression régulière
function RefVerif()
{
    //On récupère le champ Référence
    var ref = document.getElementById("ref");
    //Initialisation d'une expression régulière pour Référence
    REGEX = new RegExp("^[\\w\\-]{1,10}$");
    //Test si Référence ne respecte pas l'expression régulière
    if (REGEX.test(ref.value) == false)
    {
        //retire la class Bootstrap pour rendre le champ vert
        ref.classList.remove('is-valid');
        //ajoute la class Bootstrap pour rendre le champ rouge
        ref.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Référence respecte l'expression régulière
    {
        //retire la class Bootstrap pour rendre le champ rouge
        ref.classList.remove('is-invalid');
        //ajoute la class Bootstrap pour rendre le champ vert
        ref.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du champ Catégorie, active la fonction CatVerif quand le champ perd le focus
document.getElementById("cat").addEventListener("blur", CatVerif);

//Fonction qui vérifie si le champ Catégorie a une catégorie de selectionnée
function CatVerif()
{
    //On récupère le champ Catégorie
    var cat = document.getElementById("cat");
    //Test si Catégorie a la catégorie 0 de sélectionné
    if (cat.value == 0)
    {
        //ajout de classS bootstrap pour rendre le champ rouge
        cat.classList.remove('is-valid');
        cat.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Catégorie une autre catégorie est sélectionnée
    {
        //ajout de classS bootstrap pour rendre le champ vert
        cat.classList.remove('is-invalid');
        cat.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du champ Libellé, active la fonction LibVerif quand le champ perd le focus
document.getElementById("lib").addEventListener("blur", LibVerif);

//Fonction qui vérifie si le champ Libellé correspond à une expression régulière
function LibVerif()
{
    //On récupère le champ Libellé
    var lib = document.getElementById("lib");
    //Initialisation d'une expression régulière pour Libellé
    REGEX = new RegExp("^[\\w\\-àáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{1,200}$");
    //Test si Libellé ne respecte pas l'expression régulière
    if (REGEX.test(lib.value) == false)
    {
        //ajout de classS bootstrap pour rendre le champ rouge
        lib.classList.remove('is-valid');
        lib.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Libellé respecte l'expression régulière
    {
        //ajout de classS bootstrap pour rendre le champ vert
        lib.classList.remove('is-invalid');
        lib.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du champ Description, active la fonction DesVerif quand le champ perd le focus
document.getElementById("des").addEventListener("blur", DesVerif);

//Fonction qui vérifie si le champ Description a moins de 1000 caractères
function DesVerif()
{
    //On récupère le champ Description
    var des = document.getElementById("des");
    //Test si Description fait plus de 1000 caractères 
    if (des.value.length > 1000)
    {
        //ajout de classS bootstrap pour rendre le champ rouge
        des.classList.remove('is-valid');
        des.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Description a moins de 1000 caractères
    {
        //ajout de classS bootstrap pour rendre le champ vert
        des.classList.remove('is-invalid');
        des.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du champ Prix, active la fonction PrixVerif quand le champ perd le focus
document.getElementById("prix").addEventListener("blur", PrixVerif);

//Fonction qui vérifie si le champ Prix correspond à une expression régulière
function PrixVerif()
{
    //On récupère le champ Prix
    var prix = document.getElementById("prix");
    //Initialisation d'une expression régulière pour Prix
    REGEX = new RegExp("^[0-9]{1,6}[.]{0,1}[0-9]{0,2}$");
    //Test si Prix ne respecte pas l'expression régulière
    if (REGEX.test(prix.value) == false)
    {
        //ajout de classS bootstrap pour rendre le champ rouge
        prix.classList.remove('is-valid');
        prix.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Prix respecte l'expression régulière
    {
        //ajout de classS bootstrap pour rendre le champ vert
        prix.classList.remove('is-invalid');
        prix.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du champ Stock, active la fonction StockVerif quand le champ perd le focus
document.getElementById("stock").addEventListener("blur", StockVerif);

//Fonction qui vérifie si le champ Stock correspond à une expression régulière
function StockVerif()
{
    //On récupère le champ Stock
    var stock = document.getElementById("stock");
    //Initialisation d'une expression régulière pour Stock
    REGEX = new RegExp("^[0-9]{0,11}$");
    //Test si Stock ne respecte pas l'expression régulière
    if (REGEX.test(stock.value) == false)
    {
        //ajout de classS bootstrap pour rendre le champ rouge
        stock.classList.remove('is-valid');
        stock.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Stock respecte l'expression régulière
    {
        //ajout de classS bootstrap pour rendre le champ vert
        stock.classList.remove('is-invalid');
        stock.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du champ Couleur, active la fonction ColorVerif quand le champ perd le focus
document.getElementById("color").addEventListener("blur", ColorVerif);

//Fonction qui vérifie si le champ Couleur correspond à une expression régulière
function ColorVerif()
{
    //On récupère le champ Couleur
    var color = document.getElementById("color");
    //Initialisation d'une expression régulière pour Couleur
    REGEX = new RegExp("^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{0,30}$");
    //Test si Couleur ne respecte pas l'expression régulière
    if (REGEX.test(color.value) == false)
    {
        //ajout de classS bootstrap pour rendre le champ rouge
        color.classList.remove('is-valid');
        color.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Couleur respecte l'expression régulière
    {
        //ajout de classS bootstrap pour rendre le champ vert
        color.classList.remove('is-invalid');
        color.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du champ Extension de la photo, active la fonction ExtVerif quand le champ perd le focus
document.getElementById("ext").addEventListener("blur", ExtVerif);

//Fonction qui vérifie si le champ Extension de la photo correspond à une expression régulière
function ExtVerif()
{
    //On récupère le champ Extension de la photo
    var ext = document.getElementById("ext");
    //Initialisation d'une expression régulière pour Extension de la photo
    REGEX = new RegExp("^[\\w]{0,4}$");
    //Test si Extension de la photo ne respecte pas l'expression régulière
    if (REGEX.test(ext.value) == false)
    {
        //ajout de classS bootstrap pour rendre le champ rouge
        ext.classList.remove('is-valid');
        ext.classList.add('is-invalid');
        //Retourne 1 pour indiquer la présence d'une erreur
        return 1;
    }
    else //si Extension de la photo respecte l'expression régulière
    {
        //ajout de classS bootstrap pour rendre le champ vert
        ext.classList.remove('is-invalid');
        ext.classList.add('is-valid');
        //Retourne 0 pour indiquer la présence d'aucune erreur
        return 0;
    }
}

//Ecoute du formulaire, active la fonction Verif quand le bouton Submit est cliqué
document.getElementById("theform").addEventListener("submit", function(event){ Verif(event); });

//Fonction de vérification des formulaires (add et update) produit
function Verif(event)
{
    //Initialisation d'un entier qui comptera le nombre d'erreur dans le formulaire
    var nmbError = 0;

    //On incrémente nmbError avec les résultats de toutes les fonctions de vérification de champ
    //les fonctions renvoient 1 si ils ont une erreur et 0 quand le champ est correct
    //nmbError compte donc le nombre d'erreurs du formulaire
    nmbError = nmbError + RefVerif();
    nmbError = nmbError + CatVerif();
    nmbError = nmbError + LibVerif();
    nmbError = nmbError + DesVerif();
    nmbError = nmbError + PrixVerif();
    nmbError = nmbError + StockVerif();
    nmbError = nmbError + ColorVerif();
    nmbError = nmbError + ExtVerif();

    //test si le formulaire à des erreurs
    if (nmbError > 0)
    {
        //empèche l'envoie du formulaire
        event.preventDefault();
    }
    //Ne rien faire à event, envoie le formulaire normalement vers son script de destination
}