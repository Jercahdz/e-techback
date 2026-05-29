<?php
include("coneccion.php");

if(isset($_POST['save_producto'])){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $id_marca = $_POST['id_marca'];
    $id_categoria = $_POST['id_categoria'];


    $query = "INSERT INTO productos (nombre, descripcion, precio, cantidad, id_marca, id_categoria) VALUES ('$nombre', '$descripcion', '$precio', '$cantidad', '$id_marca', '$id_categoria')";
    $resultado = mysqli_query($conn, $query);

    if(!$resultado){
        die("Query fallido: " . mysqli_error($conn));
    }
    
    $_SESSION['message'] = 'Dato Guardado';
    $_SESSION['message_type'] = 'success';

    header("Location: productos.php");
}
?>