function cargarCategorias() {
    $.ajax({
        url: 'http://localhost/proyecto/categoria.php',
        type: 'GET',
        success: function (data) {
            console.log(data);
            $('tbody').html(data);
        },
        error: function () {
            alert('Error al cargar las categorías');
        }
    });
}

$(document).ready(function () {
    cargarCategorias();
});