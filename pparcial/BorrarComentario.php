<?php


class ComentarioBorrado extends ComentarioImagen
{

public static function Borrado ($unperfil,$untitulo){    

    // debe recibir los datos de un usuario de perfil “admin”
    // "los datos" es muy genérico

    // sino le pido el email, traigo los usuarios y verifico el perfil
    if($unperfil == "admin")
    {

        $loscometas = ComentarioBorrado::TraerTodosLosComentarios();
        $el = "";
        $point;
        $flag = 0;

        foreach ($loscometas as $key => $value) {

            if ($flag == 0){

                similar_text(trim($untitulo),trim($value->gettitulo()),$per);
    
                if($per> 70){
                 $el= $value;
                }
                $flag++;
            }
            
            if (trim($untitulo) === trim($value->gettitulo()) )
            {
                $el = $value;
            }



        }

        if ($el != ""){

            if($el instanceof ComentarioImagen)
            {
          
            if(!file_exists("archivos/backUpFotos")){
                mkdir("archivos/backUpFotos");
            }

            $ext =  pathinfo($el->getimagen(),PATHINFO_EXTENSION);          

            $eras = date("Y-m-d-H-i-s") . "." . $ext;

            $eras = trim($eras);
            // ojo con el valioso TRIM
            $nam = trim($el->getimagen());            

            copy("archivos/ImagenesDeComentarios/".$nam,"archivos/backUpFotos/".$eras);
          
            $ar = fopen("archivos/backUpFotos/info.txt", "a");
		
		    //ESCRIBO EN EL ARCHIVO
            fwrite($ar, $eras."\r\n");		
        
            //CIERRO EL ARCHIVO
            fclose($ar);		
            
            $tierra = getcwd();

		// Permission denied
		chdir("archivos/ImagenesDeComentarios");

        chown(trim($el->getimagen()),465);
        
		unlink(trim($el->getimagen()));
		
		//ABRO EL ARCHIVO

		chdir($tierra);
        
        } else {
            echo "comentario sin imagen";
        }

        // borrrarrr el comentarios


        $point = array_search($el,$loscometas);

        array_splice($loscometas,$point,1);
             
        $arch = fopen("archivos/Comentarios.txt", "w");
        $chivo = fopen("archivos/houner.txt","w");

        foreach ($loscometas as $key => $value) {
            
            if($value instanceof ComentarioImagen){

                $todo = $value->gettitulo() . "-" . $value->getcomentario() . "-" . $value->getimagen();
            }
            else {
                $todo = $value->gettitulo() . "-" . $value->getcomentario();
            }
            
            $usco = $value->gettitulo(). "-" . $value->getemail();
            //ESCRIBO EN EL ARCHIVO
            fwrite($arch, $todo."\r\n");		
    
            fwrite($chivo,$usco . "\r\n");

        }
        
        //CIERRO EL ARCHIVO
        fclose($arch);		
		    
        fclose($chivo);

        echo "Comentario eliminado";

    }else {

    echo "No hemos podido procesar su solicitud";

    }





}



} // Borrado


}



?>