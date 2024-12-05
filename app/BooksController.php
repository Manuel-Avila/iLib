<?php

declare(strict_types=1);

require_once 'ApiHandler.php';
require_once __DIR__ . '/GenreController.php';

final class BooksController {

    private ApiHandler $apiHandler;

    public function __construct() {
        $this->apiHandler = new ApiHandler('https://library-api-0e3t.onrender.com');
    }

    public function getBooks() : array {
        try {
            return $this->apiHandler->makeRequest('/books');
        } catch (Exception $e) {
            return [];
        }
    }

    public function createBook(
        string $title,
        string $author,
        string $description,
        int $pages,
        string $editorial,
        int $price,
        string $release_date,
        string $isbn,
        array $genre,
    ) : array {
        if (empty($title) || empty($author) || empty($description) || empty($pages) || empty($editorial) || empty($price) || empty($release_date) || empty($isbn) || empty($genre)) {
            return [];
        }

        $data = [
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'pages' => $pages,
            'editorial' => $editorial,
            'price' => $price,
            'release_date' => $release_date,
            'isbn' => $isbn,
            'genre' => $genre,
        ];

        try {
            return $this->apiHandler->makeRequest('/books', 'POST', $data);
        } catch (Exception $e) {
            return [];
        }
    }

    public function editBook(
        string $id,
        array $data
    ) : array {
        if (empty($id) || empty($data)) {
            return [];
        }

        try {
            return $this->apiHandler->makeRequest('/books/' . $id, 'PATCH', $data);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getBookById(
        string $id
    ) : array {
        try {
            return $this->apiHandler->makeRequest('/books/' . $id);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getBooksByAuthor(
        string $author
    ) : array {
        try {
            return $this->apiHandler->makeRequest('/books?author=' . $author);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getBooksSimilarById(
        string $id
    ) : array {
        try {
            return $this->apiHandler->makeRequest('/books/similar/' . $id);
        } catch (Exception $e) {
            return [];
        }
    }

    public function deleteBook(
        string $id
    ) : array {
        try {
            return $this->apiHandler->makeRequest('/books/' . $id, 'DELETE');
        } catch (Exception $e) {
            return [];
        }
    }
}

function addBook() {
    $genreController = new GenreController();
    $genres = $genreController->getGenres();
    $genreTitles = [];
    
    foreach($genres as $genre) {
        $genreTitle = $genre['name'];
        if (isset($_POST[$genreTitle])) {
            $genreTitles[] = $genreTitle;
        }
    }

    var_dump($genreTitles);
}

function updateBook() {
    echo 'updateasdfasdfasdf';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['book_id'])) {
        updateBook();
        exit();
    }
    addBook();
} else {
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $booksController = new BooksController();
        $booksController->deleteBook($_GET['book_id']);
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("Location: $previousPage");
    }
}
