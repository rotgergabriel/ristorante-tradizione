const header = document.querySelector('.header');
const images = [
    '/ristorante-tradizione/public/assets/img/cerrar-las-manos-sosteniendo-el-plato-de-comida.webp',
    '/ristorante-tradizione/public/assets/img/chef-profesional-preparando-comida-en-la-cocina.webp',
    '/ristorante-tradizione/public/assets/img/sabrosa-receta-italiana-de-pizza-tradicional-casera.webp'
];

if (header) {
    let index = 0;
    function changeBackground() {
        header.style.backgroundImage = `url('${images[index]}')`;
        index = (index + 1) % images.length;
        const nextImage = new Image();
        nextImage.src = images[index];
    }
    changeBackground();
    setInterval(changeBackground, 5000);
}

const toggleScrollLock = (isLocked) => {
    if (isLocked) {
        const scrollBarWidth = window.innerWidth - document.documentElement.clientWidth;
        document.body.style.paddingRight = `${scrollBarWidth}px`;
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.paddingRight = '0px';
        document.body.style.overflow = '';
    }
};

const menuOverlay = document.querySelector('.header__menu-overlay');
const openButton = document.querySelector('.header__menu-toggle');
const closeButton = document.querySelector('.menu__close');
const linkButtons = document.querySelectorAll('.menu-overlay__item a');
const searchInput = document.querySelector('.menu-overlay__form input[type="search"]');

if (openButton && menuOverlay) {
    openButton.addEventListener('click', (event) => {
        event.preventDefault();
        menuOverlay.style.display = 'flex';
        toggleScrollLock(true);
        if (searchInput) searchInput.focus();
    });
}

const closeMenu = () => {
    if (menuOverlay) {
        menuOverlay.style.display = 'none';
        toggleScrollLock(false);
    }
};

if (closeButton) {
    closeButton.addEventListener('click', (event) => {
        event.preventDefault();
        closeMenu();
    });
}

linkButtons.forEach(link => {
    link.addEventListener('click', () => {
        closeMenu();
    });
});

const openPopupButtons = document.querySelectorAll('.popup-open');

if (openPopupButtons.length > 0) {
    openPopupButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            const article = button.closest('.ricette__content');
            if (!article) return;

            const specificOverlay = article.querySelector('.ricette__overlay');
            if (specificOverlay) {
                specificOverlay.classList.add('visible');
                toggleScrollLock(true);

                const currentCloseButton = specificOverlay.querySelector('.popup__close');

                const closePopup = () => {
                    specificOverlay.classList.remove('visible');
                    toggleScrollLock(false);
                };

                if (currentCloseButton) {
                    currentCloseButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        closePopup();
                    }, { once: true });
                }

                specificOverlay.addEventListener('click', (e) => {
                    if (e.target === specificOverlay) {
                        closePopup();
                    }
                }, { once: true });
            }
        });
    });
}