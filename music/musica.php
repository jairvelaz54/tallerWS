<?php
require '../vendor/autoload.php';
include ('../simple_html_dom.php');
use Goutte\Client;
$client=new Client();
$html=connexion_pagina($client,"https://oosound.ru/?mp3=AQUI PON NOMBRE DE CANCION&s=f",2);
$cancion=extraer_cancion($html);
echo '<audio src="'.$cancion[0].'" controls></audio>';


function connexion_pagina(Client $client, $url, $op){
    $peticion=$client->request("GET",$url);
    if($op==1){
       return $contenido=$peticion->html(); 
    }else if($op==2){
          $contenido=$peticion->html(); 
          return $html=str_get_html($contenido);
    }
}

function extraer_cancion($html){
    $canciones=array();
    $cancion=$html->find('a.link');
    foreach($cancion as $valor){
        $canciones[]="https://oosound.ru/".$valor->href;
    }
    return $canciones;
}
