<?php
    //Fonction de connexion à la base de donnéee
    function connexionBase()
    {
        //Paramètres de connexion au serveur
        $machine = "localhost";//IP du serveur
        $login= "phpusr";//Loggin d'accès au serveur
        $mdp="IAmTheB3st";//Mot de passe d'identification pour l'accès au serveur
        $base = "jarditou";//Base de donnée sur laquelle vous voulez vous connectez

        //Tentative de connexion
        try
        {
            //Connexion via PDO
            $bdd = new PDO('mysql:host=' .$machine. ';charset=utf8;dbname=' .$base, $login, $mdp);
            //Renvoie de la connexion
            return $bdd;
        }
        catch (Exception $e)//Gestion d'erreurs de connexion
        {
            echo 'Erreur : ' . $e->getMessage() . '<br>';
            echo 'N° : ' . $e->getCode() . '<br>';
            die('Connexion au serveur impossible.');
        }
    }
?>