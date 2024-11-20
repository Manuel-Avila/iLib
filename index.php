<?php
    
    $extraResources = '';

    $content = '
        <div id="startView">
            <h1 id="iLib" class="white">iLIb</h1>
            <p id="slogan" class="textFont white">Una experiencia de lectura sin igual !!!</p>
            <button id="createAccountB" class="button">Crear Cuenta</button>
        </div>

        <h2 id="bestBooksH" class="heading fullWidth">Los mejores libros</h2>
        <div class="flexWrap marginTop rowGap bookContainer">
            <a class="book" href="book.php">
                <img alt="Imagen del libro: The Outsider" class="bookShadow" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1524596540i/36124936.jpg">
                <h5>The Outsider</h5>
                <p>Stephen King</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.98</h6>
                </div>
            </a>

            <a class="book" href="book.php">
                <img alt="Imagen del libro: El código Da Vinci" class="bookShadow" src="https://imagessl8.casadellibro.com/a/l/s7/28/9788408175728.webp">
                <h5>El código Da Vinci</h5>
                <p>Dan Brown</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.81</h6>
                </div>
            </a>

            <a class="book" href="book.php">
                <img alt="Imagen del libro: El Alquimista" class="bookShadow" src="https://images.cdn3.buscalibre.com/fit-in/360x360/04/1f/041faab83743751d96b0b362733f33f4.jpg">
                <h5>El Alquimista</h5>
                <p>Paulo Coelho</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.79</h6>
                </div>
            </a>

            <a class="book" href="book.php">
                <img alt="Imagen del libro: The Last Star" class="bookShadow" src="https://m.media-amazon.com/images/I/91XNAr6qfoL._AC_UF894,1000_QL80_.jpg">
                <h5>The Last Star</h5>
                <p>Rick Yancey</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.92</h6>
                </div>
            </a>

            <a class="book" href="book.php">
                <img alt="Imagen del libro: The Inmate" class="bookShadow" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1653271523i/61149872.jpg">
                <h5>The Inmate</h5>
                <p>Freida McFadden</p>
                <div>
                    <span class="fa fa-star checked"></span>
                    <h6>4.77</h6>
                </div>
            </a>
        </div>

        <h2 id="genresH" class="heading">Todos los géneros que puedes imaginar</h2>
        <div id="genres"> 
            <div class="genreBox">
                <img alt="Imagen del genero: Ciencia Ficción" class="genreImage bookShadow" src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1555447414i/44767458.jpg">
                <div class="genreTitleDiv">
                    <h3 class="genreTitle">Ciencia Ficcion</h3>
                </div>
            </div>

            <div class="genreBox">
                <img alt="Imagen del genero: Fantasía" class="genreImage bookShadow" src="https://m.media-amazon.com/images/I/91VsRHjTY-L._AC_UF1000,1000_QL80_.jpg">
                <div class="genreTitleDiv">
                    <h3 class="genreTitle">Fantasia</h3>
                </div>
            </div>

            <div class="genreBox">
                <img alt="Imagen del genero: Drama" class="genreImage bookShadow" src="https://www.clarin.com/2022/01/01/zj1ORlUpq_720x0__1.jpg">
                <div class="genreTitleDiv">
                    <h3 class="genreTitle">Drama</h3>
                </div>
            </div>

            <div class="genreBox">
                <img alt="Imagen del genero: Terror" class="genreImage bookShadow" src="https://media.vogue.es/photos/5cc7566515d9a36371e83c62/master/w_1600%2Cc_limit/living__469389592.jpg">
                <div class="genreTitleDiv">
                    <h3 class="genreTitle">Terror</h3>
                </div>
            </div>

            <div class="genreBox">
                <img alt="Imagen del genero: Arte" class="genreImage bookShadow" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwhnYchqY6Pz3WtGDkSPaPX7S9-FrPXDgK8w&s">
                <div class="genreTitleDiv">
                    <h3 class="genreTitle">Arte</h3>
                </div>
            </div>

            <div class="genreBox">
                <img alt="Imagen del genero: Viajes" class="genreImage bookShadow" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4CFMOFfaFbc7wd6Kb5ZM8aPoeM_RC8jOgbA&s">
                <div class="genreTitleDiv">
                    <h3 class="genreTitle">Viajes</h3>
                </div>
            </div>

        </div>
    ';

    include "layouts/layout.php";
?>