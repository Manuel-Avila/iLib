<?php
    include_once 'config.php';

    setcookie('user_token', '', time() - 3600, '/');
    header('Location: ' . BASE_PATH . 'login');