document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.animate-header');
    setTimeout(function() {
        header.classList.add('show');
    }, 500); // Retraso de 500 milisegundos (medio segundo) antes de mostrar la animación
});

document.addEventListener('DOMContentLoaded', function() {
    const body = document.querySelector('body');
    setTimeout(function() {
        body.classList.add('show');
    }, 100); // Retraso de 500 milisegundos (medio segundo) antes de mostrar la animación
});
