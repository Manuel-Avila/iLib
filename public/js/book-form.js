let imageInput = document.querySelector('#image-input');

document.querySelector('#add-image-button').addEventListener('click', () => {
    imageInput.click();
});

imageInput.addEventListener('change', (event) => {
    let file = event.target.files[0];

    if (file) {
        let reader = new FileReader();

        reader.onload = (e) => {
            document.querySelector('#book-cover').src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
});