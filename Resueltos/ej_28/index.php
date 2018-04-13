<?php

include "entidades/enigma.php";

// verificar con cautela la ruta o path

if(count($_POST)!= 0)
{

    $mensaje = $_POST['mensaje'];
    Enigma::Encriptar($mensaje,"misArchivos/datos_prohibidos.txt");


}else{
    $retorno = $_GET['encriptado'];


    Enigma::Desencriptar($retorno);

}




?>