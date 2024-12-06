<?php
    include_once "../../../app/config.php";
    include_once "../../../app/BooksController.php";
    include_once "../../../app/GenreController.php";
    require_once __DIR__ . "/../../../app/util/Utils.php";
    include_once "../../../app/auth.php";

    $bookController = new BooksController();
    $controllerPath = '';
    $books = $bookController->getBooks();
    $modalMessage = 'Al presionar el boton aceptar no sera posible recuperar el libro eliminado';
    $genreController = new GenreController();
    $genres = $genreController->getGenres();

    //Mostrar mensaje de exito cuando se agrego o actualizo un libro
    if (isset($_SESSION['success'])) {
        
        $successMessage = $_SESSION['success'];
        $imgPath = BASE_PATH . 'public/img/success.png';
        $success = "<script>showMessageModal('Exito!!', '$successMessage', '$imgPath');</script>";

        unset($_SESSION['success']);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once "../../partials/head.php"; ?>
    <link rel="stylesheet" href="<?= BASE_PATH ?>public/css/books.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>public/css/custom-checkboxes.css">
</head>
<body>
    <?php include_once "../../partials/header.php"; ?>
    <?php include_once VIEWS_PATH . "/partials/message-modal.php"; ?>
    <?php include_once VIEWS_PATH . "/partials/confirm-modal.php"; ?>
<div class="container">
    <!-- Desktop Sidebar -->
    <aside class="desktop-sidebar">
        <h1>Libros</h1>

        <div class="filter-section">
            <div class="filter-header">
                <h2>Precio</h2>
                <span class="toggle-icon">−</span>
            </div>
            <div class="filter-content">
                <label class="radio-label">
                    <input type="radio" name="price" value="none" checked>
                    <span class="radio-custom"></span>
                    Todos
                </label>
                <label class="radio-label">
                    <input type="radio" name="price" value="0 - 100">
                    <span class="radio-custom"></span>
                    Menores de $100
                </label>
                <label class="radio-label">
                    <input type="radio" name="price" value="100 - 500">
                    <span class="radio-custom"></span>
                    $100 - $500
                </label>
                <label class="radio-label">
                    <input type="radio" name="price" value="500 - 1000">
                    <span class="radio-custom"></span>
                    $500 - $1000
                </label>
                <label class="radio-label">
                    <input type="radio" name="price" value="1000+">
                    <span class="radio-custom"></span>
                    Más de $1000
                </label>
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-header">
                <h2>Generos</h2>
                <span class="toggle-icon">−</span>
            </div>
            <div class="filter-content">
                <?php foreach ($genres as $genre): ?>
                    <label class="checkbox-label">
                        <input type="checkbox" name="genre" value="<?= $genre["name"] ?>">
                        <span class="checkbox-custom"></span>
                        <?= $genre["name"] ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </aside>

    <!-- Mobile Header and Content -->
    <div class="main-content">
        <header class="mobile-header">
            <h1>Libros</h1>
            <div class="filter-controls">
                <select id="sort-select">
                    <option value="relevate">Relevancia</option>
                    <option value="name">Nombre</option>
                    <option value="price-low">Precio: Menor a Mayor</option>
                    <option value="price-high">Precio: Mayor a Menor</option>
                </select>
                <button id="filter-button">Filtrar Por <i class="fas fa-sliders-h"></i></button>
            </div>
            <a id="add-book-button" class="button" href="<?= BASE_PATH ?>panel/create">Agregar Libro</a>
        </header>
        <main>
            <div class="book-grid" id="book-grid">
                <?php foreach($books as $book): ?>
                    <div class="book-card">
                        <a href="<?= BASE_PATH ?>books/<?= $book["id"] ?>" style="text-decoration: none; color: black;">
                            <div class="book-cover">
                                <img src="<?= BASE_PATH ?>public/img/books/<?= getBookImageFullName($book["id"]) ?>" alt="<?= $book["title"] ?>">
                                <button class="favorite-btn" data-id="<?= $book["id"] ?>">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="book-info">
                                <h2 class="book-title"><?= $book["title"] ?></h2>
                                <p class="book-author"><?= $book["author"] ?></p>
                                <p class="book-publisher"><?= convertDate($book["release_date"]) ?></p>
                                <p class="book-format"><i class="fas fa-book"></i> Pasta dura</p>
                                <p class="book-price">$<?= $book["price"] ?></p>
                            </div>
                        </a>
                        <div class="book-options">
                            <a class="button edit-button" id="edit-button" href="<?= BASE_PATH ?>panel/edit/<?= $book["id"]; ?>">Editar</a>
                            <button onclick="sendToUrl('<?= BASE_PATH ?>app/BooksController.php?action=delete&book_id=<?=$book['id']?>');" class="button delete-button">Eliminar</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</div>

<!-- Mobile Filter Modal -->
<div class="modal" id="filter-modal">
    <div class="modal-content">
        <h2>Filtros <button class="close-modal">&times;</button></h2>
        <div class="filter-section">
            <h3>Precio <i class="fas fa-chevron-down"></i></h3>
            <div class="filter-options">
                <label class="radio-label">
                    <input type="radio" name="price-mobile" value="none" checked>
                    <span class="radio-custom"></span>
                    Todos
                </label>
                <label class="radio-label">
                    <input type="radio" name="price-mobile" value="0 - 100">
                    <span class="radio-custom"></span>
                    Menos de $100
                </label>
                <label class="radio-label">
                    <input type="radio" name="price-mobile" value="100 - 500">
                    <span class="radio-custom"></span>
                    $100 - $500
                </label>
                <label class="radio-label">
                    <input type="radio" name="price-mobile" value="500 - 1000">
                    <span class="radio-custom"></span>
                    $500 - $1000
                </label>
                <label class="radio-label">
                    <input type="radio" name="price-mobile" value="1000+">
                    <span class="radio-custom"></span>
                    Mas de $1000
                </label>
            </div>
        </div>
        <div class="filter-section">
            <h3>Generos <i class="fas fa-chevron-down"></i></h3>
            <div class="filter-options">
                <?php foreach ($genres as $genre): ?>
                    <label class="checkbox-label">
                        <input type="checkbox" name="genre-mobile" value="<?= $genre["name"] ?>">
                        <span class="checkbox-custom"></span>
                        <?= $genre["name"] ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

    <?php include_once "../../partials/footer.php"; ?>
    <script src="<?=BASE_PATH?>public/js/modal.js"></script>
    <?= $success ?? '' ?>
</body>
</html>
