<?php
//Fonction de sécurité qui prend une chaine de caractères, y retire des blancs, les antislashs et transforme les caractères spéciaux en entités HTML
    function verifstring($chaine)
    {
        //vérifie que le paramètre est bien une chaine de caractères
        if (is_string($chaine))
        {
            //on lui retire les espaces au début et en fin de chaine
            $chaine = trim($chaine);
            //on lui retire les antislashs
            $chaine = stripslashes($chaine);
            //on transforme les caractères spéciaux en entités HTML, puis retourne la nouvelle chaine
            return htmlspecialchars($chaine);
        }
        else //le paramètre n'est pas une chaine de caractères
        {
            //on revoie rien
            return null;
        }
    }

//Fonction qui prend un id de Role et un tableau d'id de Role, et renvoie true si le Role est dans le tableau et false si il n'y est pas 
    function verifrole($role, $tab)
    {
        foreach ($tab as $i => $autorise)
        {
            if ($role == $autorise)
            {
                return true;
            }
        }
        return false;
    }
?>