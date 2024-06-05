<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/Servicios/miManera/06/servidor/index.php/usuario/11',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS =>' {
        "nombre":"rafino",
        "apellidos":"canino Piños",
        "telefono":"666554433",
        "email":"erewrwe@ddsjj.es",
        "direccion":"Orujo 12",
        "localidad":"Alcobendas",
        "user":"campillo",
        "password":"password",
        "perfil":"1"
    }
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);