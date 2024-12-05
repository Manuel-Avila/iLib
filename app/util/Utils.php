<?php

function convertDate($dateToConvert) {
    try {
        $date = new DateTime($dateToConvert);

        $months = [
            1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];

        $day = $date->format('j');
        $month = (int)$date->format('n');
        $year = $date->format('Y');

        return "$day de " . $months[$month] . " del $year";
    } catch (Exception $e) {
        return "Fecha no válida: " . $e->getMessage();
    }
}

function redirect_back() {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

function setErrorRedirect($message) {
    $_SESSION['errors'][] = $message;
    redirect_back();
}

function cleanPostInputs() {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($_POST[$key]);
        $_POST[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}