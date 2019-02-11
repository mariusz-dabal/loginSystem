<?php

require "inc/db.php";

if (!isset($_GET['hash'])) {
    header("Location: index.php");
    exit();
} else {
    $hash = $_GET['hash'];
    $stmt = $pdo->prepare("UPDATE users SET is_active = 1 WHERE activate_string = :activate_string");
    $stmt->execute(['activate_string' => $hash]);

    header("Location: index.php?activate=true");
    exit();
}