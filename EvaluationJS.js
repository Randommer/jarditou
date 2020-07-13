//--
//Code pour l'Exercice 1
//--

//Ecoute du bouton d'affichage de l'interface de l'Exercice 1
var bouton1 = document.getElementById("Exo1");
bouton1.addEventListener("click", Exo1);

//Fonction qui affiche l'interface de l'Exercice 1
function Exo1()
{
    //Texte de l'interface de l'Exercice 1
    document.getElementById("titre").innerHTML = "Execice 1";
    document.getElementById("enonce").innerHTML = "Nous allons dénombrer les personnes d'âge strictement inférieur à 20 ans, les personnes d'âge strictement supérieur à 40 ans et celles dont l'âge est compris entre 20 ans et 40 ans (20 ans et 40 ans y compris).";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer des ages les uns à la suite des autres, quand vous aurez terminé, rentrer l'age d'une personne centenaire.";
    document.getElementById("start").innerHTML = "<button id='start1'>Commencer</button>"
    document.getElementById("result").innerHTML = "";
    //Ecoute du bouton de lancement du programme de l'Exercice 1
    var start1 = document.getElementById("start1");
    start1.addEventListener("click", Go1);
}

//Fonction du programme de l'Exercice 1
function Go1()
{
    //Initialisation du nombre de personne en dessous de 20 ans
    var min = 0;
    //Initialisation du nombre de personne etre 20 et 40 ans
    var maj = 0;
    //Initialisation du nombre de personne au dessus de 40 ans
    var sen = 0;
    //Initialisation du nombre de personne décomptée
    var n = 0;
    //Initialisation de la variable d'enregistrement de l'entrée utilisateur
    var p = 0;
    //Boucle qui attend la saisie d'un age centenaire
    while (p<100)
    {
        n++;
        //Demande d'un âge à l'utilisateur
        p = parseInt(window.prompt("Saisissez l'âge de la personne n°"+n+"\n(Entrez un age de 100 ou plus pour stopper le programme)"));
        //Test si l'age est sous les 20 ans
        if (p<20)
        {
            min++;
        }
        else
        {
            //Test si l'age est entre 20 et 40 ans
            if (p<=40)
            {
                maj++;
            }
            //Réupère le reste, soit les ages au dessus de 40 ans
            else
            {
                sen++;
            }
        }
    }

    //Affichage en cas d'une seule personne de plus de 40 ans
    if (n==1)
    {
        document.getElementById("result").innerHTML = "La seule personne que vous avez rentré, a plus de 40 ans.";
    }
    else
    {
        //Affichage du cas avec seulement des personnes de plus de 40 ans
        if (sen == n)
        {
            document.getElementById("result").innerHTML = "Toutes les "+n+" personnes que vous avez rentré, ont de plus de 40 ans.";
        }
        //Affichage adapatif des autres cas
        else
        {
            document.getElementById("result").innerHTML = "Sur les "+n+" personnes que vous avez rentré, il y a <object id='mineur'></object><object id='majeur'></object>"+sen+" personne<object id='senior'></object> de plus de 40 ans.";
            //Affichage avec personnes de moins de 20 ans
            if (min!=0)
            {
                //Affichage du cas d'une seule personne de moins de 20 ans
                if (min==1)
                {
                    document.getElementById("mineur").innerHTML = min+" personne de moins de 20 ans, ";
                }
                //Affichage avec pluseurs personnes de moins de 20 ans
                else
                {
                    document.getElementById("mineur").innerHTML = min+" personnes de moins de 20 ans, ";
                }
            }
            //Affichage avec personnes entre 20 et 40 ans
            if (maj!=0)
            {
                //Affichage du cas d'une seule personne entre 20 et 40 ans
                if (maj==1)
                {
                    document.getElementById("majeur").innerHTML = maj+" personne entre 20 et 40 ans et ";
                }
                //Affichage avec pluseurs personnes de entre 20 et 40 ans
                else
                {
                    document.getElementById("majeur").innerHTML = maj+" personnes entre 20 et 40 ans et ";
                }
            }
            //Affichage avec plusieurs personnes de plus de 40 ans
            if (sen>1)
            {
                document.getElementById("senior").innerHTML = "s";
            }
        }
    }
    //Changement de nom du bouton
    document.getElementById("start1").innerHTML = "Recommencer";
}

//--
//Code pour l'Exercice 2
//--

//Ecoute du bouton d'affichage de l'interface de l'Exercice 2
var bouton2 = document.getElementById("Exo2");
bouton2.addEventListener("click", Exo2);

//Fonction qui affiche l'interface de l'Exercice 2
function Exo2()
{
    //Texte de l'interface de l'Exercice 2
    document.getElementById("titre").innerHTML = "Execice 2";
    document.getElementById("enonce").innerHTML = "Nous allons afficher une table de multiplication.";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer un nombre entier, une fois rentré la page affichera sa table de multiplication.";
    document.getElementById("start").innerHTML = "<button id='start2'>Commencer</button>"
    document.getElementById("result").innerHTML = "";
    //Ecoute du bouton de lancement du programme de l'Exercice 2
    var start2 = document.getElementById("start2");
    start2.addEventListener("click", Go2);
}

//Fonction du programme de l'Exercice 2
function Go2()
{
    //Demande quelle table de multiplication afficher
    var N = parseInt(window.prompt("Saisissez un nombre entier"));
    var i;
    //Initialisation d'une chaine contenant du code HTML à afficher dans la page
    var code = String();
    //Boucle qui fait le tour de la table de multiplication
    for (i=1 ; i<11 ; i+=1)
    {
        //Ajout d'une ligne de la table dans le code HTML
        code  = code+i+" x "+N+" = "+(N*i)+"<br>";
    }
    //Affichage du resultat en injectant le code HTML de la table dans la page
    document.getElementById("result").innerHTML = code;
    //Changement de nom du bouton
    document.getElementById("start2").innerHTML = "Recommencer";
}

//--
//Code pour l'Exercice 3
//--

//Ecoute du bouton d'affichage de l'interface de l'Exercice 3
var bouton3 = document.getElementById("Exo3");
bouton3.addEventListener("click", Exo3);

//Fonction qui affiche l'interface de l'Exercice 3
function Exo3()
{
    //Texte de l'interface de l'Exercice 3
    document.getElementById("titre").innerHTML = "Execice 3";
    document.getElementById("enonce").innerHTML = "Nous avons un tableau de prénoms, quand vous trouverez un prénom dans le tableau, il sera retiré.";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer un prénom, nous allons voir si il existe dans le tableau puis le retirer de celui-ci. (Recommencer, remet le tableau à son état initial, Chercher ouvre la fenêtre pour entrer un prénom à chercher dans le tableau)";
    document.getElementById("start").innerHTML = "<button id='restart'>Recommencer</button><button id='start3'>Chercher</button>"
    //Création du tableau tab qui contient les prénoms
    var tab = ["Audrey", "Aurélien", "Flavien", "Jérémy", "Laurent", "Melik", "Nouara", "Salem", "Samuel", "Stéphane"];
    //Ecoute des boutons de lancement et de réinitialisation du programme de l'Exercice 3
    var start3 = document.getElementById("start3");
    start3.addEventListener("click", function(){ tab = Go3(tab); });
    var restart = document.getElementById("restart");
    restart.addEventListener("click", Exo3);
    //Appel la fonction d'Affichage du tableau tab
    AfficheTab(tab);
}

//Fonction du programme de l'Exercice 3
function Go3(tab)
{
    //Demande de saisie d'un prénom
    var prenom = window.prompt("Saisissez un prénom");
    var i;
    var n = -1;
    //Parcours du tableau tab
    for (i=0 ; i<tab.length ; i+=1)
    {
        //Récupération du numéro de la case contenant le prénom
        if (tab[i] == prenom)
        {
            n = i;
        }
    }
    //Test si le prénom est dans le tableau ou non
    if (n != -1)
    {
        //Parcours le tableau de la case du prénom à la fin
        for (i=n ; i<tab.length ; i+=1)
        {
            //Rendre la case vide quand on arrive au bout du tableau
            if (i+1==tab.length)
            {
                tab[i] = " ";
            }
            //Mettre la valeur de la case suivante dans la case actuelle
            else
            {
                tab[i] = tab[i+1];
            }
        }
    }
    //Le prénom n'est pas présent dans le tableau
    else
    {
        window.alert("Désolé, "+prenom+" n'est pas dans le tableau.");
    }
    //Appel la fonction d'Affichage du tableau tab
    AfficheTab(tab);
    //Retourne le tableau vers l'interface
    return tab;
}

//Fonction d'affichage d'un tableau pour l'Exercice 3
function AfficheTab(tab)
{
    //Initialisation d'une chaine contenant du code HTML à afficher à la page
    var code = "<h3>Tableau tab :</h3>";
    var i;
    //Parcours du tableau tab
    for (i=0 ; i<tab.length ; i+=1)
    {
        //Ajout de code HTML de la case actuelle du tableau
        code = code+"<br>case "+(i+1)+" : "+tab[i];
    }
    //Affichage du tableau en injectant le code HTML dans la page
    document.getElementById("result").innerHTML = code;
}

//--
//Code pour l'Exercice 4
//--

//Ecoute du bouton d'affichage de l'interface de l'Exercice 4
var bouton4 = document.getElementById("Exo4");
bouton4.addEventListener("click", Exo4);

//Fonction qui affiche l'interface de l'Exercice 4
function Exo4()
{
    //Texte de l'interface de l'Exercice 4
    document.getElementById("titre").innerHTML = "Execice 4";
    document.getElementById("enonce").innerHTML = "Nous allons afficher une facture à partir du prix unitaire d'un produit et de sa quantité commandée.";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer le prix unitaire d'un produit et la quantité commandée, nous afficherons le prix total à payer qui prend en compte les remises possibles et les frais de port.";
    document.getElementById("start").innerHTML = "<button id='start4'>Commencer</button>"
    document.getElementById("result").innerHTML = "";
    //Ecoute du bouton de lancement du programme de l'Exercice 4
    var start4 = document.getElementById("start4");
    start4.addEventListener("click", Go4);
}

//Fonction du programme de l'Exercice 4
function Go4()
{
    //Initialisation du Prix Produit
    var PU;
    //Initialisation de la Quantité Commandée
    var QTECOM;
    //Initialisation du Prix A Payer
    var PAP;
    //Initialisation de la Remise
    var REM;
    //Initialisation des frais de Port
    var PORT;
    //Demande du Prix Produit à l'utilisateur
    PU = parseFloat(window.prompt("Saisissez le prix unitaire du produit"));
    //Demande de la Quantité Commandée à l'utilisateur
    QTECOM = parseInt(window.prompt("Saisissez la quantité commandée du produit"));
    //Initialisation du Sous-Total avant remise et frais supplémentaires
    ////On utilise *100 et /100 pour palier à une limitation de JavaScript sur les opérations avec des nombres à virgule, voir https://www.w3schools.com/js/js_numbers.asp paragraphe Precision (sans ça, on récupère un millième de milième de nul part)
    var TOT = ((PU*100) * QTECOM)/100;
    //Ajout d'une remise si le Sous-Total est supérieur à 100€
    if (TOT >= 100)
    {
        //Remise de 10% si le Sous-Total est supérieur à 200€
        if (TOT > 200)
        {
            REM = 10;
        }
        //Remise de 5% si le Sous-Total est etre 100€ et 200€ 
        else
        {
            REM = 5;
        }
    }
    //Sous-total inférieur, donc Remise de 0%
    else
    {
        REM = 0;
    }

    //Frais de Port à 0€ si le Sous-Total est supérieur à 500€
    if (TOT > 500)
    {
        PORT = 0;
    }
    //Frais de Port à 2% du Sous-Total quand en dessous de 500€
    else
    {
        //Calcul des frais de Port en calculant 2% du Sous-Total
        ////On utilise *100 et /10000 pour palier à une limitation de JavaScript sur les opérations avec des nombres à virgule, voir https://www.w3schools.com/js/js_numbers.asp paragraphe Precision (sans ça, on récupère un millième de milième de nul part)
        PORT = ((TOT*100) * (0.02*100))/10000;
        //Si les 2% sont inférieur à 6€, les frais de Port sont de 6€
        if (PORT < 6)
        {
            PORT = 6;
        }
    }

    //Calcul du Prix A Payer, en lui appliquant le pourcentage de Remise et en lui ajoutant les frais de Port
    ////On utilise *100 et /100 pour palier à une limitation de JavaScript sur les opérations avec des nombres à virgule, voir https://www.w3schools.com/js/js_numbers.asp paragraphe Precision (sans ça, on récupère un millième de milième de nul part)
    PAP = (((TOT*100) * (100-REM))/100 + (PORT*100))/100;

    //Initialisation d'une chaine contenant du code HTML de la facture à afficher dans la page
    var code = "Prix unitaire : "+PU+"€<br>Quantité : "+QTECOM+"<br>Sous-Total : "+TOT+"€<br>Remise : "+REM+"%<br>Frais de port : "+PORT+"€<br>Total à payer : "+PAP+"€";

    //Affichage du resultat en injectant le code HTML de la facture dans la page
    document.getElementById("result").innerHTML = code;
    //Changement de nom du bouton
    document.getElementById("start4").innerHTML = "Recommencer";
}