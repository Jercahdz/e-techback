<?php
session_start();
include("coneccion.php");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];

        // Verificar la disponibilidad antes de agregar al carrito
        $sql_disponibilidad = "SELECT cantidad FROM Productos WHERE id = $producto_id";
        $result_disponibilidad = $conn->query($sql_disponibilidad);
        $row_disponibilidad = $result_disponibilidad->fetch_assoc();

        if ($row_disponibilidad['cantidad'] > 0) {
            // Agregar al carrito
            array_push($_SESSION['carrito'], $producto_id);

            // Reducir la cantidad disponible en la base de datos
            $sql_actualizar_cantidad = "UPDATE Productos SET cantidad = cantidad - 1 WHERE id = $producto_id";
            $conn->query($sql_actualizar_cantidad);

            // Mostrar un mensaje de confirmación
            $_SESSION['mensaje'] = "Producto agregado al carrito.";
        } else {
            $_SESSION['mensaje'] = "Producto agotado.";
        }
    }
}

$sql = "SELECT * FROM Productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/productos.css">
    <title>Mostrar Productos</title>
</head>

<body>
    <?php include("header.php") ?>

    <div class="container mt-5">
        <h2 class="col-12 text-center mb-4">Nuestros Productos</h2>
        <div class="row">
            <?php

            if (isset($_SESSION['mensaje'])) {
                echo '<div class="col-12 mb-4">';
                echo '<div class="alert alert-success" role="alert">' . $_SESSION['mensaje'] . '</div>';
                echo '</div>';
                unset($_SESSION['mensaje']);
            }

            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card product-card h-100">';
                echo '<img src="' . $row['imagen'] . '" class="card-img-top" alt="' . $row['nombre'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
                echo '<p class="card-text product-description">' . $row['descripcion'] . '</p>';
                echo '<p class="card-text">Precio: $' . $row['precio'] . '</p>';
                echo '<p class="card-text">Cantidad disponible: ' . $row['cantidad'] . '</p>';
                echo '</div>';
                echo '<div class="card-footer">';
                echo '<form action="mostrar_productos.php" method="post">';
                echo '<input type="hidden" name="producto_id" value="' . $row['id'] . '">';
                echo '<button class="btn btn-primary">Agregar al carrito</button>';
                echo '</form>';
                echo '</div>';
                echo '</div></div>';
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <?php include("footer.php") ?>
</body>

</html>
