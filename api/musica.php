<?php
require_once 'simple_html_dom.php';
$array = file("text.txt", FILE_IGNORE_NEW_LINES);
if(empty($array)){
echo "esta vacio";
}else{

$parte1="https://oosound.ru/?mp3=";
$replaza=str_replace(" ", "+", $array[0]);
$url=$parte1.$replaza;
$song=array();
$nuevo=file_get_html($url);
foreach ($nuevo->find('a.link') as $title) {
   $song[]="https://oosound.ru".$title->href;
 }


$token = 'TU TOKEN DE FACEBOOK';

$telefono = "TU NUMERO DE TELEFONO";
$url = 'SU URL';

//CONFIGURACION DEL MENSAJE
$mensaje2 = ''
        . '{'
        . '"messaging_product": "whatsapp", '
        . '"to": "'.$telefono.'", '
        . '"type": "audio", '
        . '"audio": '
        . '{'
        . '   "link": "'.$song[0].'"'
        . '} '
        . '}';
//DECLARAMOS LAS CABECERAS
$header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
//INICIAMOS EL CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje2);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
$response = json_decode(curl_exec($curl), true);
//IMPRIMIMOS LA RESPUESTA 
print_r($response);
//OBTENEMOS EL CODIGO DE LA RESPUESTA
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//CERRAMOS EL CURL
curl_close($curl);
unlink('text.txt');
}
?>