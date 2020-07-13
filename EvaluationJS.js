var bouton1 = document.getElementById("Exo1");
bouton1.addEventListener("click", Exo1);

function Exo1()
{
    document.getElementById("titre").innerHTML = "Execice 1";
    document.getElementById("enonce").innerHTML = "Nous allons dénombrer les personnes d'âge strictement inférieur à 20 ans, les personnes d'âge strictement supérieur à 40 ans et celles dont l'âge est compris entre 20 ans et 40 ans (20 ans et 40 ans y compris).";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer des ages les uns à la suite des autres, quand vous aurez terminé, rentrer l'age d'une personne centenaire.";
    document.getElementById("start").innerHTML = "<button id='start1'>Commencer</button>"
    var start1 = document.getElementById("start1");
    start1.addEventListener("click", Go1);
    document.getElementById("result").innerHTML = "";
}

function Go1()
{
    var min = 0, maj = 0, sen = 0, n = 0, p = 0;
    while (p<100)
    {
        n++;
        p = parseInt(window.prompt("Saisissez l'âge de la personne n°"+n+"\n(Entrez un age de 100 ou plus pour stopper le programme)"));
        if (p<20)
        {
            min++;
        }
        else
        {
            if (p<=40)
            {
                maj++;
            }
            else
            {
                sen++;
            }
        }
    }

    if (n==1)
    {
        document.getElementById("result").innerHTML = "La personne que vous avez rentré, a plus de 40 ans.";
    }
    else
    {
        if (sen == n)
        {
            document.getElementById("result").innerHTML = "Toutes les "+n+" personnes que vous avez rentré, ont de plus de 40 ans.";
        }
        else
        {
            document.getElementById("result").innerHTML = "Sur les "+n+" personnes que vous avez rentré, il y a <object id='mineur'></object><object id='majeur'></object>"+sen+" personne<object id='senior'></object> de plus de 40 ans.";
            if (min!=0)
            {
                if (min==1)
                {
                    document.getElementById("mineur").innerHTML = min+" personne de moins de 20 ans, ";
                }
                else
                {
                    document.getElementById("mineur").innerHTML = min+" personnes de moins de 20 ans, ";
                }
            }
            if (maj!=0)
            {
                if (maj==1)
                {
                    document.getElementById("majeur").innerHTML = maj+" personne entre 20 et 40 ans et ";
                }
                else
                {
                    document.getElementById("majeur").innerHTML = maj+" personnes entre 20 et 40 ans et ";
                }
            }
            if (sen>1)
            {
                document.getElementById("senior").innerHTML = "s";
            }
        }
    }
    document.getElementById("start1").innerHTML = "Recommencer";
}

var bouton2 = document.getElementById("Exo2");
bouton2.addEventListener("click", Exo2);

function Exo2()
{
    document.getElementById("titre").innerHTML = "Execice 2";
    document.getElementById("enonce").innerHTML = "Nous allons afficher une table de multiplication.";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer un nombre entier, une fois rentré la page affichera sa table de multiplication.";
    document.getElementById("start").innerHTML = "<button id='start2'>Commencer</button>"
    var start2 = document.getElementById("start2");
    start2.addEventListener("click", Go2);
    document.getElementById("result").innerHTML = "";
}

function Go2()
{
    var N = parseInt(window.prompt("Saisissez un nombre entier"));
    var i;
    var code = String();
    for (i=1 ; i<11 ; i+=1)
    {
        code  = code+i+" x "+N+" = "+(N*i)+"<br>";
    }
    document.getElementById("result").innerHTML = code;
    document.getElementById("start2").innerHTML = "Recommencer";
}

var bouton3 = document.getElementById("Exo3");
bouton3.addEventListener("click", Exo3);

function Exo3()
{
    document.getElementById("titre").innerHTML = "Execice 3";
    document.getElementById("enonce").innerHTML = "Nous avons un tableau de prénoms, quand vous trouverez un prénom dans le tableau, il sera retiré.";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer un prénom, nous allons voir si il existe dans le tableau puis le retirer de celui-ci. (Recommencer, remet le tableau à son état initial, Chercher ouvre la fenêtre pour entrer un prénom à chercher dans le tableau)";
    document.getElementById("start").innerHTML = "<button id='restart'>Recommencer</button><button id='start3'>Chercher</button>"
    var tab = ["Audrey", "Aurélien", "Flavien", "Jérémy", "Laurent", "Melik", "Nouara", "Salem", "Samuel", "Stéphane"];
    var start3 = document.getElementById("start3");
    start3.addEventListener("click", function(){ tab = Go3(tab); });
    var restart = document.getElementById("restart");
    restart.addEventListener("click", Exo3);
    AfficheTab(tab);
}

function Go3(tab)
{
    var prenom = window.prompt("Saisissez un prénom");
    var i;
    var n = -1;
    for (i=0 ; i<tab.length ; i+=1)
    {
        if (tab[i] == prenom)
        {
            n = i;
        }
    }
    if (n != -1)
    {
        for (i=n ; i<tab.length ; i+=1)
        {
            if (i+1==tab.length)
            {
                tab[i] = " ";
            }
            else
            {
                tab[i] = tab[i+1];
            }
        }
    }
    else
    {
        window.alert("Désolé, "+prenom+" n'est pas dans le tableau.");
    }
    AfficheTab(tab);
    return tab;
}

function AfficheTab(tab)
{
    var code = "<h3>Tableau tab :</h3>";
    var i;
    for (i=0 ; i<tab.length ; i+=1)
    {
        code = code+"<br>case "+(i+1)+" : "+tab[i];
    }
    document.getElementById("result").innerHTML = code;
}

var bouton4 = document.getElementById("Exo4");
bouton4.addEventListener("click", Exo4);

function Exo4()
{
    document.getElementById("titre").innerHTML = "Execice 4";
    document.getElementById("enonce").innerHTML = "Nous allons afficher une facture à partir du prix unitaire d'un produit et de sa quantité commandée.";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer le prix unitaire d'un produit et la quantité commandée, nous afficherons le prix total à payer qui prend en compte les remises possibles et les frais de port.";
    document.getElementById("start").innerHTML = "<button id='start4'>Commencer</button>"
    var start4 = document.getElementById("start4");
    start4.addEventListener("click", Go4);
    document.getElementById("result").innerHTML = "";
}

function Go4()
{
    var PU, QTECOM, PAP, REM, PORT;
    PU = parseFloat(window.prompt("Saisissez le prix unitaire du produit"));
    QTECOM = parseInt(window.prompt("Saisissez la quantité commandée du produit"));
    var TOT = ((PU*100) * QTECOM)/100;
    if (TOT >= 100)
    {
        if (TOT > 200)
        {
            REM = 10;
        }
        else
        {
            REM = 5;
        }
    }
    else
    {
        REM = 0;
    }

    if (TOT > 500)
    {
        PORT = 0;
    }
    else
    {
        PORT = ((TOT*100) * (0.02*100))/10000;
        if (PORT < 6)
        {
            PORT = 6;
        }
    }
    
    PAP = (((TOT*100) * (100-REM))/100 + (PORT*100))/100;

    var code = "Prix unitaire : "+PU+"€<br>Quantité : "+QTECOM+"<br>Sous-Total : "+TOT+"€<br>Remise : "+REM+"%<br>Frais de port : "+PORT+"€<br>Total à payer : "+PAP+"€";

    document.getElementById("result").innerHTML = code;

    document.getElementById("start4").innerHTML = "Recommencer";
}