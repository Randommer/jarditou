<?php
    //Initialisation de la session du site
    require("session.php");
    //Bibliothèque de fonctions
    require("fonctions.php");

    $_SESSION = array();
    if (ini_get("session.use_cookies")) 
    {
        setcookie(session_name(), '', time()-42);
    }
    session_destroy();
    
    if (isset($_SERVER["HTTP_REFERER"]))
    {
        //on redirige le navigateur vers la page précédente
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
    else
    {
        //on redirige le navigateur vers la page d'accueil
        header("Location: index.php");
    }
?>