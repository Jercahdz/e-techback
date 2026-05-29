<?php  include ("coneccion.php")?>

<?php  include ("header.php")?>


<div class=""> 

    <div class="row"> 
        <div class="col-md-4">

            <?php if(isset ($_SESSION['message']))      { ?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
    <?= $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

            <?php session_unset(); } ?>

            <div class="card card-body">
                <form action="save_producto.php" method ="POST">
                <div class="form-group">
        <label for="nombre"></label>
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" autofocus>
    </div>
    <div class="form-group">
        <label for="descripcion"></label>
        <input type="text" name="descripcion" class="form-control" placeholder="Descripción" autofocus>
    </div>
    <div class="form-group">
        <label for="precio"></label>
        <input type="text" name="precio" class="form-control" placeholder="Precio" autofocus>
    </div>
    <div class="form-group">
        <label for="cantidad"></label>
        <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" autofocus>
    </div>
    <div class="form-group">
        <label for="id_marca"></label>
        <input type="text" name="id_marca" class="form-control" placeholder="ID de Marca" autofocus>
    </div>
    <div class="form-group">
        <label for="id_categoria"></label>
        <input type="text" name="id_categoria" class="form-control" placeholder="ID de Categoría" autofocus>
    </div>
    <br>
    <button type="submit" class="btn btn-success btn-block"
    name="save_producto">Agregar</button>

                </form>
            </div>

        </div>

        <div class="col-md-8">
        <h1>Tabla de Productos</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE </th>
                    <th>DESCRIPCION</th>
                    <th>PRECIO</th>
                    <th>ID MARCA </th>
                    <th>ACCIONES</th>
                </tr>

                
            </thead>
            <tbody>
                <?php 
                
                $query = "SELECT * FROM productos";
                $resultado_producto = mysqli_query($conn, $query);
                
                while($row = mysqli_fetch_array($resultado_producto)){ ?>

                    <tr>
                        <td><?php echo $row ['id_marca'] ?></td>
                        <td><?php echo $row ['nombre'] ?></td>
                        <td><?php echo $row ['descripcion'] ?></td>
                        <td><?php echo $row ['precio'] ?></td>
                        <td><?php echo $row ['id_categoria'] ?></td>
                        <td>
                        <a href="edit_producto.php" class="btn btn-primary me-1">Editar</a>
                        <a href="delete_producto.php" class="btn btn-danger btn-margin">Eliminar</a>

                        </td>
                    </tr>
                    <tr>

                    </tr>
               
                
                <?php }  ?>

            </tbody>



        </table>








        </div>

    </div>


</div>

<?php  include ("footer.php")?>




