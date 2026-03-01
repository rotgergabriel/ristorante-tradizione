/**
 * CONTROLADOR DE TRANSICIONES Y UI
 */

// 1. Controlador del carrusel (Solo para el Index)
const header = document.querySelector('.header');

// Usamos rutas absolutas para las imágenes para que no fallen en subcarpetas
const images = [
    '/forte_chance/pizzeria/public/assets/img/cerrar-las-manos-sosteniendo-el-plato-de-comida.webp',
    '/forte_chance/pizzeria/public/assets/img/chef-profesional-preparando-comida-en-la-cocina.webp',
    '/forte_chance/pizzeria/public/assets/img/sabrosa-receta-italiana-de-pizza-tradicional-casera.webp'
];

if (header) {
    let index = 0;
    function changeBackground() {
        header.style.backgroundImage = `url('${images[index]}'), linear-gradient(grey, grey)`;
        index = (index + 1) % images.length;
    }
    changeBackground();
    setInterval(changeBackground, 5000);
}

// 2. Controlador del Menú Overlay (Navbar)
const menuOverlay = document.querySelector('.header__menu-overlay');
const openButton = document.querySelector('.header__menu-toggle');
const closeButton = document.querySelector('.menu__close');
const linkButtons = document.querySelectorAll('.menu-overlay__item');
const searchInput = document.querySelector('.menu-overlay__form input[type="search"]');

// Solo registramos los eventos si los botones existen en el DOM
if (openButton && menuOverlay) {
    openButton.addEventListener('click', (event) => {
        event.preventDefault();
        menuOverlay.style.display = 'flex';
        if (searchInput) searchInput.focus();
    });
}

if (closeButton && menuOverlay) {
    closeButton.addEventListener('click', (event) => {
        event.preventDefault();
        menuOverlay.style.display = 'none';
    });
}

linkButtons.forEach(link => {
    link.addEventListener('click', () => {
        if (menuOverlay) menuOverlay.style.display = 'none';
    });
});

// 3. Controlador de Popups de Recetas (Ricette Overlay)
const openPopupButtons = document.querySelectorAll('.popup-open');

if (openPopupButtons.length > 0) {
    openPopupButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            // Identificar el contenedor y el overlay específico
            const article = button.closest('.ricette__content');
            if (!article) return;

            const specificOverlay = article.querySelector('.ricette__overlay');
            if (specificOverlay) {
                // Abrir el overlay específico
                specificOverlay.classList.add('visible');
                document.body.style.overflow = 'hidden';

                // Obtener el botón de cierre específico
                const currentCloseButton = specificOverlay.querySelector('.popup__close');

                if (currentCloseButton) {
                    currentCloseButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        specificOverlay.classList.remove('visible');
                        document.body.style.overflow = 'auto';
                    }, { once: true });
                }

                // Cierre al hacer click en el fondo (fuera del contenido)
                specificOverlay.addEventListener('click', (e) => {
                    if (e.target === specificOverlay) {
                        specificOverlay.classList.remove('visible');
                        document.body.style.overflow = 'auto';
                    }
                }, { once: true });
            }
        });
    });
}