function initializeList(listName) {
    if (!localStorage.getItem(listName)) {
        localStorage.setItem(listName, JSON.stringify([]));
    }
}

function addToList(listName, id) {
    initializeList(listName);
    const list = JSON.parse(localStorage.getItem(listName));
    const stringId = String(id);

    if (!list.includes(stringId)) {
        list.push(stringId);
        localStorage.setItem(listName, JSON.stringify(list));
    }
}

function removeFromList(listName, id) {
    initializeList(listName);
    const list = JSON.parse(localStorage.getItem(listName));
    const stringId = String(id);

    const updatedList = list.filter(item => item !== stringId);
    localStorage.setItem(listName, JSON.stringify(updatedList));
}

function getList(listName) {
    initializeList(listName);
    return JSON.parse(localStorage.getItem(listName));
}

function isInList(listName, id) {
    initializeList(listName);
    const list = JSON.parse(localStorage.getItem(listName));
    return list.includes(String(id));
}

function toggleSection(sectionId) {
    const content = document.getElementById(sectionId);
    const button = content.previousElementSibling;
    const allContents = document.querySelectorAll('.collapse-content');
    const allButtons = document.querySelectorAll('.collapse-btn');

    // Close all other sections
    allContents.forEach(item => {
        if (item.id !== sectionId && item.classList.contains('active')) {
            item.classList.remove('active');
            item.previousElementSibling.classList.remove('active');
        }
    });

    // Toggle current section
    content.classList.toggle('active');
    button.classList.toggle('active');
}

function convertDate(dateToConvert) {
    try {
        const date = new Date(dateToConvert);

        if (isNaN(date)) {
            throw new Error('Fecha no válida');
        }

        const months = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];

        const day = date.getDate();
        const month = date.getMonth();
        const year = date.getFullYear();

        return `${day} de ${months[month]} del ${year}`;
    } catch (e) {
        return "Fecha no válida: " + e.message;
    }
}


// BOOKS
function renderBooks(booksToRender) {
    const bookGrid = document.getElementById('book-grid');
    bookGrid.innerHTML = '';

    booksToRender.forEach(book => {
        const bookCard = document.createElement('div');

        bookCard.className = 'book-card';
        bookCard.innerHTML = `
                <div class="book-cover">
                    <img src="public/img/books/${book.id}.jpg" alt="${book.title}">
                    <button class="favorite-btn" data-id="${book.id}">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <a href="books/${book.id}" style="text-decoration: none; color: black;">
                    <div class="book-info">
                        <h2 class="book-title">${book.title}</h2>
                        <p class="book-author">${book.author}</p>
                        <p class="book-publisher">${convertDate(book.release_date)}</p>
                        <p class="book-format"><i class="fas fa-book"></i> Pasta dura</p>
                        <p class="book-price">$${book.price}</p>
                        <button class="add-to-cart">Agregar a mi bolsa</button>
                    </div>
                </a>
        `;
        bookGrid.appendChild(bookCard);

        if (isInList('favoriteBooks', book.id)) {
            bookCard.querySelector('.favorite-btn i').classList.add('fas');
        }
    });
}

function sortBooks(sortBy) {
    applyFilters().then(books => {
        let sortedBooks = [... books];
        switch (sortBy) {
            case 'price-low':
                sortedBooks.sort((a, b) => a.price - b.price);
                break;
            case 'price-high':
                sortedBooks.sort((a, b) => b.price - a.price);
                break;
            case 'name':
                sortedBooks.sort((a, b) => a.title.localeCompare(b.title));
                break;
            default:
                // For 'release-date' or any other option, we'll use the default order
                break;
        }

        renderBooks(sortedBooks);
    });
}

function applyFilters() {
    let selectedPrice, selectedGenres;

    if (window.matchMedia("(max-width: 768px)").matches || (document.querySelector('.filter-mobile') && document.querySelector('.filter-mobile').style.display !== 'none')) {
        selectedPrice = document.querySelector('input[name="price-mobile"]:checked')?.value || 'none';
        selectedGenres = Array.from(document.querySelectorAll('input[name="genre-mobile"]:checked'))
            .map(checkbox => checkbox.value);
    } else {
        selectedPrice = document.querySelector('input[name="price"]:checked')?.value || 'none';
        selectedGenres = Array.from(document.querySelectorAll('input[name="genre"]:checked'))
            .map(checkbox => checkbox.value);
    }

    let minPrice = 0;
    let maxPrice = 9999999;

    if (selectedPrice !== 'none') {
        if (selectedPrice.includes('+')) {
            minPrice = parseInt(selectedPrice.split('+')[0], 10);
        } else {
            const [min, max] = selectedPrice.split(' - ').map(value => parseInt(value, 10));
            minPrice = min;
            maxPrice = max;
        }
    }

    const genreParams = selectedGenres.map(genre => `genre=${encodeURIComponent(genre)}`).join('&');

    const queryParams = [
        `min=${minPrice}`,
        `max=${maxPrice}`,
        genreParams
    ].filter(param => param).join('&');

    const url = `https://library-api-0e3t.onrender.com/books?${queryParams}`;

    return fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error: ${response.status}`);
            }
            return response.json();
        })
        .then(books => {
            return books;
        })
        .catch(error => {
            console.error('Error fetching books:', error);
            return [];
        });
}

document.addEventListener('DOMContentLoaded', function() {
    initializeList('favoriteBooks');
    initializeList('cartBooks');

    // Slider functionality
    const slider = document.querySelector('.slides');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    let currentSlide = 0;

    function showSlide(index) {
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;
        slider.style.transform = `translateX(-${index * 100}%)`;
        currentSlide = index;
    }

    if (slider && slider && prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => showSlide(currentSlide - 1));
        nextBtn.addEventListener('click', () => showSlide(currentSlide + 1));

        // Auto-advance slider every 5 seconds
        setInterval(() => showSlide(currentSlide + 1), 5000);
    }

    // Book slider scroll functionality
    function handleBookSliderScroll(slider, direction) {
        const scrollAmount = slider.offsetWidth;
        if (direction === 'left') {
            slider.scrollBy({left: -scrollAmount, behavior: 'smooth'});
        } else {
            slider.scrollBy({left: scrollAmount, behavior: 'smooth'});
        }
    }

    const bookSections = document.querySelectorAll('.book-section');

    if (bookSections) {
        bookSections.forEach(section => {
            const slider = section.querySelector('.book-slider');
            const leftBtn = section.querySelector('.scroll-left');
            const rightBtn = section.querySelector('.scroll-right');
            leftBtn.addEventListener('click', () => handleBookSliderScroll(slider, 'left'));
            rightBtn.addEventListener('click', () => handleBookSliderScroll(slider, 'right'));
        });
    }

    // Sticky nav functionality
    function handleStickyNav() {
        const nav = document.getElementById('sticky-nav');

        if (!nav) return;

        const sticky = nav.offsetTop;

        if (window.pageYOffset > sticky) {
            nav.classList.add('sticky');
        } else {
            nav.classList.remove('sticky');
        }
    }

    window.addEventListener('scroll', handleStickyNav);

    // Mobile menu functionality
    // Funcionalidad del menú móvil
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    function openMobileMenu() {
        mobileMenu.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Previene el scroll del body
    }

    function closeMobileMenu() {
        mobileMenu.style.display = 'none';
        document.body.style.overflow = ''; // Restaura el scroll del body
    }

    if (mobileMenuBtn && closeMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', openMobileMenu);
        closeMenuBtn.addEventListener('click', closeMobileMenu);

        // Cerrar el menú al hacer clic fuera de él
        mobileMenu.addEventListener('click', function(event) {
            if (event.target === mobileMenu) {
                closeMobileMenu();
            }
        });

        // Prevenir que los clics dentro del menú lo cierren
        mobileMenu.querySelector('ul').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }

    const scrollButton = document.getElementById('scroll-top');

    function toggleScrollButton() {
        if (window.pageYOffset > 300) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    }

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    if (scrollButton) {
        window.addEventListener('scroll', toggleScrollButton);
        scrollButton.addEventListener('click', scrollToTop);
    }

    // Actualizar la funcionalidad del slider de libros
    const bookSliders = document.querySelectorAll('.book-slider');

    if (bookSliders) {
        bookSliders.forEach(slider => {
            const cards = slider.querySelectorAll('.book-card');

            cards.forEach(card => {
                // Agregar funcionalidad de vista previa
                const previewButton = card.querySelector('.preview-button');
                if (previewButton) {
                    previewButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        // Implementar la funcionalidad de vista previa aquí
                    });
                }

                // Agregar funcionalidad de favoritos
                const favoriteButton = card.querySelector('.favorite-button');
                if (favoriteButton) {
                    favoriteButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        favoriteButton.classList.toggle('active');

                        if (favoriteButton.classList.contains('active')) {
                            addToList('favoriteBooks', card.dataset.id);
                        } else {
                            removeFromList('favoriteBooks', card.dataset.id);
                        }
                    });
                }
            });
        });
    }

    // Book details sections functionality
    const firstSection = document.querySelector('.collapse-content');
    const firstButton = document.querySelector('.collapse-btn');
    if (firstSection && firstButton) {
        firstSection.classList.add('active');
        firstButton.classList.add('active');
    }

    // Quantity buttons functionality
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        quantityInput.readOnly = true;
        document.getElementById('decreaseQty').addEventListener('click', () => {
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });
        document.getElementById('increaseQty').addEventListener('click', () => {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });
    }

    // Format buttons functionality
    const formatButtons = document.querySelectorAll('.format-btn');
    if (formatButtons) {
        formatButtons.forEach(button => {
            button.addEventListener('click', () => {
                formatButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            });
        });
    }

    // Books

    if (document.getElementById('book-grid')) {
        applyFilters().then(
            books => {
                renderBooks(books);

                const sortSelect = document.getElementById('sort-select');
                if (sortSelect) {
                    sortSelect.selectedIndex = 0;
                }
            }
        ).catch(
            error => console.error('Error applying filters:', error)
        );
    }

    const sortSelect = document.getElementById('sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', (e) => {
            sortBooks(e.target.value);
        });
    }

    const bookGrid = document.getElementById('book-grid');
    if (bookGrid) {
        bookGrid.addEventListener('click', (e) => {
            if (e.target.classList.contains('favorite-btn') || e.target.closest('.favorite-btn')) {
                const btn = e.target.closest('.favorite-btn');
                const icon = btn.querySelector('i');
                icon.classList.toggle('fas');
                icon.classList.toggle('far');

                if (icon.classList.contains('fas')) {
                    addToList('favoriteBooks', btn.dataset.id);
                } else {
                    removeFromList('favoriteBooks', btn.dataset.id);
                }
            }
        });
    }

    const filterButton = document.getElementById('filter-button');
    const filterModal = document.getElementById('filter-modal');
    const closeModal = document.querySelector('.close-modal');

    if (filterButton && filterModal && closeModal) {
        filterButton.addEventListener('click', () => {
            filterModal.style.display = 'block';
        });

        closeModal.addEventListener('click', () => {
            filterModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === filterModal) {
                filterModal.style.display = 'none';
            }
        });
    }

    // Desktop sidebar section toggles
    const filterHeaders = document.querySelectorAll('.filter-header');
    if (filterHeaders) {
        filterHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                const toggleIcon = header.querySelector('.toggle-icon');

                if (content.style.display === 'none') {
                    content.style.display = 'flex';
                    toggleIcon.textContent = '−';
                } else {
                    content.style.display = 'none';
                    toggleIcon.textContent = '+';
                }
            });
        });
    }

    // Mobile modal section toggles
    const modalFilterSections = document.querySelectorAll('.modal .filter-section h3');
    if (modalFilterSections) {
        modalFilterSections.forEach(section => {
            section.addEventListener('click', () => {
                const filterSection = section.closest('.filter-section');
                filterSection.classList.toggle('active');
                const icon = section.querySelector('i');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        });
    }

    // Filter functionality
    const filterInputs = document.querySelectorAll('input[type="radio"], input[type="checkbox"]');
    if (filterInputs) {
        filterInputs.forEach(input => {
            input.addEventListener('change', () => {
                applyFilters().then(
                    books => {
                        renderBooks(books);

                        const sortSelect = document.getElementById('sort-select');
                        if (sortSelect) {
                            sortSelect.selectedIndex = 0;
                        }
                    }
                ).catch(
                    error => console.error('Error applying filters:', error)
                );
            });
        });
    }
});