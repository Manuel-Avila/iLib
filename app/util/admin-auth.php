<?php 
    require_once __DIR__ . "/../config.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: ' . BASE_PATH);
    }
?>