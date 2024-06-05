<?php
// Definir los datos del nuevo usuario en un array
$datos = [
    'nombre' => 'Fernando ',
    'apellidos' => 'Alonso Maravillas',
    'telefono' => '678565656',
    'email' => 'artyus@gmail.com',
    'direccion' => 'calle alamo',
    'localidad' => 'Orense',
    'user' => 'user6',
    'password' => 'password',
    'perfil' => 2
];

// Convertir los datos a JSON
$jsonDatos = json_encode($datos);

// Definir la URL del endpoint
$url = "http://localhost/Servicios/miManera/04/servidor/index.php/usuario";

// Usar cURL para hacer la solicitud POST
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonDatos)
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatos);

// Ejecutar la solicitud
curl_exec($ch);

// Cerrar cURL
curl_close($ch);
?>