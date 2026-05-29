<?php
session_start();
include("coneccion.php");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto_id'])) {
        $producto_id = $_POST['producto_id'];
        array_push($_SESSION['carrito'], $producto_id);
    } elseif (isset($_POST['finalizar_compra'])) {
        $_SESSION['carrito'] = [];

        $mensaje_compra = "¡Compra exitosa! Gracias por tu compra.";
    }
}

if (!empty($_SESSION['carrito'])) {
    // Contar la cantidad de cada producto en el carrito
    $productos_cantidad = array_count_values($_SESSION['carrito']);

    // Obtener los detalles de los productos
    $producto_ids = implode(',', array_keys($productos_cantidad));
    $sql = "SELECT * FROM Productos WHERE id IN ($producto_ids)";
    $result = $conn->query($sql);
    $productos_carrito = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/productos.css">
    <title>Carrito de Compras</title>
</head>

<body>
    <?php include("header.php") ?>

    <div class="container mt-5">
        <h2 class="mb-4">Carrito de Compras</h2>
        <?php if (isset($mensaje_compra)) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensaje_compra; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($productos_carrito)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos_carrito as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td>$<?php echo $producto['precio']; ?></td>
                            <td><?php echo $productos_cantidad[$producto['id']]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method="post">
                <button type="submit" name="finalizar_compra" class="btn btn-success">Finalizar Compra</button>
            </form>
        <?php else : ?>
            <p>El carrito está vacío.</p>
        <?php endif; ?>
        <a href="mostrar_productos.php" class="btn btn-primary">Continuar comprando</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <?php include("footer.php") ?>
</body>

</html>
