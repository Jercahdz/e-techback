<?php
include("coneccion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM categorias WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query falló");
    }

    $_SESSION['message'] = 'Categoría eliminada';
    $_SESSION['message_type'] = 'danger';
    header("location: categorias.php");
}
?>