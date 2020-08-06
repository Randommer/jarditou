//--
//Code pour l'Exercice 1
//--

//Ecoute des boutons d'affichage de l'interface de l'Exercice 1
var bouton1 = document.getElementById("Exo1");
bouton1.addEventListener("click", Exo1);
var bouton1md = document.getElementById("Exo1-md");
bouton1md.addEventListener("click", Exo1);

//Fonction qui affiche l'interface de l'Exercice 1
function Exo1()
{
    //Texte de l'interface de l'Exercice 1
    document.getElementById("titre").textContent = "Execice 1";
    document.getElementById("enonce").textContent = "Nous allons dénombrer les personnes d'âge strictement inférieur à 20 ans, les personnes d'âge strictement supérieur à 40 ans et celles dont l'âge est compris entre 20 ans et 40 ans (20 ans et 40 ans y compris).";
    document.getElementById("deroule").textContent = "Nous allons vous demander de rentrer des ages les uns à la suite des autres, quand vous aurez terminé, rentrer l'age d'une personne centenaire.";
    AffBouton(1);
    document.getElementById("result").textContent = "";
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


        p = window.prompt("Saisissez l'âge de la personne n°"+n+"\n(Entrez un age de 100 ou plus pour stopper le programme)");
        //Gestion d'erreur si l'utilisateur appuie sur Annuler
        if (p == null)
        {
            return;
        }
        //Transforme l'entrée en nombre si possible
        p = parseInt(p);
        //Gestion d'erreur d'entrée utilisateur, si l'utilisateur rentre autre chose que des chiffres ou un nombre négatif.
        while (isNaN(p) || p < 0)
        {
            window.alert("Vous n'avez pas rentré un age correct");
            p = window.prompt("Saisissez l'âge de la personne n°"+n+"\n(Entrez un age de 100 ou plus pour stopper le programme)");
            //Gestion d'erreur si l'utilisateur appuie sur Annuler
            if (p == null)
            {
                return;
            }
            p = parseInt(p);
        }
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

    //Gestion d'erreur si l'utilisateur appuie sur Annuler
    if (p == null)
        {
            return;
        }

    //Affichage en cas d'une seule personne de plus de 40 ans
    if (n==1)
    {
        document.getElementById("result").textContent = "La seule personne que vous avez rentré, a plus de 40 ans.";
    }
    else
    {
        //Affichage du cas avec seulement des personnes de plus de 40 ans
        if (sen == n)
        {
            document.getElementById("result").textContent = "Toutes les "+n+" personnes que vous avez rentré, ont de plus de 40 ans.";
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
                    document.getElementById("mineur").textContent = min+" personne de moins de 20 ans, ";
                }
                //Affichage avec pluseurs personnes de moins de 20 ans
                else
                {
                    document.getElementById("mineur").textContent = min+" personnes de moins de 20 ans, ";
                }
            }
            //Affichage avec personnes entre 20 et 40 ans
            if (maj!=0)
            {
                //Affichage du cas d'une seule personne entre 20 et 40 ans
                if (maj==1)
                {
                    document.getElementById("majeur").textContent = maj+" personne entre 20 et 40 ans et ";
                }
                //Affichage avec pluseurs personnes de entre 20 et 40 ans
                else
                {
                    document.getElementById("majeur").textContent = maj+" personnes entre 20 et 40 ans et ";
                }
            }
            //Affichage avec plusieurs personnes de plus de 40 ans
            if (sen>1)
            {
                document.getElementById("senior").textContent = "s";
            }
        }
    }
    //Changement de nom du bouton
    document.getElementById("start1").textContent = "Recommencer";
}

//--
//Code pour l'Exercice 2
//--

//Ecoute des boutons d'affichage de l'interface de l'Exercice 2
var bouton2 = document.getElementById("Exo2");
bouton2.addEventListener("click", Exo2);
var bouton2md = document.getElementById("Exo2-md");
bouton2md.addEventListener("click", Exo2);

//Fonction qui affiche l'interface de l'Exercice 2
function Exo2()
{
    //Texte de l'interface de l'Exercice 2
    document.getElementById("titre").textContent = "Execice 2";
    document.getElementById("enonce").textContent = "Nous allons afficher une table de multiplication.";
    document.getElementById("deroule").textContent = "Nous allons vous demander de rentrer un nombre entier, une fois rentré la page affichera sa table de multiplication.";
    AffBouton(2);
    document.getElementById("result").textContent = "";
    //Ecoute du bouton de lancement du programme de l'Exercice 2
    var start2 = document.getElementById("start2");
    start2.addEventListener("click", Go2);
}

//Fonction du programme de l'Exercice 2
function Go2()
{
    //Demande quelle table de multiplication afficher
    var N = window.prompt("Saisissez un nombre entier");
    //Gestion d'erreur si l'utilisateur appuie sur Annuler
    if (N == null)
    {
        return;
    }
    //Transforme l'entrée en nombre si possible
    N = Number(N);
    //Gestion d'erreur d'entrée utilisateur, si l'utilisateur rentre autre chose que des chiffres.
    while (isNaN(N))
    {
        window.alert("Vous n'avez pas rentré un nombre");
        N = window.prompt("Saisissez un nombre entier");
        //Gestion d'erreur si l'utilisateur appuie sur Annuler
        if (N == null)
        {
            return;
        }
        N = Number(N);
    }
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
    document.getElementById("start2").textContent = "Recommencer";
}

//--
//Code pour l'Exercice 3
//--

//Ecoute des boutons d'affichage de l'interface de l'Exercice 3
var bouton3 = document.getElementById("Exo3");
bouton3.addEventListener("click", Exo3);
var bouton3md = document.getElementById("Exo3-md");
bouton3md.addEventListener("click", Exo3);

//Fonction qui affiche l'interface de l'Exercice 3
function Exo3()
{
    //Texte de l'interface de l'Exercice 3
    document.getElementById("titre").textContent = "Execice 3";
    document.getElementById("enonce").textContent = "Nous avons un tableau de prénoms, quand vous trouverez un prénom dans le tableau, il sera retiré.";
    document.getElementById("deroule").textContent = "Nous allons vous demander de rentrer un prénom, nous allons voir si il existe dans le tableau puis le retirer de celui-ci. (Recommencer, remet le tableau à son état initial, Chercher ouvre la fenêtre pour entrer un prénom à chercher dans le tableau)";
    AffBouton(3);
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
    //Gestion d'erreur si l'utilisateur appuie sur Annuler
    if (prenom == null)
    {
        return tab;
    }
    var i;
    var n = -1;
    //Parcours du tableau tab
    for (i=0 ; i<tab.length ; i+=1)
    {
        //Récupération du numéro de la case contenant le prénom
        if (tab[i].toUpperCase() == prenom.toUpperCase())
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

//Ecoute des boutons d'affichage de l'interface de l'Exercice 4
var bouton4 = document.getElementById("Exo4");
bouton4.addEventListener("click", Exo4);
var bouton4md = document.getElementById("Exo4-md");
bouton4md.addEventListener("click", Exo4);

//Fonction qui affiche l'interface de l'Exercice 4
function Exo4()
{
    //Texte de l'interface de l'Exercice 4
    document.getElementById("titre").textContent = "Execice 4";
    document.getElementById("enonce").textContent = "Nous allons afficher une facture à partir du prix unitaire d'un produit et de sa quantité commandée.";
    document.getElementById("deroule").textContent = "Nous allons vous demander de rentrer le prix unitaire d'un produit et la quantité commandée, nous afficherons le prix total à payer qui prend en compte les remises possibles et les frais de port.";
    AffBouton(4);
    document.getElementById("result").textContent = "";
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
    PU = window.prompt("Saisissez le prix unitaire du produit");
    //Gestion d'erreur si l'utilisateur appuie sur Annuler
    if (PU == null)
    {
        return;
    }
    //Transforme l'entrée en nombre si possible
    PU = parseFloat(PU);
    //Gestion d'erreur d'entrée utilisateur, si l'utilisateur rentre autre chose que des chiffres ou un nombre négatif.
    while (isNaN(PU) || PU < 0)
    {
        window.alert("Vous n'avez pas rentré un prix correct");
        PU = window.prompt("Saisissez le prix unitaire du produit");
        //Gestion d'erreur si l'utilisateur appuie sur Annuler
        if (PU == null)
        {
            return;
        }
        PU = parseFloat(PU);
    }
    //Demande de la Quantité Commandée à l'utilisateur
    QTECOM = window.prompt("Saisissez la quantité commandée du produit");
    //Gestion d'erreur si l'utilisateur appuie sur Annuler
    if (QTECOM == null)
    {
        return;
    }
    //Transforme l'entrée en nombre si possible
    QTECOM = parseInt(QTECOM);
    //Gestion d'erreur d'entrée utilisateur, si l'utilisateur rentre autre chose que des chiffres ou un nombre négatif.
    while (isNaN(QTECOM) || QTECOM < 0)
    {
        window.alert("Vous n'avez pas rentré une quantité commandée correcte");
        QTECOM = window.prompt("Saisissez la quantité commandée du produit");
        //Gestion d'erreur si l'utilisateur appuie sur Annuler
        if (QTECOM == null)
        {
            return;
        }
        QTECOM = parseInt(QTECOM);
    }
    //Initialisation du premier Sous-Total avant remise et frais supplémentaires
    ////On utilise *100 et /100 pour palier à une limitation de JavaScript sur les opérations avec des nombres à virgule, voir https://www.w3schools.com/js/js_numbers.asp paragraphe Precision (sans ça, on récupère un millième de milième de nul part)
    var TOT1 = (Math.round(PU*100) * QTECOM)/100;
    //Ajout d'une remise si le Sous-Total est supérieur à 100€
    if (TOT1 >= 100)
    {
        //Remise de 10% si le Sous-Total est supérieur à 200€
        if (TOT1 > 200)
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

    //Initialisation du second Sous-Total après remise et avant frais supplémentaires
    ////On utilise *100 et /100 pour palier à une limitation de JavaScript sur les opérations avec des nombres à virgule, voir https://www.w3schools.com/js/js_numbers.asp paragraphe Precision (sans ça, on récupère un millième de milième de nul part)
    var TOT2 = Math.round(((TOT1*100) * (100-REM))/100)/100;
    //Frais de Port à 0€ si le Sous-Total est supérieur à 500€
    if (TOT2 >= 500)
    {
        PORT = 0;
    }
    //Frais de Port à 2% du Sous-Total quand en dessous de 500€
    else
    {
        //Calcul des frais de Port en calculant 2% du Sous-Total
        ////On utilise *100 et /10000 pour palier à une limitation de JavaScript sur les opérations avec des nombres à virgule, voir https://www.w3schools.com/js/js_numbers.asp paragraphe Precision (sans ça, on récupère un millième de milième de nul part)
        PORT = Math.round(((TOT2*100) * (0.02*100))/100)/100;
        //Si les 2% sont inférieur à 6€, les frais de Port sont de 6€
        if (PORT < 6)
        {
            PORT = 6;
        }
    }

    //Calcul du Prix A Payer, en lui appliquant le pourcentage de Remise et en lui ajoutant les frais de Port
    ////On utilise *100 et /100 pour palier à une limitation de JavaScript sur les opérations avec des nombres à virgule, voir https://www.w3schools.com/js/js_numbers.asp paragraphe Precision (sans ça, on récupère un millième de milième de nul part)
    PAP = ((TOT2*100) + (PORT*100))/100;

    //Initialisation d'une chaine contenant du code HTML de la facture à afficher dans la page
    var code = "Prix unitaire : "+PU+"€<br>Quantité : "+QTECOM+"<br>Sous-Total avant remise : "+TOT1+"€<br>Remise : "+REM+"%<br>Sous-Total après remise : "+TOT2+"€<br>Frais de port : "+PORT+"€<br>Total à payer : "+PAP+"€";

    //Affichage du resultat en injectant le code HTML de la facture dans la page
    document.getElementById("result").innerHTML = code;
    //Changement de nom du bouton
    document.getElementById("start4").textContent = "Recommencer";
}

//Fonction de gestion d'affichage des boutons spécifiques aux exercices
function AffBouton(bouton)
{
    //ajout d'une classe Bootstrap pour qu'ils n'apparaissent pas
    document.getElementById("start1").classList.add('d-none');
    document.getElementById("start2").classList.add('d-none');
    document.getElementById("grp3").classList.add('d-none');
    document.getElementById("start4").classList.add('d-none');
    //retire la classe Bootstrap en fonction de l'exercice, permettant qu'il apparaisse
    switch (bouton)
    {
        case 1:
            document.getElementById("start1").classList.remove('d-none');
        break;
        
        case 2:
            document.getElementById("start2").classList.remove('d-none');
        break;

        //cas spécial pour l'Exercice 3, à cause de l'envoie du tableau via EventListener, si on se contente de faire disparaitre et aparaitre le bouton, il fera l'objet de plusieurs EventListener qui lanceront une copie du programme en parrallèle, donc les boutons sont recréés entièrement à chaque passage, pour qu'il n'est qu'un seul et unique EventListener
        case 3:
            document.getElementById("grp3").classList.remove('d-none');
            var boutons3 = document.getElementById("grp3").innerHTML;
            document.getElementById("grp3").innerHTML = boutons3;
        break;

        case 4:
            document.getElementById("start4").classList.remove('d-none');
        break;
    } 
}