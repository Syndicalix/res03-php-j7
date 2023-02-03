<?php

function checkRoute(string $route) : void 
{
    if ($_GET['route'] === 'connexion') {
        require './login.php';
    } else if ($_GET['route'] === 'creer-un-compte') {
        require 'pages/register.php';
    } else if ($_GET['route'] === 'mon-compte') {
        require 'pages/account.php';
    } else {
        require 'pages/homepage.php';
    }
}

?>