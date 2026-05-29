function cargarProductos() {
    $.ajax({
        url: 'http://localhost/proyecto/productos.php',
        type: 'GET',
        success: function (data) {
            console.log(data);
            $('tbody').html(data);
        },
        error: function () {
            alert('Error al cargar los productos');
        }
    });
}

$(document).ready(function () {
    cargarProductos();
});

