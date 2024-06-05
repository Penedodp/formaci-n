<?php
function obtenerDatosUsuarios($url)
{
    try {
        $respuesta = file_get_contents($url);
        if ($respuesta === FALSE) {
            throw new Exception("No se puede obtener el contenido de la URL.");
        }

        $datos = json_decode($respuesta, true);
        return $datos;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}


$url = "http://localhost/Servicios/miManera/04/servidor/index.php/usuario/";
$datos = obtenerDatosUsuarios($url);

if ($datos !== null) {
    print_r($datos);
} else {
    echo "Error al obtener o decodificar los datos.";
}
