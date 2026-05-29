<?php
include("coneccion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM categorias WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $query = "UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id";
    mysqli_query($conn, $query);
    header("location: categorias.php");
}
include("header.php");
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit_categoria.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo $nombre ?>" class="form-control" placeholder="Actualizar nombre">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion" class="form-control" placeholder="Actualizar descripción"><?php echo $descripcion ?></textarea>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success" name="update">Actualizar Categoría</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php") ?>
