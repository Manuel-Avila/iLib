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

document.addEventListener('DOMContentLoaded', function() {
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
    }

    // Auto-advance slider every 5 seconds
    setInterval(() => showSlide(currentSlide + 1), 5000);

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

});