<?php
    session_start();
    if (isset($_SESSION["role"]))
    {
        $me = "moi";
    }
    else
    {
        $_SESSION["role"] = 0;
        if (ini_get("session.use_cookies"))
        {
            setcookie(session_name(), '', time()+86400);
        }
    }
?>