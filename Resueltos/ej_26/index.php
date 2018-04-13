<?php

$lacopia = $_POST['copiar'];

//FUNCA!!!!!!!
//var_dump($lacopia);

$hora = date("Y-m-d-H-i-s");

$nombre = array();
$nombre = explode("-",$hora);

$capsula = $nombre[0]."_".$nombre[1]."_".$nombre[2]."_".$nombre[3]."_".$nombre[4]."_".$nombre[5];

copy($lacopia,"misArchivos/$capsula.txt");
?>