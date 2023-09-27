$(document).ready(function() {
    $('.template-customizer-open-btn').addClass('d-none');
    setTimeout(function () {
        $('.template-customizer-open-btn').removeClass('d-none');
        $('.layout-wrapper').removeClass('d-none');
        $('.loader').addClass('d-none');
    }, 3000);
})
