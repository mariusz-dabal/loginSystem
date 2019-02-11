<?php

session_start();

if (isset($_POST['login_submit'])) {

    require "db.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['email'] = $email;

    $stmt = $pdo->prepare("SELECT email, password, is_active FROM users WHERE email = :email AND is_active = true");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['is_auth'] = true;
            setcookie("user", $email, time() + 86400 , "/");
            header("Location: ../index.php");
        } else {
            header("Location: ../login.php");
            $_SESSION['e_login'] = "Niepoprawny email lub hasło!";
        }
    } else {
        header("Location: ../login.php");
        $_SESSION['e_login'] = "Niepoprawny email lub hasło!";
    }
  
} else {
    header("Location: ../login.php");
    exit();
}