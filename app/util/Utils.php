<?php

function convertDate($dateToConvert) {
    try {
        $date = new DateTime($dateToConvert);

        $mouths = [
            1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];

        $day = $date->format('j');
        $mouth = (int)$date->format('n');
        $year = $date->format('Y');

        return "$day de " . $mouths[$mouth] . " del $year";
    } catch (Exception $e) {
        return "Fecha no válida: " . $e->getMessage();
    }
}