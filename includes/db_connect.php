<?php
$host = 'localhost';
$db   = 'adopteunchien_db';
$user = 'root'; // Remplacez par votre nom d'utilisateur MySQL si différent
$pass = ''; // Remplacez par votre mot de passe MySQL si différent (souvent vide pour root en local)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>