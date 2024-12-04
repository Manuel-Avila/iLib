<?php
    include_once "../../../app/config.php";
    include_once "../../../app/BooksController.php";

    $bookController = new BooksController();
    $books = $bookController->getBooks();
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

<div class="container">
    <!-- Desktop Sidebar -->
    <aside class="desktop-sidebar">
        <h1>Libros</h1>

        <div class="filter-section">
            <div class="filter-header">
                <h2>Tipo</h2>
                <span class="toggle-icon">−</span>
            </div>
            <div class="filter-content">
                <label class="radio-label">
                    <input type="radio" name="type" value="libros" checked>
                    <span class="radio-custom"></span>
                    Libros
                </label>
                <label class="radio-label">
                    <input type="radio" name="type" value="libros-ninos">
                    <span class="radio-custom"></span>
                    Libros para niños
                </label>
                <label class="radio-label">
                    <input type="radio" name="type" value="impresion">
                    <span class="radio-custom"></span>
                    Impresión Bajo Demanda
                </label>
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-header">
                <h2>Temas</h2>
                <span class="toggle-icon">−</span>
            </div>
            <div class="filter-content">
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="animales">
                    <span class="checkbox-custom"></span>
                    Animales y mascotas
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="artes">
                    <span class="checkbox-custom"></span>
                    Bellas artes y artes decorativas
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="ciencias-naturales">
                    <span class="checkbox-custom"></span>
                    Ciencias naturales
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="ciencias-sociales">
                    <span class="checkbox-custom"></span>
                    Ciencias sociales
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="contabilidad">
                    <span class="checkbox-custom"></span>
                    Contabilidad
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="deportes">
                    <span class="checkbox-custom"></span>
                    Deportes y actividades
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="derecho">
                    <span class="checkbox-custom"></span>
                    Derecho
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="educacion">
                    <span class="checkbox-custom"></span>
                    Educación y pedagogía
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="esoterismo">
                    <span class="checkbox-custom"></span>
                    Esoterismo
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="filosofia">
                    <span class="checkbox-custom"></span>
                    Filosofía
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic" value="gastronomia">
                    <span class="checkbox-custom"></span>
                    Gastronomía
                </label>
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-header">
                <h2>Autores</h2>
                <span class="toggle-icon">−</span>
            </div>
            <div class="filter-content">
                <label class="checkbox-label">
                    <input type="checkbox" name="author" value="jacques-philippe">
                    <span class="checkbox-custom"></span>
                    Jacques Philippe
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="author" value="anibal-arias">
                    <span class="checkbox-custom"></span>
                    Aníbal Arias
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="author" value="rosa-maria-barbosa">
                    <span class="checkbox-custom"></span>
                    Rosa María Barbosa
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="author" value="rebecca-yarros">
                    <span class="checkbox-custom"></span>
                    Rebecca Yarros
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="author" value="noe-garrido-cobo">
                    <span class="checkbox-custom"></span>
                    Noé Garrido Cobo
                </label>
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-header">
                <h2>Editoriales</h2>
                <span class="toggle-icon">−</span>
            </div>
            <div class="filter-content">
                <label class="checkbox-label">
                    <input type="checkbox" name="publisher" value="lucerna">
                    <span class="checkbox-custom"></span>
                    Lucerna
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="publisher" value="melos">
                    <span class="checkbox-custom"></span>
                    Melos
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="publisher" value="planeta">
                    <span class="checkbox-custom"></span>
                    Planeta
                </label>
            </div>
        </div>
    </aside>

    <!-- Mobile Header and Content -->
    <div class="main-content">
        <header class="mobile-header">
            <h1>Libros</h1>
            <div class="filter-controls">
                <select id="sort-select">
                    <option value="release-date">Fecha De Release</option>
                    <option value="price-low">Precio: Menor a Mayor</option>
                    <option value="price-high">Precio: Mayor a Menor</option>
                    <option value="name">Nombre</option>
                </select>
                <button id="filter-button">Filtrar Por <i class="fas fa-sliders-h"></i></button>
            </div>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
                <a id="add-book-button" class="button" href="<?= BASE_PATH ?>views/pages/books/book-form.php">Agregar Libro</a>
            <?php endif; ?>
        </header>
        <main>
            <div class="book-grid" id="book-grid">
                <?php foreach($books as $book): ?>
                    <div class="book-card">
                        <a href="<?= BASE_PATH ?>books/<?= $book["id"] ?>" style="text-decoration: none; color: black;">
                            <div class="book-cover">
                                <img src="<?= BASE_PATH ?>public/img/books/<?= $book["id"] ?>.jpg" alt="<?= $book["title"] ?>">
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
                            <?php /*Delete*/$_SESSION['user_role'] = 'admin'; /*Delete*/ if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
                                <a class="button edit-button" href="<?= BASE_PATH ?>views/pages/books/book-form.php?book_id=<?= $book["id"]; ?>">Editar</a>
                                <a class="button delete-button">Eliminar</a>
                            <?php else: ?>
                                <button class="add-to-cart">Agregar a mi bolsa</button>
                            <?php endif; ?>
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
            <h3>Tipo <i class="fas fa-chevron-down"></i></h3>
            <div class="filter-options">
                <label class="radio-label">
                    <input type="radio" name="type-mobile" value="libros" checked>
                    <span class="radio-custom"></span>
                    Libros
                </label>
                <label class="radio-label">
                    <input type="radio" name="type-mobile" value="libros-ninos">
                    <span class="radio-custom"></span>
                    Libros para niños
                </label>
                <label class="radio-label">
                    <input type="radio" name="type-mobile" value="impresion">
                    <span class="radio-custom"></span>
                    Impresión Bajo Demanda
                </label>
            </div>
        </div>
        <div class="filter-section">
            <h3>Temas <i class="fas fa-chevron-down"></i></h3>
            <div class="filter-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="topic-mobile" value="animales">
                    <span class="checkbox-custom"></span>
                    Animales y mascotas
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic-mobile" value="artes">
                    <span class="checkbox-custom"></span>
                    Bellas artes y artes decorativas
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic-mobile" value="ciencias-naturales">
                    <span class="checkbox-custom"></span>
                    Ciencias naturales
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic-mobile" value="ciencias-sociales">
                    <span class="checkbox-custom"></span>
                    Ciencias sociales
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="topic-mobile" value="contabilidad">
                    <span class="checkbox-custom"></span>
                    Contabilidad
                </label>
            </div>
        </div>
        <div class="filter-section">
            <h3>Autores <i class="fas fa-chevron-down"></i></h3>
            <div class="filter-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="author-mobile" value="jacques-philippe">
                    <span class="checkbox-custom"></span>
                    Jacques Philippe
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="author-mobile" value="anibal-arias">
                    <span class="checkbox-custom"></span>
                    Aníbal Arias
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="author-mobile" value="rosa-maria-barbosa">
                    <span class="checkbox-custom"></span>
                    Rosa María Barbosa
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="author-mobile" value="rebecca-yarros">
                    <span class="checkbox-custom"></span>
                    Rebecca Yarros
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="author-mobile" value="noe-garrido-cobo">
                    <span class="checkbox-custom"></span>
                    Noé Garrido Cobo
                </label>
            </div>
        </div>
        <div class="filter-section">
            <h3>Editoriales <i class="fas fa-chevron-down"></i></h3>
            <div class="filter-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="publisher-mobile" value="lucerna">
                    <span class="checkbox-custom"></span>
                    Lucerna
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="publisher-mobile" value="melos">
                    <span class="checkbox-custom"></span>
                    Melos
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="publisher-mobile" value="planeta">
                    <span class="checkbox-custom"></span>
                    Planeta
                </label>
            </div>
        </div>
    </div>
</div>

    <?php include_once "../../partials/footer.php"; ?>
    <?php include_once "../../partials/scripts.php"; ?>
</body>
</html>
