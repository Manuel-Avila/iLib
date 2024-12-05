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
        .cart-page {
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

        .cart-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .cart-item img {
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

        .quantity-controls {
            display: flex;
            align-items: center;
            margin-right: 1rem;
        }

        .quantity-btn {
            background-color: #f4f4f4;
            border: none;
            width: 30px;
            height: 30px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .quantity-btn:hover {
            background-color: #e0e0e0;
        }

        .quantity {
            margin: 0 10px;
            font-size: 1rem;
        }

        .remove-btn {
            background-color: #780828;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-btn:hover {
            background-color: #951237;
        }

        #cart-summary {
            margin-top: 2rem;
            text-align: right;
        }

        #cart-total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #780828;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #780828;
            color: white;
        }

        .btn-primary:hover {
            background-color: #951237;
        }

        .empty-cart {
            text-align: center;
            padding: 2rem;
            color: #666;
        }

        @media (max-width: 600px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .quantity-controls {
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            .remove-btn {
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
<?php include_once "../../partials/header.php";?>

<main class="cart-page">
    <h1>Carrito de Compras</h1>
    <div id="cart-items">
        <!-- Los items del carrito se insertarán aquí dinámicamente -->
    </div>
    <div id="cart-summary">
        <p>Total: <span id="cart-total">$0.00</span></p>
        <button id="checkout-button" class="btn btn-primary">Proceder al Pago</button>
    </div>
</main>

<?php include_once "../../partials/footer.php";?>
<?php include_once "../../partials/scripts.php";?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItemsContainer = document.getElementById('cart-items');
        const cartTotalElement = document.getElementById('cart-total');
        const checkoutButton = document.getElementById('checkout-button');

        async function renderCart() {
            await fetch('https://library-api-0e3t.onrender.com/books')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error: ${response.status}`);
                    }
                    return response.json();
                })
                .then(books => {
                    let cart = [];

                    if (books.length > 0) {
                        cart = books.filter(book => isObjectInList("cartBooks", book.id));
                    }

                    cartItemsContainer.innerHTML = '';
                    if (cart.length === 0) {
                        cartItemsContainer.innerHTML = '<div class="empty-cart">Tu carrito está vacío</div>';
                        checkoutButton.style.display = 'none';
                    } else {
                        cart.forEach(item => {
                            const carts = getList("cartBooks", item.id);
                            const total = cart.reduce((sum, item) => sum + item.price * carts[item.id].quantity, 0);
                            cartTotalElement.textContent = `$${total.toFixed(2)}`;

                            const itemElement = document.createElement('div');
                            itemElement.className = 'cart-item';
                            itemElement.innerHTML = `
                                        <img src="${item.image}" alt="${item.title}">
                                        <div class="item-details">
                                            <h3 class="item-title">${item.title}</h3>
                                            <p class="item-author">${item.author}</p>
                                            <p class="item-price">$${item.price.toFixed(2)}</p>
                                        </div>
                                        <div class="quantity-controls">
                                            <button class="quantity-btn minus" data-id="${item.id}">-</button>
                                            <span class="quantity">${carts[item.id].quantity}</span>
                                            <button class="quantity-btn plus" data-id="${item.id}">+</button>
                                        </div>
                                        <button class="remove-btn" data-id="${item.id}">Eliminar</button>
                                    `;
                            cartItemsContainer.appendChild(itemElement);
                        });
                        checkoutButton.style.display = 'inline-block';
                    }

                })
                .catch(error => {
                    cartItemsContainer.innerHTML = '<div class="empty-cart">Error</div>';
                    checkoutButton.style.display = 'none';
                    cartTotalElement.textContent = `$0.00`;
                });
        }

        function updateQuantity(id, change) {
            const carts = getList("cartBooks", id);
            const item = carts[id];

            let count = item.quantity + change;
            if (count <= 0) {
                removeItem(id);
            } else {
                removeObjectFromList("cartBooks", id);
                addObjectToList("cartBooks", id, { quantity: count });
                renderCart();
            }
        }

        function removeItem(id) {
            removeObjectFromList("cartBooks", id);
            renderCart();
        }

        cartItemsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('quantity-btn')) {
                const id = e.target.dataset.id;
                const change = e.target.classList.contains('plus') ? 1 : -1;
                updateQuantity(id, change);
            } else if (e.target.classList.contains('remove-btn')) {
                const id = e.target.dataset.id;
                removeItem(id);
            }
        });

        checkoutButton.addEventListener('click', function() {
            alert('Procediendo al pago...');

        });

        renderCart();
    });
</script>
</body>
</html>