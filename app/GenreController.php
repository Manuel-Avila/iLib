<?php

declare(strict_types=1);

require_once 'ApiHandler.php';

final class GenreController {

    private ApiHandler $apiHandler;

    public function __construct() {
        $this->apiHandler = new ApiHandler('https://library-api-0e3t.onrender.com');
    }

    public function getGenres() : array {
        try {
            return $this->apiHandler->makeRequest('/genres');
        } catch (Exception $e) {
            return [];
        }
    }
}
