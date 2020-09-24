//Ecoute du bouton Connexion, active la fonction In quand la souris passe dessus
document.getElementById("logbut").addEventListener("mouseover", In);

//Fonction qui change la classe de l'icone du bouton
function In()
{
    var logicon = document.getElementById("logicon");
    logicon.classList.remove('fa-user');
    logicon.classList.add('fa-plug');
}

//Ecoute du bouton Connexion, active la fonction UsrIn quand la souris n'est plus au dessus du bouton
document.getElementById("logbut").addEventListener("mouseout", UsrIn);

//Fonction qui change la classe de l'icone du bouton
function UsrIn()
{
    var logicon = document.getElementById("logicon");
    logicon.classList.remove('fa-plug');
    logicon.classList.add('fa-user');
}