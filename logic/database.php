<?php
require "models/User.php";


function loadUser(string $email) : ?User {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=sebastienspeich_phpj7",
        "sebastienspeich",
        "78e591a8c7d3161b1f57097e0e688eba"
    );
    $query = $db->prepare('SELECT * FROM users WHERE email=:email');
    $parameters = ['email' => $email];
    $query->execute($parameters);
    $loadedUser = $query->fetch(PDO::FETCH_ASSOC);
    
    $loadedUserObject = new User ($loadedUser["firstName"], $loadedUser["lastName"], $loadedUser["email"], $loadedUser["password"]);
    $loadedUserObject->setId($loadedUser["id"]);
    
    return $loadedUserObject;
}

function saveUser(User $user) : User {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=sebastienspeich_phpj7",
        "sebastienspeich",
        "78e591a8c7d3161b1f57097e0e688eba"
    );
    $query = $db->prepare('INSERT INTO users VALUES (null, :firstName, :lastName, :email, :password)');
    $parameters = [
    'firstName' => $user->getFirstName(),
    'lastName' => $user->getLastName(),
    'email' => $user->getEmail(),
    'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT)
    ];
    $query->execute($parameters);
    
    return loadUser($user->getEmail());

}





/*session_start();

$_SESSION["user"] = "John Doe";

$user = new User("John", "Doe");

$_SESSION["user"] = $user;

*/


?>