<?php
    include_once "../../../app/config.php";

    $id = $_GET['id'];

   if (!isset($id)) {
        header('Location: ' . BASE_PATH);
        return;
    }

    include_once "../../../app/BooksController.php";

    $bookController = new BooksController();
    $book = $bookController->getBookById($id);

    if (empty($book)) {
        header('Location:' . BASE_PATH . 'error');
        return;
    }

    $book = $book[0];
    $booksAuthor = $bookController->getBooksByAuthor($book["author"]);
    $booksSimilar = $bookController->getBooksSimilarById($id);
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <?php include_once "../../partials/head.php"; ?>
        <link rel="stylesheet" href="<?= BASE_PATH ?>public/css/book-details.css">
    </head>

    <body>
    <?php include_once "../../partials/header.php";?>
    <?php include_once VIEWS_PATH . "/partials/message-modal.php"; ?>

    <main class="book-details">
        <div class="book-image">
            <img src="<?=BASE_PATH?>public/img/books/<?=$book['id']?>.jpg" alt="Portada del libro" id="bookCover">
        </div>
        <div class="book-info">
            <span class="tag">Novedad</span>
            <h1 id="bookTitle"><?= $book["title"] ?></h1>
            <p class="author" id="bookAuthor"><?= $book["author"] ?></p>
            <p class="editorial">Editorial: <span id="bookEditorial"><?= $book["editorial"] ?></span></p>
            <div class="price-section">
                <h2 class="price" id="bookPrice">$<?= $book["price"] ?></h2>
            </div>
            <div class="formats">
                <button class="format-btn active">Tapa Blanda</button>
                <button class="format-btn">Tapa Dura</button>
                <button class="format-btn">eBook</button>
            </div>
            <div class="quantity">
                <button class="qty-btn" id="decreaseQty">-</button>
                <input type="number" id="quantity" value="1" min="1">
                <button class="qty-btn" id="increaseQty">+</button>
            </div>
            <button id="add-to-cart-bt" class="add-to-cart" data-id="<?= $book["id"] ?>">Agregar a mi bolsa</button>
            <button id="add-to-favorite-bt" data-id="<?= $book["id"] ?>" class="favorite">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                Agregar a Favoritos
            </button>
            <button id="share-bt" class="share" data-id="<?= $book["id"] ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                Compartir
            </button>
        </div>
        <div class="collapsible-sections">
            <div class="collapsible">
                <button class="collapse-btn" onclick="toggleSection('synopsis')">
                    <span class="section-title">SINOPSIS</span>
                    <span class="arrow">↓</span>
                </button>
                <div class="collapse-content" id="synopsis">
                    <p><?= $book["description"] ?></p>
                </div>
            </div>

            <div class="collapsible">
                <button class="collapse-btn" onclick="toggleSection('characteristics')">
                    <span class="section-title">CARACTERÍSTICAS</span>
                    <span class="arrow">↓</span>
                </button>
                <div class="collapse-content" id="characteristics">
                    <div class="characteristics-list">
                        <div class="characteristic-item">
                            <span class="characteristic-icon">📚</span>
                            <span class="characteristic-label">Número de páginas:</span>
                            <span class="characteristic-value"><?= $book["pages"] ?> páginas</span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-icon">📅</span>
                            <span class="characteristic-label">Fecha de publicación:</span>
                            <span class="characteristic-value"><?=convertDate($book["release_date"])?></span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-icon">📖</span>
                            <span class="characteristic-label">ISBN:</span>
                            <span class="characteristic-value"> <?= $book["isbn"] ?> </span>
                        </div>
                        <div class="characteristic-item">
                            <span class="characteristic-icon">🔴</span>
                            <span class="characteristic-label">Generos:</span>
                            <span class="characteristic-value"> <?= join(', ', $book["genre"]) ?> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container-books-section">
        <?php if(!empty($booksAuthor)): ?>
            <section class="book-section">
                <div class="section-header">
                    <h2>Mas libros del autor</h2>
                    <div class="scroll-buttons">
                        <button class="scroll-left" aria-label="Desplazar a la izquierda">←</button>
                        <button class="scroll-right" aria-label="Desplazar a la derecha">→</button>
                    </div>
                </div>
                <div class="book-slider">
                    <?php foreach ($booksAuthor as $book): ?>
                        <?php if ($book['id'] == $id) continue; ?>

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
        <?php endif; ?>

        <?php if(!empty($booksSimilar)): ?>
            <section class="book-section">
                <div class="section-header">
                    <h2>Libros Similares</h2>
                    <div class="scroll-buttons">
                        <button class="scroll-left" aria-label="Desplazar a la izquierda">←</button>
                        <button class="scroll-right" aria-label="Desplazar a la derecha">→</button>
                    </div>
                </div>
                <div class="book-slider">
                    <?php foreach ($booksSimilar as $book): ?>
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
        <?php endif; ?>

    </div>

    <?php include_once "../../partials/footer.php"; ?>
    <?php include_once "../../partials/scripts.php"; ?>
    <script src="<?=BASE_PATH?>public/js/modal.js"></script>

    <script>
        const addToCartButton = document.getElementById('add-to-cart-bt');
        if (addToCartButton) {
            addToCartButton.addEventListener('click', (e) => {
                e.preventDefault();

                const count = document.getElementById('quantity').value;
                const id = addToCartButton.dataset.id;
                addObjectToList('cartBooks', id, { quantity: count });

                showMessageModal('¡Libro agregado!', 'El libro se ha agregado a tu bolsa de compras.', '../public/img/success.png');
            });
        }

        const favoriteButton = document.getElementById('add-to-favorite-bt');
        if (favoriteButton) {
            favoriteButton.addEventListener('click', (e) => {
                e.preventDefault();
                const id = favoriteButton.dataset.id;
                addObjectToList('favoriteBooks', id, {});

                showMessageModal('¡Libro agregado!', 'El libro se ha agregado a tus favoritos.', '../public/img/success.png');
            });
        }

        const shareButton = document.getElementById('share-bt');
        if (shareButton) {
            shareButton.addEventListener('click', (e) => {
                e.preventDefault();
                navigator.share({
                    title: document.title,
                    text: document.title,
                    url: window.location.href
                });
            });
        }
    </script>
    </body>
</html>