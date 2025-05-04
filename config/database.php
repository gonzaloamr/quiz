<?php
$host = 'mysql.gonzalomunoz.fun';
$dbname = 'gonzalomunoz04';
$username = 'gonzalomunoz04';
$password = '5m9itrci';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8mb4");
    $pdo->exec("SET CHARACTER SET utf8mb4");
    $pdo->exec("SET character_set_connection=utf8mb4");
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?> 