<?php
$host = 'localhost:3306';
$dbname = 'agence';
$username = 'root';
$password = '';
try {
    $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Impossible de se connecter à la base de données $dbname : " . $e->getMessage());
}
?>