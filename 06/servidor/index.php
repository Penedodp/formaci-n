<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

// Crear conexión
$conexion = new mysqli($serverName, $username, $password, $dbname);

// Verificar el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Obtener el ID del usuario desde la URL utilizando la ruta
    $uri = $_SERVER['REQUEST_URI'];
    $uriSegments = explode('/', trim($uri, '/'));

    $id = 0; // Variable para recoger el id en 0 y luego darle el valor del de la url
    foreach ($uriSegments as $key => $segment) {
        if ($segment === 'usuario' && isset($uriSegments[$key + 1])) {
            $id = intval($uriSegments[$key + 1]); // recorro los segmentos de la url hasta llegar al ultimo que es el id
            break;
        }
    }

    if ($id > 0) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $datos = $result->fetch_assoc();
            respuesta(200, "OK", $datos);
        } else {
            respuesta(404, "Usuario no encontrado", null);
        }
    } else {
        $sql = "SELECT * FROM usuarios";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $datos = $result->fetch_all(MYSQLI_ASSOC);
            respuesta(200, "OK", $datos);
        } else {
            respuesta(404, "No se encontraron usuarios", null);
        }
    }
} elseif ($method == 'POST') {
    // Leer los datos JSON del cuerpo de la solicitud
    $input = file_get_contents('php://input');
    $datos = json_decode($input, true);

    if (
        isset($datos['nombre']) && isset($datos['apellidos']) && isset($datos['telefono']) &&
        isset($datos['email']) && isset($datos['direccion']) && isset($datos['localidad']) &&
        isset($datos['user']) && isset($datos['password']) && isset($datos['perfil'])
    ) {
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellidos'];
        $telefono = $datos['telefono'];
        $email = $datos['email'];
        $direccion = $datos['direccion'];
        $localidad = $datos['localidad'];
        $user = $datos['user'];
        $password = $datos['password'];
        $perfil = $datos['perfil'];

        // Insertar nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, email, direccion, localidad, user, password, perfil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql); // Preparo el sql
        $stmt->bind_param("ssssssssi", $nombre, $apellidos, $telefono, $email, $direccion, $localidad, $user, $password, $perfil);// Paso los parametros que añadimos a la bd. s = String, i = Integer

        if ($stmt->execute()) {
            $id = $stmt->insert_id; // creo el id para que se inserte
            respuesta(201, "Usuario creado exitosamente", ['id' => $id]);
        } else {
            respuesta(500, "Error al crear el usuario", null);
        }

        $stmt->close();
    }
}
if ($method == 'DELETE') {
    $uri = $_SERVER['REQUEST_URI'];
    $uriSegments = explode('/', trim($uri, '/'));

    $id = 0; // Variable para recoger el id en 0 y luego darle el valor del de la url
    foreach ($uriSegments as $key => $segment) {
        if ($segment === 'usuario' && isset($uriSegments[$key + 1])) {
            $id = intval($uriSegments[$key + 1]);// recorro los segmentos de la url hasta llegar al ultimo que es el id
            break;
        }
    }
    if ($id > 0) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    if ($stmt->execute()) {
        respuesta(200, "Usuario borrado exitosamente", null);
    } else {
        respuesta(500, "Error al crear el usuario", null);
    }

}
if ($method == 'PUT') {
    $input = file_get_contents('php://input');
    $datos = json_decode($input, true);

    if (
        isset($datos['nombre']) && isset($datos['apellidos']) && isset($datos['telefono']) &&
        isset($datos['email']) && isset($datos['direccion']) && isset($datos['localidad']) &&
        isset($datos['user']) && isset($datos['password']) && isset($datos['perfil'])
    ) {
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellidos'];
        $telefono = $datos['telefono'];
        $email = $datos['email'];
        $direccion = $datos['direccion'];
        $localidad = $datos['localidad'];
        $user = $datos['user'];
        $password = $datos['password'];
        $perfil = $datos['perfil'];


        $uri = $_SERVER['REQUEST_URI'];
        $uriSegments = explode('/', trim($uri, '/'));

        $id = 0; // Variable para recoger el id en 0 y luego darle el valor del de la url
        foreach ($uriSegments as $key => $segment) {
            if ($segment === 'usuario' && isset($uriSegments[$key + 1])) {
                $id = intval($uriSegments[$key + 1]);// recorro los segmentos de la url hasta llegar al ultimo que es el id
                break;
            }
        }
        if ($id > 0) {
            $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, telefono = ?, email = ?, direccion = ?, localidad = ?, user = ?, password = ?, perfil = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssssssssii", $nombre, $apellidos, $telefono, $email, $direccion, $localidad, $user, $password, $perfil,$id);

            // Ejecutola consulta
            if ($stmt->execute()) {
                respuesta(200, "Usuario actualizado exitosamente", $datos);
            } else {
                respuesta(500, "Error al actualizar el usuario: " . $stmt->error, null);
            }

            $stmt->close();
        }
    }
}


if ($method == 'GET') {
    // Obtener el ID del usuario desde la URL utilizando la ruta
    $uri = $_SERVER['REQUEST_URI'];
    $uriSegments = explode('/', trim($uri, '/'));

    $id = 0; // Variable para recoger el id en 0 y luego darle el valor del de la url
    foreach ($uriSegments as $key => $segment) {
        if ($segment === 'comentario' && isset($uriSegments[$key + 1])) {
            $id = intval($uriSegments[$key + 1]); // recorro los segmentos de la url hasta llegar al ultimo que es el id
            break;
        }
    }

    if ($id > 0) {
        $sql = "SELECT * FROM comentarios WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $datos = $result->fetch_assoc();
            respuesta(200, "OK", $datos);
        } else {
            respuesta(404, "Usuario no encontrado", null);
        }
    } else {
        $sql = "SELECT * FROM comentarios";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $datos = $result->fetch_all(MYSQLI_ASSOC);
            respuesta(200, "OK", $datos);
        } else {
            respuesta(404, "No se encontraron usuarios", null);
        }
    }
}


$conexion->close();

function respuesta($estado, $mensaje_estado, $datos)
{
    header("Content-Type: application/json");
    http_response_code($estado);
    $respuesta = [
        'estado' => $estado,
        'mensaje_estado' => $mensaje_estado,
        'datos' => $datos
    ];
    echo json_encode($respuesta);
    logConsulta($estado, $mensaje_estado);
}
function logConsulta($estado, $mensaje_estado) {
    $archivoLog = 'log.txt';
    $fechaHora = date('Y-m-d H:i:s');
    $mensajeLog = "[$fechaHora] Estado: $estado, Mensaje: $mensaje_estado" . PHP_EOL;
    file_put_contents($archivoLog, $mensajeLog, FILE_APPEND);
}
?>