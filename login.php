<?php
session_start();
include("coneccion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Usuarios WHERE correo_electronico = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['contrasena_hash'])) {
            $_SESSION['usuario'] = $email;
            header("Location: index.html");
            exit();
        } else {
            // Autenticación fallida
            $error_message = "Usuario o contraseña incorrectos";
        }
    } else {
        // Autenticación fallida
        $error_message = "Usuario o contraseña incorrectos";
    }
}
?>