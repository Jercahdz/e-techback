<?php
session_start();
include("coneccion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $nombre_completo = $_POST['full_name'];
    $telefono = $_POST['phone_number'];
    $correo_electronico = $_POST['email'];
    $contrasena = $_POST['password'];

    $contrasena_hasheada = md5($contrasena);

    $sql = "INSERT INTO Usuarios (nombre_usuario, contrasena_hash, nombre_completo, correo_electronico, rol)
            VALUES ('$correo_electronico', '$contrasena_hasheada', '$nombre_completo', '$correo_electronico', 'usuario')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.');</script>";
        echo "<script>window.location.href = 'log-in.html';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
