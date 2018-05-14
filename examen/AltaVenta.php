<?php


class Venta{



public static function Laventa($email,$sabor,$tipo,$cantidad){
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

  
       $ar = fopen("helados.txt", "w");
				
        //ESCRIBO EN EL ARCHIVO
        
        foreach ($hela as $key => $value) {
            
            fwrite($ar, $value->Mostrar()."\r\n");		
        }
	
		//CIERRO EL ARCHIVO
        fclose($ar);

}else {
    
            echo "helado fuera de termino";
        }
    



// si existe el helado, y hay stock, guardar en el archivo


if($flag == 1)
{
    // construir la linea y guardar en un array
    $todo = $email . "-" . $sabor . "-".$tipo."-".$cantidad;
    Venta::Guarda($todo);
}


}

public static function Guarda($todo){

    $ar = fopen("Venta.txt", "a");
    
    
    //ESCRIBO EN EL ARCHIVO
    fwrite($ar, $todo."\r\n");		

    //CIERRO EL ARCHIVO
    fclose($ar);		
    
    echo "Venta dado de alta";

}

}





?>