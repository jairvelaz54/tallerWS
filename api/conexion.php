<?php

$token = 'PALABRA CLAVE';
$palabraReto = $_GET['hub_challenge'];
$tokenVerificacion = $_GET['hub_verify_token'];
if ($token === $tokenVerificacion) {
    echo $palabraReto;
    exit;
}


$respuesta = file_get_contents("php://input");
$respuesta = json_decode($respuesta, true);

$mensaje=$respuesta['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];

file_put_contents("text.txt", $mensaje);
include('musica.php');
