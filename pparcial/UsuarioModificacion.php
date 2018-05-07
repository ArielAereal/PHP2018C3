<?php


// valores con imagenes de usuarios modificados, id el email
// no pide lista de usuarios modificados

class UsuarioMod extends Usuario{

    private $imagen;

    public function __construct($unnombre,$unemail,$unperfil,$unaedad,$unaclave,$unaimagen){

        parent::__construct($unnombre,$unemail,$unperfil,$unaedad,$unaclave);

        $this->imagen = $unaimagen;

    }

    public function getimagen(){
        return $this->imagen;
    }
    
    public function setimagen($elimagen){
        $this->imagen = $elimagen;
    }


    // HECHO!!!!!!

 
    public static function ModificarUsuario($unemail,$unaimagen="",$unnombre = "",$unperfil="",$unaedad="",$unaclave=""){

        // preguntar por todos los parametros opcionales

        // todos los usuarios
        $users = Usuario::TraerTodosLosUsuarios();

        // validacion de mail
        $usrfnd = 0;
        // el usuario a modificar
        $hecho;
        $target;
        $losnuevos = array();
        // la llave del usuario a modificar
        $point;
        $archivoTmp;

        $flag= 0;

        foreach ($users as $key => $value) {
            
            if($unemail === trim($value->getemail())){
               $usrfnd++;
               $hecho = $value;
            }
        
        }
        
        if($usrfnd == 0){
            echo "Usuario no registrado";
            return false;
        }
       
        $point = array_search($hecho,$users);  
  
        //guardo la imagen
        if($unaimagen != "")
        {
        
            if(!file_exists("archivos/ImagenesDeUsuarios")){
                mkdir("archivos/ImagenesDeUsuarios");
            } 
    
            $archivoTmp = "$unemail" . ".". pathinfo($unaimagen["name"],PATHINFO_EXTENSION);
    
            $destino = "archivos/ImagenesDeUsuarios/" . $archivoTmp;
        
            //$esImagen = getimagesize($image["tmp_name"]);           
         
            if (!move_uploaded_file($unaimagen["tmp_name"], $destino)) {
                echo "subida mala";
                return false;
            }
        }


        // los 6 parametros

        if($flag == 0)
        {
            
        if($unperfil != "" && $unaedad != "" && $unnombre != "" && $unaclave != "" &&$unaimagen != ""){
                       
            $flag++;

            $target = new UsuarioMod($unnombre,$hecho->getemail(),$unperfil,$unaedad,$unaclave,$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... Los 6 parametros 3R

        }
        
        // 5 parametros

        if($flag == 0)
        {
            // perfil y edad y un nombre y clave
            if($unperfil != "" && $unaedad != "" && $unnombre != "" && $unaclave != ""){
           
            $flag++;

            if($hecho instanceof UsuarioMod){

                $target = new UsuarioMod($unnombre,$hecho->getemail(),$unperfil,$unaedad,$unaclave,$hecho->getimagen());   
            }else {
                $target = new Usuario($unnombre,$hecho->getemail(),$unperfil,$unaedad,$unaclave);
            }
         
        array_splice($users,$point,1,array($target));

         foreach ($users as $key => $value) {

         if($value instanceof UsuarioMod){
             
             $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
         }else {
             $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
         }
         
     }
          
     echo "Usuario modificado actualizado";
     

     } // fin ... perfil y edad y nombre y clave

     // nombre, perfil y clave e imagen
     if($unperfil != "" && $unnombre != "" && $unaclave != "" && $unaimagen != ""){
           
        $flag++;

        $target = new UsuarioMod($unnombre,$hecho->getemail(),$unperfil,$hecho->getedad(),$unaclave,$archivoTmp);   
             
        array_splice($users,$point,1,array($target));
    
         foreach ($users as $key => $value) {
 
             if($value instanceof UsuarioMod){
                 
                 $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
             }else {
                 $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
             }
             
         }
              
         echo "Usuario modificado actualizado";
         
 
         } // fin ... perfil nombre y clave e imagen

         // nombre, edad y clave e imagen
        if($unnombre != "" && $unaedad != "" && $unaclave != "" && $unaimagen != ""){
           
            $flag++;

            $target = new UsuarioMod($unnombre,$hecho->getemail(),$hecho->getperfil(),$unaedad,$unaclave,$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... nombre edad y clave imagen

             // perfil y edad y clave e imagen
        if($unperfil != "" && $unaedad != "" && $unaclave != "" && $unaimagen != ""){
           
            $flag++;

            $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$unperfil,$unaedad,$unaclave,$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... perfil y edad y clave e imagen


             // hacer perfil edad imagen y nombre

             if($unperfil != "" && $unaedad != "" && $unnombre != "" && $unaimagen != ""){
           
                $flag++;   
                  
                    $target = new UsuarioMod($unnombre,$hecho->getemail(),$unperfil,$unaedad,$hecho->getclave(),$archivoTmp);                
              
             
            array_splice($users,$point,1,array($target));
    
             foreach ($users as $key => $value) {
    
             if($value instanceof UsuarioMod){
                 
                 $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
             }else {
                 $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
             }
             
         }
              
         echo "Usuario modificado actualizado";
         
    
         } 

        } // fin todo menos clave


        // 4 parametros 

       if($flag == 0) 
       {

        // perfil y edad (e imagen)
        if($unperfil != "" && $unaedad != "" && $unaimagen != ""){
           
            $flag++;

            $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$unperfil,$unaedad,$hecho->getclave(),$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... perfil y edad e imagen

             // perfil y clave e imagen
         if($unperfil != "" && $unaclave != "" && $unaimagen != ""){
           
            $flag++;

            $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$unperfil,$hecho->getedad(),$unaclave,$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... perfil y clave e imagen

             // edad y clave e imagen
         if($unaedad != "" && $unaclave != "" && $unaimagen != ""){
           
            $flag++;

            $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$unaedad,$unaclave,$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... edad y clave e imagen

         // nombre y clave e imagen
         if($unnombre != "" && $unaclave != "" && $unaimagen != ""){
           
            $flag++;

            $target = new UsuarioMod($unnombre,$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$unaclave,$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... nombre y clave e imagen
      
         // nombre y edad
         if($unnombre != "" && $unaedad != "" && $unaimagen != ""){
           
            $flag++;

            $target = new UsuarioMod($unnombre,$hecho->getemail(),$hecho->getperfil(),$unaedad,$hecho->getclave(),$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... nombre y edad e imagen 

        // nombre y perfil e imagen 
        if($unnombre != "" && $unperfil != "" && $unaimagen != ""){
           
            $flag++;
     
            $target = new UsuarioMod($unnombre,$hecho->getemail(),$unperfil,$hecho->getedad(),$hecho->getclave(),$archivoTmp);   
                 
            array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
             
     
             } // fin ... nombre y perfil


             // falta la imagen y otro parametro

             if($unperfil != "" && $unaclave != "" && $unaedad != ""){
           
                $flag++;
                
                if ($hecho instanceof UsuarioMod){

                    $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$unperfil,$unaedad,$unaclave,$hecho->getimagen());   
                }else{
                    $target = new Usuario($hecho->getnombre(),$hecho->getemail(),$unperfil,$unaedad,$unaclave);   
                }

                     
                array_splice($users,$point,1,array($target));
            
                 foreach ($users as $key => $value) {
         
                     if($value instanceof UsuarioMod){
                         
                         $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                     }else {
                         $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                     }
                     
                 }
                      
                 echo "Usuario modificado actualizado";
                 
         
                 } // fin ... falta imagen y nombre



                 if($unnombre != "" && $unaclave != "" && $unaedad != ""){
           
                    $flag++;
                    
                    if ($hecho instanceof UsuarioMod){
    
                        $target = new UsuarioMod($unnombre,$hecho->getemail(),$hecho->getperfil(),$unaedad,$unaclave,$hecho->getimagen());   
                    }else{
                        $target = new Usuario($unnombre,$hecho->getemail(),$hecho->getperfil(),$unaedad,$unaclave);   
                    }
    
                         
                    array_splice($users,$point,1,array($target));
                
                     foreach ($users as $key => $value) {
             
                         if($value instanceof UsuarioMod){
                             
                             $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                         }else {
                             $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                         }
                         
                     }
                          
                     echo "Usuario modificado actualizado";
                     
             
                     } // fin ... falta imagen y perfil


                     
             if($unperfil != "" && $unaclave != "" && $unnombre != ""){
           
                $flag++;
                
                if ($hecho instanceof UsuarioMod){

                    $target = new UsuarioMod($unnombre,$hecho->getemail(),$unperfil,$hecho->getedad(),$unaclave,$hecho->getimagen());   
                }else{
                    $target = new Usuario($unnombre,$hecho->getemail(),$unperfil,$hecho->getedad(),$unaclave);   
                }

                     
                array_splice($users,$point,1,array($target));
            
                 foreach ($users as $key => $value) {
         
                     if($value instanceof UsuarioMod){
                         
                         $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                     }else {
                         $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                     }
                     
                 }
                      
                 echo "Usuario modificado actualizado";
                 
         
                 } // fin ... falta imagen y edad


                 
             if($unperfil != "" && $unnombre != "" && $unaedad != ""){
           
                $flag++;
                
                if ($hecho instanceof UsuarioMod){

                    $target = new UsuarioMod($unnombre,$hecho->getemail(),$unperfil,$unaedad,$hecho->getclave(),$hecho->getimagen());   
                }else{
                    $target = new Usuario($unnombre,$hecho->getemail(),$unperfil,$unaedad,$hecho->getclave());   
                }

                     
                array_splice($users,$point,1,array($target));
            
                 foreach ($users as $key => $value) {
         
                     if($value instanceof UsuarioMod){
                         
                         $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                     }else {
                         $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                     }
                     
                 }
                      
                 echo "Usuario modificado actualizado";
                 
         
                 } // fin ... falta imagen y clave

        }

        // hacer dos parametros

        if($flag == 0){

            if($unaclave != "" && $unaimagen != ""){
     
                $flag++;
                
                    $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$unaclave,$archivoTmp);                                
                 array_splice($users,$point,1,array($target));
            
                 foreach ($users as $key => $value) {
         
                     if($value instanceof UsuarioMod){
                         
                         $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                     }else {
                         $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                     }
                     
                 }
                      
                 echo "Usuario modificado actualizado";
         
                 } // fin ... clave e imagen

                 if($unnombre != "" && $unaimagen != ""){
     
                    $flag++;
                    
                        $target = new UsuarioMod($unnombre,$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$hecho->getclave(),$archivoTmp);                                
                     array_splice($users,$point,1,array($target));
                
                     foreach ($users as $key => $value) {
             
                         if($value instanceof UsuarioMod){
                             
                             $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                         }else {
                             $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                         }
                         
                     }
                          
                     echo "Usuario modificado actualizado";
             
                     } // fin ... nombre e imagen

                     if($unperfil != "" && $unaimagen != ""){
     
                        $flag++;
                        
                            $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$unperfil,$hecho->getedad(),$hecho->getclave(),$archivoTmp);                                
                         array_splice($users,$point,1,array($target));
                    
                         foreach ($users as $key => $value) {
                 
                             if($value instanceof UsuarioMod){
                                 
                                 $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                             }else {
                                 $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                             }
                             
                         }
                              
                         echo "Usuario modificado actualizado";
                 
                         } // fin ... perfil e imagen

                         if($unaedad != "" && $unaimagen != ""){
     
                            $flag++;
                            
                                $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$unaedad,$hecho->getclave(),$archivoTmp);                                
                             array_splice($users,$point,1,array($target));
                        
                             foreach ($users as $key => $value) {
                     
                                 if($value instanceof UsuarioMod){
                                     
                                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                                 }else {
                                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                                 }
                                 
                             }
                                  
                             echo "Usuario modificado actualizado";
                     
                             } // fin ... edad e imagen

                 if($unnombre != "" && $unperfil != ""){
     
                    $flag++;
             
                    if($hecho instanceof UsuarioMod)
                    {
                     $target = new UsuarioMod($unnombre,$hecho->getemail(),$unperfil,$hecho->getedad(),$hecho->getclave(),$hecho->getimagen());           
             
                    }else {
                     $target = new Usuario ($unnombre,$hecho->getemail(),$unperfil,$hecho->getedad(),$hecho->getclave());
                    }
                     
                         
                     array_splice($users,$point,1,array($target));
                
                     foreach ($users as $key => $value) {
             
                         if($value instanceof UsuarioMod){
                             
                             $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                         }else {
                             $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                         }
                         
                     }
                          
                     echo "Usuario modificado actualizado";
                     
             
                     } // fin ... nombre y perfil

                     
                 if($unnombre != "" && $unaedad != ""){
     
                    $flag++;
             
                    if($hecho instanceof UsuarioMod)
                    {
                     $target = new UsuarioMod($unnombre,$hecho->getemail(),$hecho->getperfil(),$unaedad,$hecho->getclave(),$hecho->getimagen());           
             
                    }else {
                     $target = new Usuario ($unnombre,$hecho->getemail(),$hecho->getperfil(),$unaedad,$hecho->getclave());
                    }
                     
                         
                     array_splice($users,$point,1,array($target));
                
                     foreach ($users as $key => $value) {
             
                         if($value instanceof UsuarioMod){
                             
                             $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                         }else {
                             $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                         }
                         
                     }
                          
                     echo "Usuario modificado actualizado";
                     
             
                     } // fin ... nombre y edad

                     
                 if($unnombre != "" && $unaclave != ""){
     
                    $flag++;
             
                    if($hecho instanceof UsuarioMod)
                    {
                     $target = new UsuarioMod($unnombre,$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$unaclave,$hecho->getimagen());           
             
                    }else {
                     $target = new Usuario ($unnombre,$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$unaclave);
                    }
                     
                         
                     array_splice($users,$point,1,array($target));
                
                     foreach ($users as $key => $value) {
             
                         if($value instanceof UsuarioMod){
                             
                             $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                         }else {
                             $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                         }
                         
                     }
                          
                     echo "Usuario modificado actualizado";
                     
             
                     } // fin ... nombre y clave

                     if($unaedad != "" && $unperfil != ""){
     
                        $flag++;
                 
                        if($hecho instanceof UsuarioMod)
                        {
                         $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$unperfil,$unaedad,$hecho->getclave(),$hecho->getimagen());           
                 
                        }else {
                         $target = new Usuario ($hecho->getnombre(),$hecho->getemail(),$unperfil,$unaedad,$hecho->getclave());
                        }
                         
                             
                         array_splice($users,$point,1,array($target));
                    
                         foreach ($users as $key => $value) {
                 
                             if($value instanceof UsuarioMod){
                                 
                                 $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                             }else {
                                 $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                             }
                             
                         }
                              
                         echo "Usuario modificado actualizado";
                         
                 
                         } // fin ... edad y perfil

                         if($unaclave != "" && $unperfil != ""){
     
                            $flag++;
                     
                            if($hecho instanceof UsuarioMod)
                            {
                             $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$unperfil,$hecho->getedad(),$unaclave,$hecho->getimagen());           
                     
                            }else {
                             $target = new Usuario ($hecho->getnombre(),$hecho->getemail(),$unperfil,$hecho->getedad(),$unaclave);
                            }
                             
                                 
                             array_splice($users,$point,1,array($target));
                        
                             foreach ($users as $key => $value) {
                     
                                 if($value instanceof UsuarioMod){
                                     
                                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                                 }else {
                                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                                 }
                                 
                             }
                                  
                             echo "Usuario modificado actualizado";
                             
                     
                             } // fin ... clave y perfil

                             if($unaclave != "" && $unaedad != ""){
     
                                $flag++;
                         
                                if($hecho instanceof UsuarioMod)
                                {
                                 $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$unaedad,$unaclave,$hecho->getimagen());           
                         
                                }else {
                                 $target = new Usuario ($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$unaedad,$unaclave);
                                }
                                 
                                     
                                 array_splice($users,$point,1,array($target));
                            
                                 foreach ($users as $key => $value) {
                         
                                     if($value instanceof UsuarioMod){
                                         
                                         $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                                     }else {
                                         $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                                     }
                                     
                                 }
                                      
                                 echo "Usuario modificado actualizado";
                                 
                         
                                 } // fin ... clave y edad


        } // fin flag 2 parametros


        // si tengo 1 parametro

        if($flag == 0){        

            if($unaclave != ""){
     
                $flag++;
    
                if($hecho instanceof UsuarioMod)
                {
                    $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$unaclave,$hecho->getimagen());   
    
                }else {
                    $target = new Usuario($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$unaclave);   
                }
                                 
                 array_splice($users,$point,1,array($target));
            
                 foreach ($users as $key => $value) {
         
                     if($value instanceof UsuarioMod){
                         
                         $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                     }else {
                         $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                     }
                     
                 }
                      
                 echo "Usuario modificado actualizado";
         
                 } // fin ... clave
      

        if($unaedad != ""){
     
            $flag++;

            if($hecho instanceof UsuarioMod)
            {
                $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$unaedad,$hecho->getclave(),$hecho->getimagen());   

            }else {
                $target = new Usuario($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$unaedad,$hecho->getclave());   
            }
                             
             array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
     
             } // fin ... edad
        
        if($unperfil != ""){
     
            $flag++;
            
            if($hecho instanceof UsuarioMod)
            {
                $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$unperfil,$hecho->getedad(),$hecho->getclave(),$hecho->getimagen());   

            }else {
                $target = new Usuario($hecho->getnombre(),$hecho->getemail(),$unperfil,$hecho->getedad(),$hecho->getclave());   
            }

             array_splice($users,$point,1,array($target));
        
             foreach ($users as $key => $value) {
     
                 if($value instanceof UsuarioMod){
                     
                     $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
                 }else {
                     $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
                 }
                 
             }
                  
             echo "Usuario modificado actualizado";
     
             } // fin ... perfil
        
    if($unnombre != ""){
     
       $flag++;

       if($hecho instanceof UsuarioMod)
       {
        $target = new UsuarioMod($unnombre,$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$hecho->getclave(),$hecho->getimagen());           

       }else {
        $target = new Usuario ($unnombre,$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$hecho->getclave());
       }
        
            
        array_splice($users,$point,1,array($target));
   
        foreach ($users as $key => $value) {

            if($value instanceof UsuarioMod){
                
                $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
            }else {
                $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
            }
            
        }
             
        echo "Usuario modificado actualizado";
        

        } // fin ... nombre

        
            // una sola imagen 

        if($unaimagen != ""){

                $flag++;
// creo el usuario modificado

    $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$hecho->getclave(),$archivoTmp);


// ver el array search, si te parece

// funca        

$point = array_search($hecho,$users);

// hay que decirle que el reemplazo es un objeto con array()
array_splice($users,$point,1,array($target));


foreach ($users as $key => $value) {

    if($value instanceof UsuarioMod){
        
        $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
    }else {
        $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
    }
    
}
echo "Usuario modificado actualizado";
            }

    }

         if($flag == 1){


        //siempre actualizo el archivo txt

     /*   $ar = fopen("archivos/usuarios.txt", "w");
				
        //ESCRIBO EN EL ARCHIVO
        
        foreach ($losnuevos as $key => $value) {
            
            fwrite($ar, $value->Mostrar()."\r\n");		
        }
	
		//CIERRO EL ARCHIVO
        fclose($ar);*/
        // cierra el else de escribir el archivo
        }else{

            echo $flag;
            echo "Algo salió mal";
        }
              
          echo "<pre>";
        var_dump($losnuevos);
        echo "</pre>";

    }// modificar usuario

    public function Mostrar(){
        $salida = parent::Mostrar();
        $salida = $salida . "-" . trim($this->getimagen());
        return $salida;
    }   


}// Usuario Mod

?>