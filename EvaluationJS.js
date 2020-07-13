var bouton1 = document.getElementById("Exo1");
bouton1.addEventListener("click", Exo1);
var start1 = document.getElementById("start");
start1.addEventListener("click", Go1);

function Exo1()
{
    document.getElementById("titre").innerHTML = "Execice 1";
    document.getElementById("enonce").innerHTML = "Nous allons dénombrer les personnes d'âge strictement inférieur à 20 ans, les personnes d'âge strictement supérieur à 40 ans et celles dont l'âge est compris entre 20 ans et 40 ans (20 ans et 40 ans y compris).";
    document.getElementById("deroule").innerHTML = "Nous allons vous demander de rentrer des ages les uns à la suite des autres, quand vous aurez terminé, rentrer l'age d'une personne centenaire.";
    document.getElementById("start").innerHTML = "<button id='start'>Commencer</button>"
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
}

var bouton2 = document.getElementById("Exo2");
bouton2.addEventListener("click", Exo2);

function Exo2()
{
    document.getElementById("titre").innerHTML = "Execice 2";
    window.alert("Yeah ! 2");
}

var bouton3 = document.getElementById("Exo3");
bouton3.addEventListener("click", Exo3);

function Exo3()
{
    document.getElementById("titre").innerHTML = "Execice 3";
    window.alert("Yeah ! 3");
}

var bouton4 = document.getElementById("Exo4");
bouton4.addEventListener("click", Exo4);

function Exo4()
{
    document.getElementById("titre").innerHTML = "Execice 4";
    window.alert("Yeah ! 4");
}