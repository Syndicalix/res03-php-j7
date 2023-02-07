<?php

function checkRoute(string $route) : void 
{
    if ($route === "connexion"){
        require "pages/login.php";
    }
    else if ($route === "creer-un-compte"){
        require "pages/register.php";
    }
    else if ($route === "mon-compte"){
        if (isset ($_SESSION["passwordValid"]) && $_SESSION["passwordValid"]===true){
        require "pages/account.php";
    }
    else{
        echo "Session invalide";
        }
    }
    else{
        require "pages/homepage.php";
    }
}

?>