<?php

class ConsultaHelado{


    //3 er intento
public static function Consultar($eltipo = "",$elsabor = ""){

    //$duda = false;

 $flag = 0;
 //   $prende;

 $otro = 0;
 $salidas = "";
 $salidat = "";

 if($flag == 0)
 {

 

$hela = Helado::TraerTodosLosHelados();

if($elsabor != "")
{

foreach ($hela as $key => $value) {
    if(trim($value->getsabor()) == trim($elsabor))
    {
        $flag++;
        $salidas = trim($value->getsabor());
        if(trim($value->gettipo()) == trim($eltipo)){
            $salidat = trim($value->gettipo());
            $flag++;       
        }
        break;
    }
}
if($flag != 2){


foreach ($hela as $key => $value) {
   // var_dump($value);
    if(trim($value->gettipo()) == trim($eltipo)){
        $salidat = trim($value->gettipo());
        $flag++;
        $otro++;              
        break;
    }
   
}
}

}else{

    foreach ($hela as $key => $value) {
        if(trim($value->gettipo()) == trim($eltipo)){
            $salidat = trim($value->gettipo());
            $flag++;
            $otro++;
        }
        break;

    }

}

}

if($flag == 2){

    $muestre = "Coincide $salidas y $salidat";

    if($otro == 1)
    {
        echo "pasa que $salidas y $salidat son de distintos helados";
    }

    
}

if($flag == 1)
{

    if($salidas != "")
    {
        $muestre = "Coincide $salidas, no coincide el tipo ";
    }

    if($salidat != "")
    {
        $muestre = "Coincide $salidat, no coincide el sabor";
    }

}

if ($flag == 0){

    $muestre = "No coincide ni tipo ni sabor";
}


return $muestre;






}

}





?>