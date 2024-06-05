<?php
include 'configuracion.php';

$stmt = $pdo->query('SELECT * FROM apuntes');
$apuntes = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($apuntes);
?>