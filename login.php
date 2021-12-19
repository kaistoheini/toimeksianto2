<?php
session_start();
require('headers.php');
require('functions.php');

// Tarkistetaan, tuleeko palvelimelle basic login -tiedot
if( isset($_SERVER['PHP_AUTH_USER']) ){
    if(checkUser(createDbConnection(), $_SERVER['PHP_AUTH_USER'],$_SERVER["PHP_AUTH_PW"] )){
        $_SESSION["user"] = $_SERVER['PHP_AUTH_USER'];
        echo '{"info":"Kirjauduit sisään!"}';
        header('Content-Type: application/json');
        exit;
    }
}
header('Www-Authenticate: Basic');

//Kehotetaan käyttäjää kirjautumaan sisään avaamalla login-ikkuna
echo '{"info":"Epäonnistunut kirjautuminen."}';
header('Content-Type: application/json');
header('HTTP/1.1 401');
exit;