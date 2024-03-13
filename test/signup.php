<?php
require 'database.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone']; 
        $password = $_POST['password']; 

        $stmt = $pdo->prepare("INSERT INTO Customer (username, email, phone_number, password) VALUES (:username, :email, :phone, :password)");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        echo "User registered successfully!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
