<?php
require_once 'ApiHandler.php';

class BooksController {
    private $apiHandler;

    public function __construct() {
        $this->apiHandler = new ApiHandler('https://library-api-0e3t.onrender.com');
    }

    public function getBooks() {
        try {
            $users = $this->apiHandler->makeRequest('/books', 'GET');
            return $users;
        } catch (Exception $e) {
            echo "Error al obtener libros: " . $e->getMessage();
            return [];
        }
    }

    public function getBookById($id) {
        try {
            $book = $this->apiHandler->makeRequest('/books/' . $id, 'GET');
            return $book;
        } catch (Exception $e) {
            echo "Error al obtener libro: " . $e->getMessage();
            return [];
        }
    }
}
