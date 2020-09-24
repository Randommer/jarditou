//Ecoute du bouton Déconnexion, active la fonction Out quand la souris passe dessus
document.getElementById("logbut").addEventListener("mouseover", Out);

//Fonction qui change la classe de l'icone du bouton
function Out()
{
    var logicon = document.getElementById("logicon");
    logicon.classList.remove('fa-user');
    logicon.classList.add('fa-sign-out-alt');
}

//Ecoute du bouton Déconnexion, active la fonction UsrOut quand la souris n'est plus au dessus du bouton
document.getElementById("logbut").addEventListener("mouseout", UsrOut);

//Fonction qui change la classe de l'icone du bouton
function UsrOut()
{
    var logicon = document.getElementById("logicon");
    logicon.classList.remove('fa-sign-out-alt');
    logicon.classList.add('fa-user');
}