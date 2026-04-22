<?php
require_once 'theme_handler.php';
$host = "127.0.0.1";        // o localhost
$port = 3310;               // Puerto MySQL
$db   = "erronka3";
$user = "root";
$pass = "";                 // XAMPP suele dejar la contraseña vacía

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Errorea DB-ra konektatzean: " . $e->getMessage());
}
?>
