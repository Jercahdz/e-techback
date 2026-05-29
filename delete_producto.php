<?php

    include ("coneccion.php");

    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM productos WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if(!$result){
            die("Query fallo");
        }

        $_SESSION['message'] = 'Producto borrado';
        $_SESSION['message_type'] = 'danger';
        header("location: productos.php");


    }



?>