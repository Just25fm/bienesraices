document.addEventListener('DOMContentLoaded', function() {

    eventListerners();

    darkMode();

    //mostrarImagen();

    confirmarEliminacion();

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

function confirmarEliminacion() {
    const formularios = document.querySelectorAll('.eliminar');

    formularios.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Evita el envío automático

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Estas seguro que deseas eliminar esta propiedad?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Envía el formulario si se confirma
                }
            });
        });
    });
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