<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="index.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];

echo "Hallo User: ".$userid;
echo '<br><a href="index.php">Login Seite</a>';

?>