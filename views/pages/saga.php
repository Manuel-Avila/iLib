<?php
include_once "../../app/config.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once "../partials/head.php"; ?>

    <style>
        body {
            overflow-x: hidden;
        }

        .hero-section {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        #hero-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            object-fit: cover;
            z-index: -1;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 5rem;
            color: #ffd700;
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            margin-bottom: 1rem;
            animation: titleGlow 2s ease-in-out infinite alternate;
        }

        .hero-subtitle {
            font-size: 2rem;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        @keyframes titleGlow {
            from {
                text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            }
            to {
                text-shadow: 0 0 40px rgba(255, 215, 0, 0.8);
            }
        }

        .content {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7));
            padding: 4rem 2rem;
            min-height: 100vh;
        }

        .book-collection {
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            font-size: 2.5rem;
            color: #ffd700;
            text-align: center;
            margin-bottom: 3rem;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            justify-items: center;
        }

        .book {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .book:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.2);
        }

        .book img {
            width: 100%;
            max-width: 200px;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .book:hover img {
            transform: scale(1.05);
        }

        .book h3 {
            margin: 1rem 0;
            color: #fff;
            font-size: 1.2rem;
        }

        .price {
            color: #ffd700;
            font-size: 1.25rem;
            margin: 0.5rem 0;
        }

        .add-to-cart {
            background: #ffd700;
            color: #000;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Cinzel', serif;
            transition: all 0.3s ease;
        }

        .add-to-cart:hover {
            background: #fff;
            transform: scale(1.05);
        }

        .special-offer {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 2rem;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 8px;
            backdrop-filter: blur(5px);
        }

        .offer-box {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .offer-box img {
            width: auto;
            height: 350px;
            border-radius: 8px;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .offer-box:hover img {
            transform: scale(1.05);
        }

        .offer-details {
            color: white;
            flex: 1;
        }

        .offer-details h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        .offer-details p {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 1024px) {
            .book-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.5rem;
            }

            .book-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .offer-box {
                flex-direction: column;
                text-align: center;
            }

            .offer-box img {
                width: 80%;
            }
        }

        @media (max-width: 480px) {
            .book-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include_once "../partials/header.php";?>

    <div class="hero-section">
        <video autoplay loop muted playsinline id="hero-video">
            <source src="<?=BASE_PATH?>public/video/saga.mp4" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>

        <div class="hero-content">
            <h1 class="hero-title">Saga Semanal</h1>
            <p class="hero-subtitle">Harry Potter</p>
        </div>
    </div>

    <main class="content">
        <section class="book-collection">
            <div class="book-grid">
                <div class="book">
                    <img src="/placeholder.svg?height=300&width=200&text=HP1" alt="Harry Potter y la Piedra Filosofal">
                    <h3>La Piedra Filosofal</h3>
                    <p class="price">$299.00</p>
                    <button class="add-to-cart">Agregar al Carrito</button>
                </div>
                <div class="book">
                    <img src="/placeholder.svg?height=300&width=200&text=HP2" alt="Harry Potter y la Cámara Secreta">
                    <h3>La Cámara Secreta</h3>
                    <p class="price">$299.00</p>
                    <button class="add-to-cart">Agregar al Carrito</button>
                </div>
                <div class="book">
                    <img src="/placeholder.svg?height=300&width=200&text=HP3" alt="Harry Potter y el Prisionero de Azkaban">
                    <h3>El Prisionero de Azkaban</h3>
                    <p class="price">$329.00</p>
                    <button class="add-to-cart">Agregar al Carrito</button>
                </div>
                <div class="book">
                    <img src="/placeholder.svg?height=300&width=200&text=HP3" alt="Harry Potter y el Prisionero de Azkaban">
                    <h3>El Prisionero de Azkaban</h3>
                    <p class="price">$329.00</p>
                    <button class="add-to-cart">Agregar al Carrito</button>
                </div>
                <div class="book">
                    <img src="/placeholder.svg?height=300&width=200&text=HP3" alt="Harry Potter y el Prisionero de Azkaban">
                    <h3>El Prisionero de Azkaban</h3>
                    <p class="price">$329.00</p>
                    <button class="add-to-cart">Agregar al Carrito</button>
                </div>
            </div>
        </section>

        <section class="special-offer">
            <h2>Colección Completa</h2>
            <div class="offer-box">
                <img src="<?=BASE_PATH?>public/img/saga_offer.jpg" alt="Colección Completa de Harry Potter">
                <div class="offer-details">
                    <h3>La Saga Completa de Harry Potter</h3>
                    <p>Obtén los 7 libros en una hermosa caja coleccionable</p>
                    <p class="price">$1,999.00</p>
                    <button class="add-to-cart">Agregar al Carrito</button>
                </div>
            </div>
        </section>
    </main>

    <?php include_once "../partials/footer.php"; ?>
    <?php include_once "../partials/scripts.php"; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heroContent = document.querySelector('.hero-content');

            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const val = 1 - (scrolled * 2) / window.innerHeight;
                heroContent.style.opacity = Math.max(0, Math.min(1, val));
            });

            const style = document.createElement('style');
            style.textContent = `
                .fade-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
                }
            `;
            document.head.appendChild(style);

            document.querySelectorAll('.book').forEach(book => {
                book.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 0 30px rgba(255, 215, 0, 0.5)';
                });
                book.addEventListener('mouseleave', function() {
                    this.style.boxShadow = '0 0 20px rgba(255, 215, 0, 0.2)';
                });
            });

            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const blurValue = Math.min(20, scrolled / 50);
                document.querySelector('.content').style.backdropFilter = `blur(${blurValue}px)`;
            });

            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bookTitle = this.parentElement.querySelector('h3').textContent;
                    alert(`"${bookTitle}" ha sido agregado a tu carrito.`);
                });
            });

            const books = document.querySelectorAll('.book');
            books.forEach(book => {
                book.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05) rotate(2deg)';
                });
                book.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) rotate(0deg)';
                });
            });
        });
    </script>

</body>
</html>
