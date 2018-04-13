<?php

class Enigma{

   public static function Encriptar($mensaje,$ruta){

    $separate = array();

    $cript = array();
    
    $banda = 0;
       
    $separate  = str_split($mensaje);


    //var_dump($separate);

    foreach ($separate as $key => $value) {
        $accion = 200 + ord($value);
        array_push($cript, $accion);


    }

//    var_dump($cript);

    
// volver a char
// volver a string

    foreach ($cript as $key => $value) {

        if($banda == 0){
        $result = chr($value);
            $banda = 1;
            
        }else{
            $result = $result . chr($value);
        }
    }

    
    $archivo_maldecido = fopen($ruta,"w");

    fwrite($archivo_maldecido,$result);
    
    fclose($archivo_maldecido);

    }

    public static function Desencriptar($ruta){

        $separate = array();

        $cript = array();
    
        $banda = 0;

        $archivo = fopen($ruta,"r");

        $texto = fread($archivo, filesize($ruta));

        $separate  = str_split($texto);

        foreach ($separate as $key => $value) {
            $accion = ord($value)-200;
            array_push($cript, $accion);
        
        }

        foreach ($cript as $key => $value) {

            if($banda == 0){
                $result = chr($value);
                $banda = 1;            
        }else{
            $result = $result . chr($value);
        }

    }
    echo $result;

    }
}



?>