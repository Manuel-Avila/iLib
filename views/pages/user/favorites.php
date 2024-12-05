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

<main class="favorites-page">
    <h1>Mis Favoritos</h1>
    <div id="favorites-items">
        <!-- Los items favoritos se insertarán aquí dinámicamente -->
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const favoritesContainer = document.getElementById('favorites-items');

        let favorites = [
            { id: 1, title: "Cien años de soledad", author: "Gabriel García Márquez", price: 299, image: "/placeholder.svg?height=120&width=80&text=Libro+1" },
            { id: 2, title: "1984", author: "George Orwell", price: 249, image: "/placeholder.svg?height=120&width=80&text=Libro+2" },
            { id: 3, title: "El principito", author: "Antoine de Saint-Exupéry", price: 199, image: "/placeholder.svg?height=120&width=80&text=Libro+3" }
        ];

        function renderFavorites() {
            favoritesContainer.innerHTML = '';
            if (favorites.length === 0) {
                favoritesContainer.innerHTML = '<div class="empty-favorites">No tienes libros favoritos</div>';
            } else {
                favorites.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'favorite-item';
                    itemElement.innerHTML = `
                    <img src="${item.image}" alt="${item.title}">
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
        }

        function removeItem(id) {
            favorites = favorites.filter(item => item.id !== id);
            renderFavorites();
        }

        function addToCart(id) {
            const item = favorites.find(item => item.id === id);
            if (item) {
                alert(`"${item.title}" ha sido agregado al carrito.`);
                // Aquí iría la lógica para agregar el item al carrito
            }
        }

        favoritesContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const id = parseInt(e.target.dataset.id);
                removeItem(id);
            } else if (e.target.classList.contains('add-to-cart-btn')) {
                const id = parseInt(e.target.dataset.id);
                addToCart(id);
            }
        });

        renderFavorites();
    });
</script>

<?php include_once "../../partials/footer.php";?>
<?php include_once "../../partials/scripts.php";?>
</body>
</html>