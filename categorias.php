<?php include("coneccion.php"); ?>
<?php include("header.php"); ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset(); } ?>

            <div class="card card-body">
                <form action="save_categoria.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion" class="form-control" placeholder="Descripción" autofocus></textarea>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success btn-block" name="save_categoria">Agregar Categoría</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT * FROM categorias";
                        $resultado_categoria = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_array($resultado_categoria)){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['descripcion']; ?></td>
                                <td>
                                <a href="edit_categoria.php?id=<?php echo $row['id']; ?>" class="btn btn-primary me-1">Editar</a>
                                <a href="delete_categoria.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-margin">Eliminar</a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>