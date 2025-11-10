<?php

require("conexion.php");

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :e AND password = :p");
$stmt->bindParam(':e', $_POST["email"]);

$md5 = md5($_POST["password"]);

$stmt->bindParam(':p', $md5);
$stmt->execute();

$result = $stmt->fetch();

if (is_array($result) == true) {

    session_start();
    $_SESSION['users'] = $result;

    header('location: dashboard.php');
} else {
    header('location: loginPage.php?badInformation=true');
}
