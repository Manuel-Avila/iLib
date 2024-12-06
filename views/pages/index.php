<?php
    include_once "../../app/config.php";
    include_once "../../app/BooksController.php";
    require_once __DIR__ . "/../../app/util/Utils.php";

    $bookController = new BooksController();
    $books = $bookController->getBooks();
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <?php include_once "../partials/head.php"; ?>
    </head>

    <body>
        <?php include_once "../partials/header.php";?>

        <main>
            <section class="hero-slider">
                <button class="slider-arrow prev" aria-label="Imagen anterior">❮</button>
                <button class="slider-arrow next" aria-label="Imagen siguiente">❯</button>
                <div class="slides">
                    <div class="slide">
                        <img src="<?=BASE_PATH?>public/img/poster/poster-1.avif" alt="Promoción de libro 1">
                    </div>
                    <div class="slide">
                        <img src="<?=BASE_PATH?>public/img/poster/poster-2.avif" alt="Promoción de libro 2">
                    </div>
                    <div class="slide">
                        <img src="<?=BASE_PATH?>public/img/poster/poster-3.avif" alt="Promoción de libro 3">
                    </div>
                </div>
            </section>

            <div class="mobile-search-bar">
                <input type="text" placeholder="¿Qué estás buscando?">
                <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <section class="categories">
                <div class="category-item">
                    <i class="fa-solid fa-check fa-3x"></i>
                    <span>Recomendados</span>
                </div>
                <div class="category-item">
                    <i class="fa-solid fa-book fa-3x"></i>
                    <span>Novedades</span>
                </div>
                <div class="category-item">
                    <i class="fa-solid fa-comment-dollar fa-3x"></i>
                    <span>Mas vendidos</span>
                </div>
            </section>

            <section class="book-section">
                <div class="section-header">
                    <h2>Recomendados</h2>
                    <div class="scroll-buttons">
                        <button class="scroll-left" aria-label="Desplazar a la izquierda">←</button>
                        <button class="scroll-right" aria-label="Desplazar a la derecha">→</button>
                    </div>
                </div>
                <div class="book-slider">
                    <?php foreach ($books as $book): ?>
                        <div class="book-card">
                            <a href="<?= BASE_PATH ?>books/<?= $book['id'] ?>" style="text-decoration: none">
                                <img src="<?= BASE_PATH ?>public/img/books/<?= $book["id"] . getImageExtension($book["id"])?>" alt="<?= $book["title"] ?>">
                                <h3><?=$book['title']?></h3>
                                <p class="author"><?=$book['author']?></p>
                                <p class="price">$<?=$book['price']?></p>
                                <button class="add-to-cart" data-id="<?= $book['id'] ?>">Agregar al carrito</button>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="book-section">
                <div class="section-header">
                    <h2>Novedades</h2>
                    <div class="scroll-buttons">
                        <button class="scroll-left" aria-label="Desplazar a la izquierda">←</button>
                        <button class="scroll-right" aria-label="Desplazar a la derecha">→</button>
                    </div>
                </div>
                <div class="book-slider">
                    <?php foreach ($books as $book): ?>
                        <div class="book-card">
                            <a href="<?= BASE_PATH ?>books/<?= $book['id'] ?>" style="text-decoration: none">
                                <img src="<?= BASE_PATH ?>public/img/books/<?= $book["id"] . getImageExtension($book["id"])?>" alt="<?= $book["title"] ?>">
                                <h3><?=$book['title']?></h3>
                                <p class="author"><?=$book['author']?></p>
                                <p class="price">$<?=$book['price']?></p>
                                <button class="add-to-cart" data-id="<?= $book['id'] ?>">Agregar al carrito</button>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="book-section">
                <div class="section-header">
                    <h2>Mas vendidos</h2>
                    <div class="scroll-buttons">
                        <button class="scroll-left" aria-label="Desplazar a la izquierda">←</button>
                        <button class="scroll-right" aria-label="Desplazar a la derecha">→</button>
                    </div>
                </div>
                <div class="book-slider">
                    <?php foreach ($books as $book): ?>
                        <div class="book-card">
                            <a href="<?= BASE_PATH ?>books/<?= $book['id'] ?>" style="text-decoration: none">
                                <img src="<?= BASE_PATH ?>public/img/books/<?= $book["id"] . getImageExtension($book["id"])?>" alt="<?= $book["title"] ?>">
                                <h3><?=$book['title']?></h3>
                                <p class="author"><?=$book['author']?></p>
                                <p class="price">$<?=$book['price']?></p>
                                <button class="add-to-cart" data-id="<?= $book['id'] ?>">Agregar al carrito</button>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>

        <?php include_once "../partials/footer.php"; ?>
        <?php include_once "../partials/scripts.php"; ?>
    </body>
</html>