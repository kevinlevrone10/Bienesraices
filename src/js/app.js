document.addEventListener('DOMContentLoaded', function() {

    eventListeners();

    darkMode();

    desaparezco();
});


function desaparezco ()
{
    const alertaExito = document.querySelector('.alerta-exito-auto-cerrable');

    // Si la alerta de éxito existe
    if (alertaExito) {
        // Esperar 3 segundos (3000 milisegundos)
        setTimeout(() => {
            // Ocultar la alerta de éxito
            alertaExito.classList.add('oculto');
        }, 3000);
    }
}

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}