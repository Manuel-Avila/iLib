document.addEventListener('DOMContentLoaded', function() {
    let logos = document.querySelectorAll('.logoImage');
    for(let logo of logos) {
        logo.addEventListener('click', function() {
            window.location.replace('index.html');
        });
    }
});