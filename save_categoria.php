<?php
include("coneccion.php");

if (isset($_POST['save_categoria'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $query = "INSERT INTO categorias (nombre, descripcion) VALUES ('$nombre', '$descripcion')";
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die("Query falló: " . mysqli_error($conn));
    }

    $_SESSION['message'] = 'Categoría guardada';
    $_SESSION['message_type'] = 'success';

    header("Location: categorias.php");
}
?>