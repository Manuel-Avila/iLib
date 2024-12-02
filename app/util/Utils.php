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