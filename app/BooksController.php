<?php

declare(strict_types=1);

require_once 'config.php';
require_once 'ApiHandler.php';
require_once __DIR__ . '/GenreController.php';
require_once __DIR__ . '/util/Utils.php';

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

        $headers = [
            'Content-Type: application/json'
        ];

        try {
            return $this->apiHandler->makeRequest('/books', 'POST', $data, $headers);
        } catch (Exception $e) {
            echo $e->getMessage();
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
    $booksController = new BooksController();
    $genreController = new GenreController();
    $genres = $genreController->getGenres();
    $genreTitles = [];
    
    foreach($genres as $genre) {
        $genreTitle = $genre['name'];
        if (isset($_POST[$genreTitle])) {
            $genreTitles[] = $genreTitle;
        }
    }

    $bookId = $booksController->createBook(
        $_POST['title'],
        $_POST['author'],
        $_POST['description'],
        (int) $_POST['pages'],
        $_POST['editorial'],
        (int) $_POST['price'],
        $_POST['release_date'],
        $_POST['isbn'],
        $genreTitles
    );

    echo $bookId;
    die();

    if (saveImage("$bookId")) {
        $_SESSION['success'] = 'Se agrego el libro correctamente';
        header("Location: " . VIEWS_PATH . "pages/admin/panel.php");
    } else {
        redirect_back();
    }

}

function updateBook() {
    echo 'updateasdfasdfasdf';
}

function saveImage($book_id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && $_FILES['image']['error']  === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!in_array($image['type'], $allowedTypes)) {
            setErrorRedirect('Solo se permiten imagenes .jpeg .png .jpg y .gif');
        }

        if ($image['size'] > 5 * 1024 * 1024) {
            setErrorRedirect('El tamaño de la imagen no debe exceder los 5 MB');
        }

        $uploadDir = __DIR__ . '/../public/img/books/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imageName = $book_id . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
        $imagePath = $uploadDir . $imageName;
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            setErrorRedirect('Error al mover la imagen');
        }

        return true;
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    cleanPostInputs();

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
