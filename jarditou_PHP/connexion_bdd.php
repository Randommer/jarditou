<?php
    function connexionBase()
    {
        // Paramètre de connexion serveur
        $machine = "localhost";
        $login= "phpusr";  // Votre loggin d'accès au serveur de BDD
        $mdp="IAmTheB3st";    // Le Password pour vous identifier auprès du serveur
        $base = "jarditou";  // La bdd avec laquelle vous voulez travailler

        try
        {
            $bdd = new PDO('mysql:host=' .$machine. ';charset=utf8;dbname=' .$base, $login, $mdp);
            return $bdd;
        }
        catch (Exception $e)
        {
            echo 'Erreur : ' . $e->getMessage() . '<br>';
            echo 'N° : ' . $e->getCode() . '<br>';
            die('Connexion au serveur impossible.');
        }
    }
?>