<?php
require_once('functions.php');
require_once('headers.php');

$input = json_decode(file_get_contents('php://input'));
$firstname = filter_var($input->firstname,FILTER_SANITIZE_STRING);
$lastname = filter_var($input->lastname,FILTER_SANITIZE_STRING);

$dbcon = null;

try{
    $dbcon = createDbConnection();

    $query = $dbcon->prepare('insert into info(firstname, lastname) values (:firstname, :lastname)');
    $query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindValue(':lastname', $lastname);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $dbcon->lastInsertId(), 'firstname' => $firstname, 'lastname' => $lastname);
    print json_encode($data);
} catch (PDOException $e) {
    echo '<br>'.$e->getMessage();
}
?>