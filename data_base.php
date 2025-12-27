<?php

$host = 'localhost';
$username = 'finalproj_user';
$password = 'password123';
$dbname = 'dolphin_crm';

try {
    $conn = new PDO(
        "mysql:host=$host;port=3307;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database connection failed: ". $e->getMessage());
}
