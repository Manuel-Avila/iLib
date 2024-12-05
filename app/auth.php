<?php

    include_once 'ApiHandler.php';

    if (!isset($_COOKIE['user_token'])) {
        header('Location: ' . BASE_PATH . 'login');
        return;
    }

    $userToken = $_COOKIE['user_token'];

    $api = new ApiHandler('https://library-api-0e3t.onrender.com');
    try {
        $user = $api->makeRequest('/users/login', 'POST', [], [
            "Authorization: Bearer " . $userToken,
            "Content-Type: application/json"
        ]);

        if (strpos($_SERVER['REQUEST_URI'], BASE_PATH . 'panel') !== false) {
            if ($user[0]['role'] === 'user') {
                header('Location: ' . BASE_PATH . 'error?code=401');
                return;
            }
        }

    } catch (Exception $e) {
        header('Location: ' . BASE_PATH . 'login');
        setcookie('user_token', '', time() - 3600, '/');
    }