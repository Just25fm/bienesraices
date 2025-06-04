document.addEventListener('DOMContentLoaded', function() {

    eventListerners();

    darkMode();

    //mostrarImagen();

});

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(this.matches) {
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

function eventListerners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
    
}

/** 
function mostrarImagen() {
    
    // Seleccionar imagen
    const imagen = document.querySelector('.imagen-small')

    imagen.onclick = function() {
        console.log(imagen)
        // Generar Modal
        const modal = document.createElement('DIV')
        modal.classList.add('modal')
        modal.onclick = function

        // Agregar al HTML
        const body = document.querySelector('body')
        body.appendChild(modal)
    }
}
*/