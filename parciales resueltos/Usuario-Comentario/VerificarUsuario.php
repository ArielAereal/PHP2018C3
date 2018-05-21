<?php

include "UsuarioCarga.php";

class Validar{

public static function Valida($mail,$pass){


    $lista = array();
    $lista = Usuario::TraerTodosLosUsuarios();

    $flaj = 0;
    
    foreach ($lista as $key => $value) {
        
     if ($value->getemail() === $mail){
         $flaj = 1;
         
        $sinblanks =  preg_replace('/\s+/','',$value->getclave());
        
       if($sinblanks === $pass)
         {
             
        $flaj = 2;
        $suces = $value;
        break;
         } 
     } 
    }

    if ($flaj == 1){
        echo "contraseña incorrecta";
    }else if($flaj == 2){
        echo "Bienvenido, ".$suces->getnombre();
    }else if($flaj == 0){
        echo "email inválido";
    }   

}

}

?>