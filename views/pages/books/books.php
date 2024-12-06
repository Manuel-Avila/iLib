<?php
    include_once "../../../app/config.php";
    include_once "../../../app/BooksController.php";
    include_once "../../../app/GenreController.php";
    require_once __DIR__ . "/../../../app/util/Utils.php";

    $bookController = new BooksController();
    $books = $bookController->getBooks();
    $genreController = new GenreController();
    $genres = $genreController->getGenres();
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
    <?php include_once VIEWS_PATH . "/partials/confirm-modal.php" ?>
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
        </header>
        <main>
            <div class="book-grid" id="book-grid">
                <!-- Los libros se insertarán aquí dinámicamente -->
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

</body>
</html>
