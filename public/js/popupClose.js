// Close popup
document.addEventListener('DOMContentLoaded', () => {
    const eventCard = document.querySelector('.event-card');
    const closeButton = document.querySelector('.event-card__close');

    if (!eventCard) return;

    const closePopup = () => {
        eventCard.style.display = 'none';
        window.removeEventListener('scroll', closePopup);
    };

    if (closeButton) {
        closeButton.addEventListener('click', (e) => {
            e.preventDefault();
            closePopup();
        });
    }

    document.addEventListener('click', (e) => {
        if (!eventCard.contains(e.target) && eventCard.style.display !== 'none') {
            closePopup();
        }
    });
    window.addEventListener('scroll', closePopup, { once: true });

    let inactivityTimeout;
    const resetTimer = () => {
        clearTimeout(inactivityTimeout);
        inactivityTimeout = setTimeout(closePopup, 10000);
    };
    resetTimer();
});