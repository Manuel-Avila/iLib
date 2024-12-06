<?php
    global $user;
    include_once "../../../app/config.php";
    include_once "../../../app/auth.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once "../../partials/head.php"; ?>

    <style>
        .favorites-page {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #780828;
        }

        .favorite-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .favorite-item img {
            width: 80px;
            height: 120px;
            object-fit: cover;
            margin-right: 1rem;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .item-author {
            color: #666;
            margin-bottom: 0.5rem;
        }

        .item-price {
            font-weight: bold;
            color: #780828;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #780828;
            color: white;
        }

        .btn-primary:hover {
            background-color: #951237;
        }

        .btn-secondary {
            background-color: #780828;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #951237;
        }

        .remove-btn {
            background-color: #780828;
            color: white;
        }

        .remove-btn:hover {
            background-color: #951237;
        }

        .empty-favorites {
            text-align: center;
            padding: 2rem;
            color: #666;
        }

        @media (max-width: 600px) {
            .favorite-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-buttons {
                margin-top: 1rem;
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
<?php include_once "../../partials/header.php";?>
<?php include_once VIEWS_PATH . "/partials/message-modal.php"; ?>

<main class="favorites-page">
    <h1>Mis Favoritos</h1>
    <div id="favorites-items">
        <!-- Los items favoritos se insertarán aquí dinámicamente -->
    </div>
</main>

<?php include_once "../../partials/footer.php";?>
<?php include_once "../../partials/scripts.php";?>
<script src="<?=BASE_PATH?>public/js/modal.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const favoritesContainer = document.getElementById('favorites-items');

        async function renderFavorites() {
            await fetch('https://library-api-0e3t.onrender.com/books')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error: ${response.status}`);
                    }
                    return response.json();
                })
                .then(books => {
                    let favorites = [];

                    if (books.length > 0) {
                        favorites = books.filter(book => isObjectInList("favoriteBooks", book.id));
                    }

                    favoritesContainer.innerHTML = '';
                    if (favorites.length === 0) {
                        favoritesContainer.innerHTML = '<div class="empty-favorites">No tienes libros favoritos</div>';
                    } else {
                        favorites.forEach(item => {
                            const itemElement = document.createElement('div');
                            itemElement.className = 'favorite-item';
                            itemElement.innerHTML = `
                    <img src="public/img/books/${item.id}.jpg" alt="${item.title}">
                    <div class="item-details">
                        <h3 class="item-title">${item.title}</h3>
                        <p class="item-author">${item.author}</p>
                        <p class="item-price">$${item.price.toFixed(2)}</p>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-primary add-to-cart-btn" data-id="${item.id}">Agregar al Carrito</button>
                        <button class="btn remove-btn" data-id="${item.id}">Eliminar</button>
                    </div>
                `;
                            favoritesContainer.appendChild(itemElement);
                        });
                    }
                })
                .catch(error => {
                    favoritesContainer.innerHTML = '';
                    favoritesContainer.innerHTML = '<div class="empty-favorites">Error</div>';
                });
        }

        function removeItem(id) {
            removeObjectFromList("favoriteBooks", id);
            renderFavorites();
        }

        function addToCart(id) {
            let count = 1;

            if (isObjectInList("cartBooks", id)) {
                const item = getList("cartBooks", id);
                count = item[id].quantity + 1;
            }

            removeObjectFromList("cartBooks", id);
            addObjectToList("cartBooks", id, { quantity: count });
        }

        favoritesContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const id = e.target.dataset.id;
                removeItem(id);

                showMessageModal('Libro eliminado', 'El libro se ha eliminado de tus favoritos', 'public/img/logo.png');
            } else if (e.target.classList.contains('add-to-cart-btn')) {
                const id = e.target.dataset.id;
                addToCart(id);

                showMessageModal('Libro agregado al carrito', 'El libro se ha agregado al carrito de compras', 'public/img/logo.png');
            }
        });

        renderFavorites();
    });
</script>
</body>
</html>