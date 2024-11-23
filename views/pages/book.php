<?php
include "../../app/config.php";
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <?php include "../partials/head.php"; ?>
        <link rel="stylesheet" href="<?= BASE_PATH ?>public/css/book.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>
    <?php include "../partials/header.php";?>

    <main>
        <section id="bookOptions">
            <img alt="Imagen del libro" class="bookPortrait bookShadow hoverScale" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1524596540i/36124936.jpg">

            <div class="bookType">
                <select class="form-select redOutlined" style="margin: 0;">
                    <option value="1" selected>Pasta Blanda</option>
                    <option value="2">Pasta Dura</option>
                    <option value="3">Digital</option>
                </select>
            </div>

            <button class="button bookOptionB">Comprar</button>
            <button class="outlineButton bookOptionB" id="wishList">Agregar a lista de deseos</button>
        </section>

        <section id="bookInfo">
            <p class="bestSeller">Best Seller #246</p>
            <h2>The Outsider</h2>
            <h5 class="author">Stephen King</h5>
            <div class="rating">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star unchecked"></span>
                <h5>4.56</h5>
                <p>329,282 ratings</p>
            </div>
            <p>
                An unspeakable crime. A confounding investigation. At a time when the King brand has never been stronger, he has delivered one of his most unsettling and compulsively readable stories.
            </p>
            <p>
                An eleven-year-old boy’s violated corpse is found in a town park. Eyewitnesses and fingerprints point unmistakably to one of Flint City’s most popular citizens. He is Terry Maitland, Little League coach, English teacher, husband, and father of two girls. Detective Ralph Anderson, whose son Maitland once coached, orders a quick and very public arrest. Maitland has an alibi, but Anderson and the district attorney soon add DNA evidence to go with the fingerprints and witnesses. Their case seems ironclad.
            </p>
            <p>
                As the investigation expands and horrifying answers begin to emerge, King’s propulsive story kicks into high gear, generating strong tension and almost unbearable suspense. Terry Maitland seems like a nice guy, but is he wearing another face? When the answer comes, it will shock you as only Stephen King can.
            </p>
            <h6>Generos:</h6>
            <p>
                <a href="#">Horror</a>,
                <a href="#">Miedo</a>,
                <a href="#">Suspenso</a>,
                <a href="#">Ficcion</a>
                <a href="#">...more</a>
            </p>
        </section>
    </main>

    <section class="recommendations bookContainer">
        <h2>Quizás también te interese:</h2>
        <div class="flexWrap marginTop rowGap">
            <a class="book" href="#">
                <img alt="Recommended Book" class="bookShadow" src="https://m.media-amazon.com/images/I/612y1xDU+lL._AC_UF1000,1000_QL80_.jpg">
                <h5>The Exorcist</h5>
                <p>William Peter Blatty</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.08</h6>
                </div>
            </a>

            <a class="book" href="#">
                <img alt="Recommended Book" class="bookShadow" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1707490075i/204316865.jpg">
                <h5>The Hitchcock Hotel</h5>
                <p>Stephanie Wrobel</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.61</h6>
                </div>
            </a>

            <a class="book" href="#">
                <img alt="Recommended Book" class="bookShadow" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1711386577i/208155307.jpg">
                <h5>Midnight</h5>
                <p>Margot Harrison</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.54</h6>
                </div>
            </a>

            <a class="book" href="#">
                <img alt="Recommended Book" class="bookShadow" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1713284232i/209419483.jpg">
                <h5>Where They Last Saw Her</h5>
                <p>Marcie R. Rendon</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>3.63</h6>
                </div>
            </a>

            <a class="book" href="#">
                <img alt="Recommended Book" class="bookShadow" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1711205083i/208503280.jpg">
                <h5>The Boyfriend</h5>
                <p>Freida McFadden</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.89</h6>
                </div>
            </a>

            <a class="book" href="#">
                <img alt="Recommended Book" class="bookShadow" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1657781256i/61439040.jpg">
                <h5>1984</h5>
                <p>George Orwell</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.29</h6>
                </div>
            </a>
        </div>
    </section>

    <?php include "../partials/footer.php"; ?>
    </body>
</html>