document.addEventListener('DOMContentLoaded', function() {

    eventListerners();

    darkMode();

    mostrarImagen();

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

            // Diferenciar entidad
            const tipo = form.querySelector('[name="tipo"]').value;
            const textoMensaje = (tipo === 'vendedor')
                ? 'Eliminar este vendedor' 
                : 'Eliminar esta propiedad';

            // Detectar si el modo oscuro está activo en la página principal
            const isDarkMode = document.body.classList.contains('dark-mode');

            Swal.fire({
                title: '¿Estás seguro?',
                text: textoMensaje,
                icon: 'warning',
                iconColor: isDarkMode ? '#ff6b6b' : '#d33', // Color del ícono
                background: isDarkMode ? '#1e1e1e' : '#ffffff', // Color de fondo del modal
                color: isDarkMode ? '#f8f9fa' : '#545454', // Color del texto y título
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: isDarkMode ? '#4a4a4a' : '#3085d6', // Color del botón cancelar
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

function mostrarImagen() {
    // 1. Seleccionamos todas las imágenes de la tabla de propiedades
    const imagenes = document.querySelectorAll('.imagen-tabla');

    // 2. Iteramos sobre cada imagen para agregarle el evento click
    imagenes.forEach(imagen => {
        // Opcional: Cambiar el cursor para indicar que es clickeable
        imagen.style.cursor = 'pointer'; 

        imagen.addEventListener('click', function(e) {
            // 3. Extraemos la ruta completa de la imagen seleccionada
            const urlImagen = e.target.src; 
            
            // 4. Verificamos si el modo oscuro está activo
            const isDarkMode = document.body.classList.contains('dark-mode');

            // 5. Lanzamos el modal de SweetAlert2 con la imagen
            Swal.fire({
                imageUrl: urlImagen,
                imageAlt: 'Imagen ampliada',
                showConfirmButton: false, // Oculta el botón de "OK"
                showCloseButton: true,    // Muestra una "X" en la esquina
                background: isDarkMode ? '#1e1e1e' : '#ffffff',
                color: isDarkMode ? '#f8f9fa' : '#545454',
                padding: '1em',
                width: 'auto', // Se ajusta al tamaño de la imagen
                customClass: {
                    image: 'img-fluid' // Clase útil si usas Bootstrap u otro framework CSS
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