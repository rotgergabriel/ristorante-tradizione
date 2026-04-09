const header = document.querySelector('.header');
const images = [
    '/ristorante-tradizione/public/assets/img/hero_margherita.webp',
    '/ristorante-tradizione/public/assets/img/hero_focaccia.webp',
    '/ristorante-tradizione/public/assets/img/hero_quattro_formaggi.webp'
];

if (header) {
    let index = 0;
    function changeBackground() {
        header.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.60)),url('${images[index]}')`;
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

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('maintenance-toggle');
    const statusText = document.getElementById('status-text');

    if (!toggle || !statusText) return;

    const updateLabel = (isOn) => {
        statusText.textContent = isOn ? "OFFLINE" : "ONLINE";
        statusText.style.color = isOn ? "#e74c3c" : "#2ecc71";
    };

    updateLabel(toggle.checked);

    toggle.addEventListener('change', () => {
        const isChecked = toggle.checked ? 1 : 0;

        fetch('/ristorante-tradizione/api/update-maintenance', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `status=${isChecked}`
        })
            .then(response => {
                if (!response.ok) throw new Error('Error en la ruta del servidor');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateLabel(toggle.checked);
                } else {
                    throw new Error(data.error);
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                alert("Errore: " + error.message);
                toggle.checked = !toggle.checked;
                updateLabel(toggle.checked);
            });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const popupToggle = document.getElementById('popup-toggle');
    const popupStatusText = document.getElementById('popup-status-text');

    if (!popupToggle || !popupStatusText) return;

    const updatePopupLabel = (isActive) => {
        popupStatusText.textContent = isActive ? "OFFLINE" : "ONLINE";
        popupStatusText.style.color = isActive ? "#e74c3c" : "#2ecc71";
    };

    updatePopupLabel(popupToggle.checked);

    popupToggle.addEventListener('change', () => {
        const isChecked = popupToggle.checked ? 1 : 0;

        fetch('/ristorante-tradizione/api/update-popup-status', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `status=${isChecked}`
        })
            .then(response => {
                if (!response.ok) throw new Error('Errore di rete');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updatePopupLabel(popupToggle.checked);
                } else {
                    throw new Error(data.error);
                }
            })
            .catch(error => {
                console.error('Popup Toggle Error:', error);
                alert("Errore Popup: " + error.message);
                popupToggle.checked = !popupToggle.checked;
                updatePopupLabel(popupToggle.checked);
            });
    });
});