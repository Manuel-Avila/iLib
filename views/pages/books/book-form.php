<?php
    require_once __DIR__ . "/../../../app/config.php";
    require_once __DIR__ . "/../../../app/util/Utils.php";
    require_once __DIR__ . "/../../../app/BooksController.php";
    require_once __DIR__ . "/../../../app/GenreController.php";
    include_once "../../../app/auth.php";

    $title = "Agregar Libro";
    $action_path = BASE_PATH . 'app/BooksController.php';
    $booksController = new BooksController();
    $book = null;
    $genresController = new GenreController();
    $genres = $genresController->getGenres();
    $bookCover = BASE_PATH . 'public/img/book-placeholder.png';
    $idInput = null;

    if (isset($_GET['id'])) {
        $title = "Editar Libro";
        $book_id = $_GET['id'];
        $book = $booksController->getBookById($book_id);
        $releaseDate = explode('T', $book[0]['release_date'])[0];
        $bookCover = BASE_PATH . 'public/img/books/' . $book_id . getImageExtension($book_id);
        $idInput = "<input type='hidden' name='book_id' value='$book_id'>";
    }

    //Mostrar errores en un modal
    if (isset($_SESSION['errors'])) {
        
        $errorMessage = $_SESSION['errors'][0];
        $imgPath = BASE_PATH . 'public/img/warning.png';
        $error = "<script>showMessageModal('Error', '$errorMessage', '$imgPath');</script>";

        unset($_SESSION['errors']);
    }

    function validateBookGenre($book, $genre) {
        if (isset($book)) {
            return in_array($genre, $book[0]['genre']);
        }
        return false;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include_once VIEWS_PATH . "/partials/head.php"; ?>
        <link rel="stylesheet" href="<?=BASE_PATH?>public/css/book-form.css">
        <link rel="stylesheet" href="<?=BASE_PATH?>public/css/custom-checkboxes.css">
    </head>
    <body>
        <?php include_once VIEWS_PATH . "/partials/header.php"; ?>
        <?php include_once VIEWS_PATH . "/partials/message-modal.php"; ?>

        <main>
            <form action="<?=$action_path?>" class="form" method="post" enctype="multipart/form-data">
                <div class="image-field">
                    <label>
                        <img alt="Book Cover" class="book-cover" id="book-cover" src="<?=$bookCover?>">
                        <input accept="image/*" id="image-input" name="image" type="file">
                    </label>
                    <button class="button return-button" id="add-image-button" type="button">Agregar Imagen</button>
                </div>
            
                <div class="form-fields">
                    <h1><?=$title?></h1>
                    <div class="form-group">
                        <label for="title">Titulo</label>
                        <input autocomplete="off" autofocus name="title" id="title" placeholder="Titulo" required type="text" value="<?=htmlspecialchars($book[0]['title'] ?? '')?>">
                    </div>
    
                    <div class="form-group">
                        <label for="author">Autor</label>
                        <input autocomplete="off" name="author" id="author" placeholder="Autor" required type="text" value="<?=htmlspecialchars($book[0]['author'] ?? '')?>">
                    </div>
    
                    <div class="form-group">
                        <label for="editorial">Editorial</label>
                        <input autocomplete="off" name="editorial" id="editorial" placeholder="Editorial" required type="text" value="<?=htmlspecialchars($book[0]['editorial'] ?? '')?>">
                    </div>
    
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input autocomplete="off" name="isbn" id="isbn" placeholder="ISBN" required type="number" value="<?=htmlspecialchars($book[0]['isbn'] ?? '')?>">
                    </div>
    
                    <div class="form-group">
                        <label for="desciption">Descripcion</label>
                        <textarea name="description" id="description" placeholder="Descripcion"><?=htmlspecialchars($book[0]['description'] ?? '')?></textarea>
                    </div>
    
                    <div class="form-group">
                        <label for="pages">Paginas</label>
                        <input autocomplete="off" name="pages" id="pages" placeholder="Paginas" required type="number" value="<?=htmlspecialchars($book[0]['pages'] ?? '')?>">
                    </div>
    
                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input autocomplete="off" name="price" id="price" placeholder="Price" required type="number" value="<?=htmlspecialchars($book[0]['price'] ?? '')?>">
                    </div>
    
                    <div class="form-group">
                        <label for="release_date">Fecha de Lanzamiento</label>
                        <input name="release_date" id="release_date" required type="date" value="<?=$releaseDate ?? ''?>">
                    </div>

                    <?= $idInput ?? ''?>

                    <label id="genres-label">Generos</label>
                    <div class="genres-container">
                        <?php foreach ($genres as $genre): ?>
                            <div class="genre-container">
                                <label class="flex-direction-row checkbox-label">
                                    <input type="checkbox" name="<?=$genre['name']?>" <?=validateBookGenre($book ?? null, $genre['name']) ? "checked" : ""?>>
                                    <span class="checkbox-custom"></span>
                                    <?=$genre['name']?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="form-options">
                        <a class="button return-button" href="<?=BASE_PATH?>panel">Regresar</a>
                        <button class="button accept-button" type="submit">Aceptar</button>
                    </div>
                </div>
            </form>
        </main>

        <?php include_once VIEWS_PATH . "/partials/footer.php"; ?>
        <?php include_once VIEWS_PATH . "/partials/scripts.php"; ?>

        <script src="<?=BASE_PATH?>public/js/book-form.js"></script>
        <script src="<?=BASE_PATH?>public/js/modal.js"></script>
        <?= $error ?? '' ?>
    </body>
</html>