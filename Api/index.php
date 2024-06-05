<?php
session_start();

include ("controlador/connBd.php");

include ("controlador/validarUsuario.php");

$conexion->close();

?>

<?php
include ("vistas/inicioHtml.html");
?>
<link rel="stylesheet" href="vistas/css/login.css">


<div id="contenedor">

    <div id="contenedorcentrado">
        <div id="login">
            <form id="loginform" method="post">
                <label for="usuario">Usuario</label>
                <input id="usuario" type="text" name="usuario" placeholder="Usuario" required>

                <label for="password">Contraseña</label>
                <input id="password" type="password" placeholder="Contraseña" name="password" required>

                <button type="submit" title="Ingresar" name="Ingresar">Login</button>
            </form>
            <?php
            if (isset($mensajeError)) {
                echo '<div class="error">' . $mensajeError . '</div>';
            }
            ?>

        </div>
        <div id="derecho">
            <div class="titulo">
                Bienvenido
            </div>
            <hr>
            <div class="pie-form">
                <a href="#">¿Perdiste tu contraseña?</a>
                <a href="#">¿No tienes Cuenta? Registrate</a>
                <hr>
                <a href="#">« Volver</a>
            </div>
        </div>
    </div>
</div>
<?php
include ("vistas/finHtml.html");
?>