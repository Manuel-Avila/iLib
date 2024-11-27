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
            return [];
        }
    }

    public function getBookById($id) {
        try {
            $book = $this->apiHandler->makeRequest('/books/' . $id, 'GET');
            return $book;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getBooksByAuthor($author) {
        try {
            $book = $this->apiHandler->makeRequest('/books?author=' . $author, 'GET');
            return $book;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getBooksSimilarById($id) {
        try {
            $book = $this->apiHandler->makeRequest('/books/similar/' . $id, 'GET');
            return $book;
        } catch (Exception $e) {
            return [];
        }
    }
}
