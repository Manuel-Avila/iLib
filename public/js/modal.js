// Confirm Modal Functionality
function showConfirmModal() {
    return new Promise((resolve, reject) => {
        const confirmModal = document.querySelector('.confirm-modal');
        const darkOverlay = document.querySelector('.dark-overlay');
        const acceptButton = document.querySelector('#accept-modal-button');
        const cancelButton = document.querySelector('#cancel-button');

        darkOverlay.style.display = 'block';
        confirmModal.style.display = 'flex';

        acceptButton.onclick = () => {
            darkOverlay.style.display = 'none';
            confirmModal.style.display = 'none';
            resolve(true);
        };

        cancelButton.onclick = () => {
            darkOverlay.style.display = 'none';
            confirmModal.style.display = 'none';
            resolve(false);
        };
    });
}

function sendToUrl(url) {
    showConfirmModal().then(response => {
        if (response) {
            window.location.href = url;
        }
    });
}