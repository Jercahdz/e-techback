<?php
include("coneccion.php");

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM productos WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if ( mysqli_num_rows($resultado) == 1){
        $row = mysqli_fetch_array($resultado);
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $cantidad = $row['cantidad'];
        $id_marca = $row['id_marca'];
        $id_categoria = $row['id_categoria'];
    }
}

if (isset($_POST['update'])){
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $id_marca = $_POST['id_marca'];

    $query = "UPDATE productos SET id_marca = '$id_marca', nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', cantidad = '$cantidad', id_categoria = '$id_categoria' WHERE id = $id";
    mysqli_query($conn, $query);
    header("location: productos.php" );
}
include ("header.php");
?>

<div class="">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit_producto.php" method ="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo $nombre ?>" class="form-control" placeholder="Actualizar nombre">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion" class="form-control" placeholder="Actualizar descripción"><?php echo $descripcion ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="text" name="precio" value="<?php echo $precio ?>" class="form-control" placeholder="Actualizar precio">
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="text" name="cantidad" value="<?php echo $cantidad ?>" class="form-control" placeholder="Actualizar cantidad">
                    </div>

                    <div class="form-group">
                        <label for="id_marca">ID Marca:</label>
                        <input type="text" name="id_marca" value="<?php echo $id_marca ?>" class="form-control" placeholder="Actualizar ID Marca">
                    </div>

                    <div class="form-group">
                        <label for="id_categoria">ID Categoría:</label>
                        <input type="text" name="id_categoria" value="<?php echo $id_categoria ?>" class="form-control" placeholder="Actualizar ID Categoría">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success" name="update">Actualizar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include ("footer.php") ?>