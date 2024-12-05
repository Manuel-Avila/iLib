<?php

    include_once 'ApiHandler.php';

    if (!isset($_COOKIE['user_token'])) {
        header('Location: ' . BASE_PATH . 'login');
        return;
    }

    $userToken = $_COOKIE['user_token'];

    $api = new ApiHandler('https://library-api-0e3t.onrender.com');
    try {
        $user = $api->makeRequest('/users/login', 'POST', [
            "Authorization: Bearer " . $userToken,
            "Content-Type: application/json"
        ]);

        if ($user['role'] === 'user') {
            header('Location: ' . BASE_PATH . 'error?code=401');
            return;
        }

    } catch (Exception $e) {
        header('Location: ' . BASE_PATH . 'login');
    }