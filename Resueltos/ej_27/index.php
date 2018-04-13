<?php

include "ayuda/index.php";

// glup recibe un array de caracteres, los invierte con el ksort y los retorna en otro array


//$prueba = array('y','e','s');

//var_dump(glup($prueba));

$dato = $_POST['invertir'];

$archivo = fopen($dato,"r");

$content = fread($archivo,filesize($dato));

fclose($archivo);

//$arr1 = str_split($str);

$salida = str_split($content);

$entrada = glup($salida);


$atexto = implode($entrada);

$hora = date("Y-m-d-H-i-s");

$nombre = array();
$nombre = explode("-",$hora);

$capsula = $nombre[0]."_".$nombre[1]."_".$nombre[2]."_".$nombre[3]."_".$nombre[4]."_".$nombre[5];

$ultimo = fopen("misArchivos/$capsula.txt","w");

fwrite($ultimo,$atexto,strlen($content));

//var_dump($atexto);

fclose($ultimo);

echo "<br><br><br>". $content;





?>