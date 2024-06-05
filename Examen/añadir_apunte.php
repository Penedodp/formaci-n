<?php
include 'configuracion.php';

$datos = json_decode(file_get_contents('php://input'), true);

if (isset($datos['tipo'], $datos['importe'], $datos['fecha'], $datos['concepto'])) {
    $stmt = $pdo->prepare('INSERT INTO apuntes (tipo, importe, fecha, concepto) VALUES (?, ?, ?, ?)');
    $stmt->execute([$datos['tipo'], $datos['importe'], $datos['fecha'], $datos['concepto']]);

    $id = $pdo->lastInsertId();
    $apunte = [
        'id' => $id,
        'tipo' => $datos['tipo'],
        'importe' => $datos['importe'],
        'fecha' => $datos['fecha'],
        'concepto' => $datos['concepto'],
    ];

    header('Content-Type: application/json');
    echo json_encode($apunte);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Datos incompletos']);
}
?>
