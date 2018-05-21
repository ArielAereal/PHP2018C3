<?php


class Modificacion
{
    public static function ModificarAlumno($unemail,$unnombre="",$unapellido="",$unafoto = ""){

               
        $barra = Alumno::TraerTodosLosAlumnos();
        
        // el alumno a modificar
        $hecho;

        // alumno modificado a guardar
        $target;

        // lista actualizada
        $losnuevos = array();

        // la llave del helado a modificar
        $point;

        $archivoTmp;

        //abre puertas
        $flag= 0; 
              
        //var_dump($unnombre);

        //var_dump($unafoto);

        //var_dump($unapellido);

        foreach ($barra as $key => $value) {

            if(trim($value->getemail()) == trim($unemail)){

                $hecho = $value;
                break;
            }
                      

        }

        $point = array_search($hecho,$barra);         
                
        if($unafoto != "")
        {
            
            // antes, guardar la imagen vieja

                if(!file_exists("archivos/backUpFotos")){
                    mkdir("archivos/backUpFotos");
                }
                $ext =  pathinfo('archivos/ImagenesDeAlumnos/'.$hecho->getfoto(),PATHINFO_EXTENSION);          
        
                $eras = $hecho->getapellido()."_" . date("Y_m_d_H_i_s") . "." . $ext;
                
                // TRIM TRIM TRIM y para eras tambien TRIM
                copy('archivos/ImagenesDeAlumnos/'. trim($hecho->getfoto()),'archivos/backUpFotos/'.trim($eras));

            
                // imagen nueva

                $archivoTmp = $unemail.".". pathinfo($unafoto["name"],PATHINFO_EXTENSION);
          
                  $destino = "archivos/ImagenesDeAlumnos/" . $archivoTmp;
              
                  //$esImagen = getimagesize($image["tmp_name"]);                          
                  if (!move_uploaded_file($unafoto["tmp_name"], $destino)) {
                      echo "subida mala de imagen";
                      return false;
                  }
             
                }

                
              //los tres
              if($unafoto != "" && $unnombre != "" && $unapellido != ""){
                
                $target = new Alumno($unnombre,$unapellido,$unemail,$archivoTmp);   

                array_splice($barra,$point,1,array($target));

                foreach ($barra as $key => $value) {
     
                    $losnuevos[] = new Alumno($value->getnombre(),$value->getapellido(),$value->getemail(),$value->getfoto());
                    
                }
                     
                echo "Alumno modificado y actualizado";
                $flag++;

              }
              
              
              // de a dos
              if($flag == 0){                  

                  if($unnombre != "" && $unapellido != ""){                   
                    $target = new Alumno($unnombre,$unapellido,$unemail,$hecho->getfoto());   
    
                    array_splice($barra,$point,1,array($target));
    
                    foreach ($barra as $key => $value) {
         
                        $losnuevos[] = new Alumno($value->getnombre(),$value->getapellido(),$value->getemail(),$value->getfoto());
                        
                    }
                         
                    echo "Alumno modificado y actualizado";
                    $flag++;

                }


                if($unafoto != "" && $unnombre != ""){

                    $target = new Alumno($unnombre,$hecho->getapellido(),$unemail,$archivoTmp);   
    
                    array_splice($barra,$point,1,array($target));
    
                    foreach ($barra as $key => $value) {
         
                        $losnuevos[] = new Alumno($value->getnombre(),$value->getapellido(),$value->getemail(),$value->getfoto());
                        
                    }
                         
                    echo "Alumno modificado y actualizado";
                    $flag++;
    
                }

                if($unafoto != "" && $unapellido != ""){

                    $target = new Alumno($hecho->getnombre(),$unapellido,$unemail,$archivoTmp);   
    
                    array_splice($barra,$point,1,array($target));
    
                    foreach ($barra as $key => $value) {
         
                        $losnuevos[] = new Alumno($value->getnombre(),$value->getapellido(),$value->getemail(),$value->getfoto());
                        
                    }
                         
                    echo "Alumno modificado y actualizado";
                    $flag++;      
                }        

            }

            // de a uno
                      
        if($flag == 0){

            if($unnombre != ""){

                $target = new Alumno($unnombre,$hecho->getapellido(),$unemail,$hecho->getfoto());   

                array_splice($barra,$point,1,array($target));

                foreach ($barra as $key => $value) {
     
                    $losnuevos[] = new Alumno($value->getnombre(),$value->getapellido(),$value->getemail(),$value->getfoto());
                    
                }
            }

                if($unapellido != ""){

                    $target = new Alumno($hecho->getnombre(),$unapellido,$unemail,$hecho->getfoto());   
    
                    array_splice($barra,$point,1,array($target));
    
                    foreach ($barra as $key => $value) {
         
                        $losnuevos[] = new Alumno($value->getnombre(),$value->getapellido(),$value->getemail(),$value->getfoto());
                        
                    }
                         
                    echo "Alumno modificado y actualizado";

                }

                if($unafoto != ""){

                        $target = new Alumno($hecho->getnombre(),$hecho->getapellido(),$unemail,$archivoTmp);   
        
                        array_splice($barra,$point,1,array($target));
        
                        foreach ($barra as $key => $value) {
             
                            $losnuevos[] = new Alumno($value->getnombre(),$value->getapellido(),$value->getemail(),$value->getfoto());
                            
                        }
                             
                        echo "Alumno modificado y actualizado";
                  }
                     
                

            }//if 1 param

    // todos cargados en el array nuevo

   /* echo "<pre>";
    var_dump($losnuevos);
    echo "</pre>";*/

        $ar = fopen("archivos/alumnos.txt", "w");
				
        //ESCRIBO EN EL ARCHIVO
        
        foreach ($losnuevos as $key => $value) {
            
            fwrite($ar, $value->Mostrar()."\r\n");		
        }
	
		//CIERRO EL ARCHIVO
        fclose($ar);
       
    }// Modificar

} // Modificar Alumno

?>