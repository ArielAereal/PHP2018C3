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

    public static function ModificarUsuario($unemail,$unaimagen,$unnombre = "",$unperfil="",$unaedad="",$unaclave=""){

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

  //GUARDO LA IMAGEN SIEMPRE
  
  //guardo la imagen
  

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

        // los 6 parametros

        if($flag == 0)
        {
            
        if($unperfil != "" && $unaedad != "" && $unnombre != "" && $unaclave != ""){
                       
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
             
     
             } // fin ... Los 6 parametros

        }
        
        // 5 parametros

        if($flag == 0)
        {
            // perfil y edad y un nombre
            if($unperfil != "" && $unaedad != "" && $unnombre != ""){
           
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
     

     } // fin ... perfil y edad y nombre

     // nombre, perfil y clave
     if($unperfil != "" && $unnombre != "" && $unaclave != ""){
           
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
         
 
         } // fin ... perfil nombre y clave

         // nombre, edad y clave
        if($unnombre != "" && $unaedad != "" && $unaclave != ""){
           
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
             
     
             } // fin ... nombre edad y clave

             // perfil y edad y clave
        if($unperfil != "" && $unaedad != "" && $unaclave != ""){
           
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
             
     
             } // fin ... perfil y edad y clave
        }


        // 4 parametros 

       if($flag == 0) 
       {

        // perfil y edad
        if($unperfil != "" && $unaedad != ""){
           
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
             
     
             } // fin ... perfil y edad

             // perfil y clave
         if($unperfil != "" && $unaclave != ""){
           
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
             
     
             } // fin ... perfil y clave

             // edad y clave
         if($unaedad != "" && $unaclave != ""){
           
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
             
     
             } // fin ... edad y clave

         // nombre y clave
         if($unnombre != "" && $unaclave != ""){
           
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
             
     
             } // fin ... nombre y clave
      
         // nombre y edad
         if($unnombre != "" && $unaedad != ""){
           
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
             
     
             } // fin ... nombre y edad

        // nombre y perfil
        if($unnombre != "" && $unperfil != ""){
           
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


        }
        // si tengo 3 parametros

        if($flag == 0){        


        if($unaclave != ""){
     
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
     
             } // fin ... clave

        if($unaedad != ""){
     
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
     
             } // fin ... edad
        
        if($unperfil != ""){
     
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
     
             } // fin ... perfil
        
    if($unnombre != ""){
     
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
        

        } // fin ... nombre

    }

         if($flag == 0){

            // solo imagen y email obligatorios

// creo el usuario modificado

        $target = new UsuarioMod($hecho->getnombre(),$hecho->getemail(),$hecho->getperfil(),$hecho->getedad(),$hecho->getclave(),$archivoTmp);

        // ver el array search, si te parece

        // funca        

        $point = array_search($hecho,$users);

        array_splice($users,$point,1,array($target));

        // hay que decirle que el reemplazo es un objeto con array()

        foreach ($users as $key => $value) {

            if($value instanceof UsuarioMod){
                
                $losnuevos[] = new UsuarioMod($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave(),$value->getimagen());
            }else {
                $losnuevos[] = new Usuario($value->getnombre(),$value->getemail(),$value->getperfil(),$value->getedad(),$value->getclave());
            }
            
        }
        echo "Usuario modificado actualizado";
        }// cierra el else de email e imagen

        //siempre actualizo el archivo txt

       /* $ar = fopen("archivos/usuarios.txt", "w");
				
        //ESCRIBO EN EL ARCHIVO
        
        foreach ($losnuevos as $key => $value) {
            
            fwrite($ar, $value->Mostrar()."\r\n");		
        }
	
		//CIERRO EL ARCHIVO
        fclose($ar);*/
              
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