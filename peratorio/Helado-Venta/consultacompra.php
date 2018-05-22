<?php

class ConsultaC{


    public static function CompradorMax(){

        $tas = VentaImagen::TraerTodasLasVentas();

        $builder = array();

        $max = 0;

        $maxid;

        $helper = array();

        $lavencida = array();

        //var_dump($tas);
        
        // necesito un contador por cada venta diferente
        
        foreach ($tas as $key => $value) {         
            
            $builder[] = $value->getid();
        }
        
        
        
        $helper = array_unique($builder);

        sort($helper);

        foreach ($helper as $key => $value) {
            
            $lavencida[] = $value;
        }        
        
        
        for ($j=0; $j < count($lavencida) ; $j++) { 
            
            $lavencida[$j] = 0;

        }
        foreach ($builder as $key => $value) {
            
            for ($i=0; $i < count($helper) ; $i++) { 
                
                if($value == $helper[$i])
                {
                    $lavencida[$i] = $lavencida[$i] + 1;
                }

            }

        }


        for ($k=0; $k < count($helper) ; $k++) { 
            
            if($lavencida[$k] > $max){
                
                $max = $lavencida[$k];
                
                $maxid = $helper[$k];
            

            }      
            
        

            }

            $flag=0;
            foreach ($lavencida as $key => $value) {
                if($value == $max){
                    $flag++;
                    if($flag>1){

                        echo "Hay más de un comprador máximo";
                    }
                }

            }

            $lista = Cliente::TraerTodosLosClientes();
//echo "<pre>";

            //echo $maxid;
//            var_dump($lista);

  //          echo "<pre>";
     $clienteganador;




     foreach ($lista as $key => $value) {
         

       
        if(trim($value->getid()) == trim($maxid)){

            $clienteganador = $value;
        }
     }
     
     echo "Datos del cliente con más compras de helados: ";

    echo $clienteganador->Mostrar();   
    
    var_dump($clienteganador->getfoto());

    echo "<br><br><br><div><img heigth='200px' width='200px' src= 'ImagenesDeClientes/".trim($clienteganador->getfoto()) . "' alt='noimghela.mig'></div>";
    }


}// clase



?>