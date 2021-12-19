<?php
require('headers.php');
require('functions.php');

$json = json_decode(file_get_contents('php://input'));

$firstname = filter_var($json->firstname, FILTER_SANITIZE_STRING);
$lastname = filter_var($json->lastname, FILTER_SANITIZE_STRING);
$username = filter_var($json->username, FILTER_SANITIZE_STRING);
$password = filter_var($json->password, FILTER_SANITIZE_STRING);

$db = createDbConnection();

createUser($db, $firstname, $lastname, $username, $password);