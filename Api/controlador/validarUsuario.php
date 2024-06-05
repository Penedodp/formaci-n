<?php
function validarDatos($usuario, $contraseña, $conexion)
{
    $query = "SELECT * FROM usuarios WHERE user = '$usuario' AND password = '$contraseña'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellidos'] = $row['apellidos'];
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['password'];

    if (validarDatos($usuario, $contraseña, $conexion)) {
        header("Location: buscador.php");
        exit();
    } else {
        $mensajeError = "Usuario o contraseña incorrectos";
    }
}
?>