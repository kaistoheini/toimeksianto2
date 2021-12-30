<?php
require('headers.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {    
    return 0;    
 } 
try
 {
$data = json_decode(file_get_contents('php://input'));
if($data)
{
$firstNameFromPost = filter_var($data->firstname, FILTER_SANITIZE_STRING);
$lastNameFromPost = filter_var($data->lastname, FILTER_SANITIZE_STRING);
$usernameFromPost = filter_var($data->username, FILTER_SANITIZE_STRING);
$passwordFromPost = filter_var($data->password, FILTER_SANITIZE_STRING);

$passwordFromPost = hash("md5",$passwordFromPost);
$sql = "";
$dbcon = createDbConnection();
$sql = "insert into customer (firstname, lastname, username, password) values ('$firstNameFromPost','$lastNameFromPost', '$usernameFromPost','$passwordFromPost')";
    $query = $dbcon->query($sql);
    header('HTTP/1.1 201 Created');
}
else {
    header('HTTP/1.1 400 Bad Request');
}
}
catch (Error $error)
{
    header('HTTP/1.1 400 Bad Request');
}
?>