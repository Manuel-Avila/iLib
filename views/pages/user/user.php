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
        .user-profile {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .user-avatar img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-details h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .user-details p {
            color: #666;
            margin-bottom: 0.25rem;
        }

        .btn, .btn-link {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            text-align: center;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, text-decoration 0.3s;
            text-decoration: none; /* Para los enlaces */
        }

        .btn-primary, .btn-link-primary {
            background-color: #780828;
            color: white;
        }

        .btn-primary:hover, .btn-link-primary:hover {
            background-color: #951237
        }

        .btn-secondary, .btn-link-secondary {
            background-color: #780828;
            color: white;
        }

        .btn-secondary:hover, .btn-link-secondary:hover {
            background-color: #951237;
        }

        .user-purchases {
            margin-bottom: 2rem;
        }

        .user-purchases h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .purchase-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .purchase-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background-color: white;
            border: 1px solid #eee;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .purchase-item img {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .purchase-details {
            flex-grow: 1;
        }

        .purchase-details h3 {
            font-size: 1.2rem;
            margin-bottom: 0.25rem;
        }

        .purchase-details p {
            color: #666;
            margin-bottom: 0.25rem;
        }

        .purchase-price {
            font-weight: bold;
            color: #4169E1;
        }

        #logout-button {
            display: block;
            margin: 2rem auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .user-info {
                flex-direction: column;
                text-align: center;
            }

            .purchase-item {
                flex-direction: column;
                text-align: center;
            }

            .purchase-price {
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
<?php include_once "../../partials/header.php";?>

<main class="user-profile">
    <section class="user-info">
        <div class="user-avatar">
            <img src="<?=BASE_PATH?>public/img/default-avatar.jpg" alt="Foto de perfil">
        </div>
        <div class="user-details">
            <h1><?= $user[0]["name"] ?></h1>
            <p><?= $user[0]["email"] ?></p>
            <p>Rol: <?= $user[0]["role"] ?></p>
        </div>

        <?php if ($user[0]["role"] === "admin") : ?>
            <a href="<?= BASE_PATH ?>panel" id="admin-button" class="btn btn-link-primary">Panel de Administración</a>
        <?php endif; ?>
    </section>

    <section class="user-purchases">
        <h2>Mis Compras</h2>
        <div class="purchase-list">
            <p>No hay compras registradas</p>

            <!-- Esto lo guardo para cuando tengamos la funcionalidad de compras
            <div class="purchase-item">
                <img src="/placeholder.svg?height=80&width=60&text=Libro+1" alt="Portada del libro">
                <div class="purchase-details">
                    <h3>Cien años de soledad</h3>
                    <p>Gabriel García Márquez</p>
                    <p>Fecha de compra: 15/05/2023</p>
                </div>
                <span class="purchase-price">$299.00</span>
            </div>
            -->
        </div>
    </section>

    <a href="<?= BASE_PATH ?>logout" id="logout-button" class="btn btn-link-secondary">Cerrar Sesión</a>
</main>

<?php include_once "../../partials/footer.php";?>
<?php include_once "../../partials/scripts.php";?>
</body>
</html>