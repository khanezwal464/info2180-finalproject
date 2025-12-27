<?php
$host = 'localhost';
$dbname = 'dolphin_crm';
$username = 'finalproj_user';
$password = 'password123';

try {
    $pdo = new PDO("mysql:host=$host;port=3307;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo "Failed to connect to database: " . $err->getMessage();
}

?>
