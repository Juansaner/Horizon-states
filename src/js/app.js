document.addEventListener('DOMContentLoaded', function() {
    
    eventListeners();
    darkMode();
});

function darkMode() {

    /** Leer preferencias del sistema */
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    const aplicarDarkMode = (prefiereDarkMode) => {
        if(prefiereDarkMode.matches){
            document.body.classList.add('darkMode');
            document.getElementById('dark-mode-texto').innerText = 'Luz';
        } else {
            document.body.classList.remove('darkMode');
            document.getElementById('dark-mode-texto').innerText = 'Oscuro';
        }
    }

    /* Inicializa según la preferencia del sistema */
    aplicarDarkMode(prefiereDarkMode);

    /* Escucha los cambios en las preferencias del sistema */
    prefiereDarkMode.addEventListener('change', ()  => {
        aplicarDarkMode(prefiereDarkMode);
    })

    /* Activar o desactivar el estado con el boton*/
    const botonDarkMode = document.querySelector('.navegacion-dark-mode');
    
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('darkMode');
        /* Verifica si el body contiene la clase darkMode para posteriormente cambiar el texto del botón */
        if(document.body.classList.contains('darkMode')){
            document.getElementById('dark-mode-texto').innerText = 'Claro';
        } else  {
            document.getElementById('dark-mode-texto').innerText = 'Oscuro';
        }
    })
}

function eventListeners() {
    const mobileMenu = document.querySelector('.menu-mobile');
    const closeMenu = document.querySelector('.close-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
    closeMenu.addEventListener('click', cerrar);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach( input => input.addEventListener('click', mostrarMetodosContacto));

}

/** Agrega clase mostrar para desplegar menu hamburguesa */
function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar'); 
}
/** Cerrar menu hamburguesa */
function cerrar() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.remove('mostrar');

}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    
    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Número de teléfono</label>
            <input type="tel" placeholder="Teléfono" id="telefono" name="contacto[telefono]">

            <p>Elija la fecha y la hora</p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]"></input>`;
            
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="E-mail" id="email" name="contacto[correo]" required>
        `;
    }
}

/* Animación menú fijo */
    
window.addEventListener('scroll', function() {
    const barra = document.querySelector('.barra');
    barra.classList.toggle('abajo', window.scrollY>0);

})

    
