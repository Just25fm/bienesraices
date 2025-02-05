document.addEventListener('DOMContentLoaded', function() {

    eventListerners();
});

function eventListerners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
}