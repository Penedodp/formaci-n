<?php
include 'configuracion.php';

$requestUri = $_SERVER['REQUEST_URI'];

$uriSegments = explode('/', $requestUri);

$id = end($uriSegments);

if (is_numeric($id)) {
    $stmt = $pdo->prepare('SELECT * FROM apuntes WHERE id = ?');
    $stmt->execute([$id]);
    $apunte = $stmt->fetch();

    if ($apunte) {
        header('Content-Type: application/json');
        echo json_encode($apunte);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Apunte no encontrado']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID no proporcionado o inválido']);
}
?>
