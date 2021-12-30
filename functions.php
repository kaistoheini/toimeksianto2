<?php
/* Tarkistetaan, onko käyttäjä ja salasana tietokannassa*/
function checkUser(PDO $dbcon, $username, $passwd){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $sql = "SELECT password FROM user WHERE username=?";  
        $prepare = $dbcon->prepare($sql);   
        $prepare->execute(array($username));

        $rows = $prepare->fetchAll(); 

        foreach($rows as $row){
            $pw = $row["password"];  
            if( password_verify($passwd, $pw) ){
                return true;
            }
        }

        // Palautetaan false, mikäli käyttäjää & salasanaa ei löydy tietokannasta
        return false;

    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

 /* Luodaan uusi käyttäjä tietokantaan ja "hashataan" salasana */
function createUser(PDO $dbcon, $username, $passwd){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT); 
        $sql = "INSERT IGNORE INTO user VALUES (?,?)"; 
        $prepare = $dbcon->prepare($sql); 
        $prepare->execute(array($username, $hash_pw));
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

/* Luodaan ja palautetaan tietokantayhteys */
function createDbConnection(){

    try{
        $dbcon = new PDO('mysql:host=localhost:3307;dbname=v0kahe03', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

    return $dbcon;
}

function returnError(PDOException $pdoex) {
    header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex->getMessage());
    print json_encode($error);
}

function executeInsert(object $db,string $sql): int {
    $query = $db->query($sql);
    return $db->lastInsertId();
}
?>