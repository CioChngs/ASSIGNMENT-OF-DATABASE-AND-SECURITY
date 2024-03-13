<?php
$servername = "localhost";
$username = "cio";
$password = "Qwer*1234";
$database = "coffee_shop";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>