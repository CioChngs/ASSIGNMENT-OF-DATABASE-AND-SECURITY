<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT password FROM Customer WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            if ($password === $user['password']) {
                session_start();
                $_SESSION['username'] = $username;
                header("Location: order.html");
                exit();
            } else {
                echo "Invalid password";
            }
        } else {
            echo "Invalid username";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>