<?php

class ConsultaLocal{
    
public static function Consultar($lalocalidad = "",$elestado = ""){


 $flag = 0;

 $otro = 0;
 $salidal = "";
 $salidae = "";

 if($flag == 0)
 { 

$locas = Local::TraerTodosLosLocales();


foreach ($locas as $key => $value) {

    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    # code...
}

if($lalocalidad != "")
{

foreach ($locas as $key => $value) {
    if(trim($value->getidlocalidad()) == trim($lalocalidad))
    {
        $flag++;
        $salidal = trim($value->getidlocalidad());
        if(trim($value->getestado()) == trim($elestado)){
            $salidae = trim($value->getestado());
            $flag++;       
        }
        break;
    }
}
if($flag != 2){

foreach ($locas as $key => $value) {
   
    if(trim($value->getestado()) == trim($elestado)){
        $salidae = trim($value->getestado());
        $flag++;
        $otro++;              
        break;
    }
   
}
}

}else{

    if($flag != 2){

    
    foreach ($locas as $key => $value) {
        if(trim($value->getestado()) == trim($elestado)){
            $salidae = trim($value->getestado());
            $flag++;
            $otro++;
        }
        break;

    }
}
}

}

if($flag == 2){

    $muestre = "Coincide $salidae y $salidal";

    if($otro == 1)
    {
        echo ", pasa que $salidal y $salidae son de distintos Locales";
    }

    
}

if($flag == 1)
{

    if($salidal != "")
    {
        $muestre = "Coincide $salidal, no coincide el estado ";
    }

    if($salidae != "")
    {
        $muestre = "Coincide $salidae, no coincide el id Localidad";
    }

}

if ($flag == 0){

    $muestre = "No coincide ni localidad ni estado";
}


return $muestre;






}

}







?>