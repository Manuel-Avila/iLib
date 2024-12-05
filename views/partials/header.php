<header>
    <nav id="sticky-nav">
        <div class="logo">
            <a href="<?=BASE_PATH?>">
                <img src="<?=BASE_PATH?>public/img/logo.png" alt="Logo iLib">
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="<?=BASE_PATH?>books">Libros</a></li>
            <li class="dropdown">
                <a href="#textos">Categorías</a>
                <ul class="dropdown-content">
                    <li><a href="#accion">Acción</a></li>
                    <li><a href="#amor">Amor</a></li>
                </ul>
            </li>
            <li><a href="#ninos">Autores</a></li>
            <li><a href="<?=BASE_PATH?>faqs">Ayuda</a></li>
        </ul>
        <div class="nav-right">
            <div class="search-bar">
                <input type="text" placeholder="¿Qué estás buscando?">
                <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="icons">
                <a href="#favoritos" aria-label="Favoritos"><i class="fa-solid fa-star"></i></a>
                <a href="#carrito" aria-label="Carrito"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="<?=BASE_PATH?>login" aria-label="Mi cuenta"><i class="fa-solid fa-user"></i></a>
            </div>
            <button id="mobile-menu-btn" aria-label="Abrir menú">☰</button>
        </div>
    </nav>
    <div id="mobile-menu" class="mobile-menu">
        <button id="close-menu-btn" aria-label="Cerrar menú">✕</button>
        <ul>
            <li><a href="#libros">Libros</a></li>
            <li class="dropdown">
                <a href="#textos">Categorías</a>
                <ul class="dropdown-content">
                    <li><a href="#accion">Acción</a></li>
                    <li><a href="#amor">Amor</a></li>
                </ul>
            </li>
            <li><a href="#productos">Autores</a></li>
            <li><a href="<?=BASE_PATH?>faqs">Ayuda</a></li>
        </ul>
    </div>
</header>