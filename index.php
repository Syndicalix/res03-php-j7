<?php

require "logic/router.php";
require "logic/database.php";


$newUser = [
    "firstName" => "",
    "lastName" => "",
    "email" => "",
    "password" => ""
    ];


$errorMessage = "";

if (isset ($_POST["firstName"]) && !empty($_POST["firstName"]) 
&& isset ($_POST["lastName"]) && !empty($_POST["lastName"]) 
&& isset ($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
&& isset ($_POST["password"]) && !empty($_POST["password"]) 
&& isset ($_POST["confirmPassword"]) && !empty($_POST["confirmPassword"]) && $_POST["password"] === ($_POST["confirmPassword"])){

    $newUser["firstName"] = $_POST["firstName"];
    $newUser["lastName"] = $_POST["lastName"];
    $newUser["email"] = $_POST["email"];
    $newUser["password"] = $_POST["password"];

    $userToSave = new User($newUser["firstName"], $newUser["lastName"], $newUser["email"], $newUser["password"]);
    saveUser($userToSave);
}






if (isset ($_POST["loginEmail"]) && !empty($_POST["loginEmail"]) && isset ($_POST["loginPassword"]))
{
    $loginEmail = $_POST["loginEmail"];
    $loginPassword = $_POST["loginPassword"];
    $userToConnect = loadUser($loginEmail);
        if (password_verify($loginPassword, $UserToConnect->getPassword())) {
            $_GET["route"] = "mon-compte";
            $_SESSION["passwordValid"] = true;
            $_SESSION["sessionId"] = $userToConnect->getId();
            
            var_dump ($_SESSION);
        }
        else{
            echo "mot de passe incorrect";
        }
}


if (isset($_GET["route"])){
    checkRoute($_GET["route"]);
}
else{
    checkRoute("");
}


?>

