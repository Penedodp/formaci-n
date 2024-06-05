<?php
$host = 'localhost'; 
$db = 'banco';
$usuario = 'root';
$contraseña = '';
$datasourcename = "mysql:host=$host;dbname=$db;charset=utf8"; // info necesaria para conectarme a la bd.
$opciones = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($datasourcename, $usuario, $contraseña, $opciones);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>