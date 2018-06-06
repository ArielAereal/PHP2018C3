<?php

// altaventa guardar imagen

class VentaImagen extends Venta{


public static function LaVenta($email,$sabor,$tipo,$cantidad,$imagen){

    $archivoTmp = "";
    if(!file_exists("ImagenesDeLaVenta")){
        mkdir("ImagenesDeLaVenta");
    }

    $flag = 0;
    
    $rta = ConsultaHelado::Consultar($tipo,$sabor);
    if( $rta == "Coincide $sabor y $tipo")
    {
        $hela = Helado::TraerTodosLosHelados();


    foreach ($hela as $key => $value) {
        if(trim($value->getsabor()) == $sabor){            
            if($cantidad > $value->getcantidad())
            {
                
                echo "no hay suficiente en stock";
            }else
            {
                $dato = $value->getcantidad() - $cantidad;
                $value->setcantidad($dato);
                $flag = 1;
                break;
            }
        }
    }    
    
    // actualizar txt helados
if($flag == 1){



  
       $ar = fopen("helados.txt", "w");
				
        //ESCRIBO EN EL ARCHIVO
        
        foreach ($hela as $key => $value) {
            
            fwrite($ar, $value->Mostrar()."\r\n");		
        }
	
		//CIERRO EL ARCHIVO
        fclose($ar);
    

$fech = date("Y-m-d-H-i-s");
$archivoTmp = $sabor . "-"."-".$fech.".". pathinfo($imagen["name"],PATHINFO_EXTENSION);
$destino = "ImagenesDeLaVenta/" . $archivoTmp;

if (!move_uploaded_file($imagen["tmp_name"], $destino)) {
    echo "subida mala";
    return false;
        }
    

            $todo = $email . "-" . $sabor . "-".$tipo."-".$cantidad . "-" . $archivoTmp;
            Venta::Guarda($todo);

        }
        
        
    }

}

}



?>