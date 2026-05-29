<?php
include("coneccion.php");

$query = "SELECT id, nombre, descripcion FROM categorias";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["descripcion"] . "</td>";
        echo "<td><button onclick=\"eliminarCategoria(" . $row["id"] . ")\">Eliminar</button>";
        echo " <button onclick=\"mostrarFormulario(" . $row["id"] . ")\">Actualizar</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay categorías disponibles</td></tr>";
}

$conn->close();
?>
