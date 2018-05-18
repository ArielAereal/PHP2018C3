<?php

class ConsultaHelado{
   
public static function Consultar($eltipo = "",$elsabor = ""){

    // cuenta encuentros
    $flag = 0;

    //encuentra los dos en objetos distintos
    $otro = 0;

    $salidas = "";
    $salidat = "";

    $hela = Helado::TraerTodosLosHelados();

    if($elsabor != "")
    {

        foreach ($hela as $key => $value) {

            if(trim($value->getsabor()) == trim($elsabor))
            {

                //1) encontré el sabor, flag == 1
            $flag=1;
            $salidas = trim($value->getsabor());

                if(trim($value->gettipo()) == trim($eltipo)){
                    // 2) encontré también el tipo, flag == 2
                    $salidat = trim($value->gettipo());
                    $flag++;       
                }
                break;
            }
        }

        // si no encontré los dos, hace falta????
        if($flag != 2){

            foreach ($hela as $key => $value) {
   
                if(trim($value->gettipo()) == trim($eltipo)){
                    $salidat = trim($value->gettipo());
                    $flag++;
                    $otro++;              
                    break;
                }
   
            }
        }

        // si el sabor no viene
}else{

    foreach ($hela as $key => $value) {
        if(trim($value->gettipo()) == trim($eltipo)){
            $salidat = trim($value->gettipo());
            $flag++;
            $otro++;
            break;
        }

    }

}


if($flag == 2){

    $muestre = "Coincide $salidas y $salidat";

    // deberia decir que chocolate con agua no existe y punto?    
    
    if($otro == 1)
    {
        $muestre =$muestre . ". Pasa que $salidas tiene otro tipo, y $salidat tiene otro sabor.";
    }

    
}

if($flag == 1)
{

    if($salidas != "")
    {
        $muestre = "Coincide $salidas";

        if($eltipo != ""){

            $muestre = $muestre . ", no coincide el tipo ";
        }
    }

    if($salidat != "")
    {
        $muestre = "Coincide $salidat";
        
        if($elsabor != ""){

            $muestre = $muestre . ", no coincide el sabor";
        }
    }

}

if ($flag == 0){

    if($eltipo != "" || $elsabor != ""){
    
        if($eltipo != "" && $elsabor != ""){

            $muestre = "No coincide ni el tipo ni el sabor";
        }else{

            if($eltipo != ""){
                $muestre = "No coincide el tipo";
            }

            if($elsabor != ""){
                $muestre = "No coincide el sabor";
            }
        
        }

    }
}

return $muestre;

}

}

?>