<?php


class HeladoModificado extends Helado{

    private $imagen;

    public function __construct($unsabor,$untipo,$unprecio,$unacantidad,$unaimagen){

        parent::__construct($unsabor,$untipo,$unprecio,$unacantidad);
        $this->imagen = $unaimagen;


    }

    public function getimagen(){
        return $this->imagen;
    }
    
    public function setimagen($unaimagen){
        $this->imagen = $unaimagen;
    }

    public static function ModificarHelado($unsabor,$untipo,$unaimagen="",$unprecio = "",$unacantidad=""){

        // todos los helados
        
        $lados = Helado::TraerTodosLosHelados();
        
        // el helado a modificar
        $hecho;

        // helado modificado a guardar
        $target;

        // lista actualizada
        $losnuevos = array();

        // la llave del helado a modificar
        $point;

        $archivoTmp;

        //abre puertas
        $flag= 0;

       // echo "<pre>";
       // var_dump($lados);
       // echo "</pre>";

        foreach ($lados as $key => $value) {

            if(trim($value->getsabor()) == trim($unsabor) && trim($value->gettipo()) == trim($untipo)){

                $hecho = $value;
                break;
            }
            
            

        }

       

        $point = array_search($hecho,$lados); 

              //guardo la imagen
              if($unaimagen != "")
              {
              
                  if(!file_exists("ImagenesDeHelados")){
                      mkdir("ImagenesDeHelados");
                  } 
          
                  $archivoTmp = "$unsabor" ."_".$untipo. ".". pathinfo($unaimagen["name"],PATHINFO_EXTENSION);
          
                  $destino = "ImagenesDeHelados/" . $archivoTmp;
              
                  //$esImagen = getimagesize($image["tmp_name"]);           
               
                  if (!move_uploaded_file($unaimagen["tmp_name"], $destino)) {
                      echo "subida mala de imagen";
                      return false;
                  }
              }

              //los tres
              if($unaimagen != "" && $unprecio != "" && $unacantidad != ""){
                $target = new HeladoModificado($unsabor,$untipo,$unprecio,$unacantidad,$archivoTmp);   

                array_splice($lados,$point,1,array($target));

                foreach ($lados as $key => $value) {
     
                    if($value instanceof HeladoModificado){
                        
                        $losnuevos[] = new HeladoModificado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad(),$value->getimagen());
                    }else {
                        $losnuevos[] = new Helado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad());                        
                    }
                    
                }
                     
                echo "Helado modificado y actualizado";
                $flag++;

              }else{
                  // acá empiezo

                if($unaimagen != "" && $unprecio != ""){

                    $target = new HeladoModificado($unsabor,$untipo,$unprecio,$hecho->getcantidad(),$archivoTmp);   
    
                    array_splice($lados,$point,1,array($target));
    
                    foreach ($lados as $key => $value) {
         
                        if($value instanceof HeladoModificado){
                            
                            $losnuevos[] = new HeladoModificado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad(),$value->getimagen());
                        }else {
                            $losnuevos[] = new Helado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad());                        
                        }
                        
                    }
                         
                    echo "Helado modificado y actualizado";
                    $flag++;

                }

                    //dos

                    if($unaimagen != "" && $unacantidad != ""){

                        $target = new HeladoModificado($unsabor,$untipo,$hecho->getprecio(),$unacantidad,$archivoTmp);   
        
                        array_splice($lados,$point,1,array($target));
        
                        foreach ($lados as $key => $value) {
             
                            if($value instanceof HeladoModificado){
                                
                                $losnuevos[] = new HeladoModificado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad(),$value->getimagen());
                            }else {
                                $losnuevos[] = new Helado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad());                        
                            }
                            
                        }
                             
                        echo "Helado modificado y actualizado";
                        $flag++;

                    }

                        //tres

                        if($unprecio != "" && $unacantidad != ""){

                            if($hecho instanceof Heladomodificado){

                                $target = new HeladoModificado($unsabor,$untipo,$unprecio,$unacantidad,$hecho->getimagen());   
                            }else{
                                $target = new Helado($unsabor,$untipo,$unprecio,$unacantidad);
                            }
            
                            array_splice($lados,$point,1,array($target));
            
                            foreach ($lados as $key => $value) {
                 
                                if($value instanceof HeladoModificado){
                                    
                                    $losnuevos[] = new HeladoModificado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad(),$value->getimagen());
                                }else {
                                    $losnuevos[] = new Helado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad());                        
                                }
                                
                            }
                                 
                            echo "Helado modificado y actualizado";
                            $flag++;

                // dos parametros


              }

            }// else de dos cosos

            if($flag == 0){

                // un parametro

                if($unaimagen != ""){

                    $target = new HeladoModificado($unsabor,$untipo,$hecho->getprecio(),$hecho->getcantidad(),$archivoTmp);       
                    array_splice($lados,$point,1,array($target));
    
                    foreach ($lados as $key => $value) {
         
                        if($value instanceof HeladoModificado){
                            
                            $losnuevos[] = new HeladoModificado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad(),$value->getimagen());
                        }else {
                            $losnuevos[] = new Helado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad());                        
                        }
                        
                    }
                         
                    echo "Helado modificado y actualizado";

              }

              if($unprecio != ""){

                if($hecho instanceof Heladomodificado){

                    $target = new HeladoModificado($unsabor,$untipo,$unprecio,$hecho->getcantidad(),$hecho->getimagen());   
                }else{
                    $target = new Helado($unsabor,$untipo,$unprecio,$hecho->getcantidad());
                }

                array_splice($lados,$point,1,array($target));

                foreach ($lados as $key => $value) {
     
                    if($value instanceof HeladoModificado){
                        
                        $losnuevos[] = new HeladoModificado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad(),$value->getimagen());
                    }else {
                        $losnuevos[] = new Helado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad());                        
                    }
                    
                }
                     
                echo "Helado modificado y actualizado";

            }

                if($unacantidad != ""){

                    if($hecho instanceof Heladomodificado){

                        $target = new HeladoModificado($unsabor,$untipo,$getprecio(),$unacantidad,$hecho->getimagen());   
                    }else{
                        $target = new Helado($unsabor,$untipo,$getprecio(),$unacantidad);
                    }
    
                    array_splice($lados,$point,1,array($target));
    
                    foreach ($lados as $key => $value) {
         
                        if($value instanceof HeladoModificado){
                            
                            $losnuevos[] = new HeladoModificado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad(),$value->getimagen());
                        }else {
                            $losnuevos[] = new Helado($value->getsabor(),$value->gettipo(),$value->getprecio(),$value->getcantidad());                        
                        }
                        
                    }
                         
                    echo "Helado modificado y actualizado";

                }

    }//flag


    // todos cargados en el array nuevo

   /* echo "<pre>";
    var_dump($losnuevos);
    echo "</pre>";*/

        $ar = fopen("Helados.txt", "w");
				
        //ESCRIBO EN EL ARCHIVO
        
        foreach ($losnuevos as $key => $value) {
            
            fwrite($ar, $value->Mostrar()."\r\n");		
        }
	
		//CIERRO EL ARCHIVO
        fclose($ar);
       

} // Helado Modificado



public function Mostrar(){
    $salida = parent::Mostrar();
    $salida = $salida . "-" . trim($this->getimagen());
    return $salida;
}  

}

?>