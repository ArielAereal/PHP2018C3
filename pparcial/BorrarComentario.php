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

        /*similar_text($tituloparch,$comentarios[0],$per);

        if($per> 70){
         $email = $mailsencontrados[0];                        
        }*/

        foreach ($loscometas as $key => $value) {
            
            if ($untitulo === $value->gettitulo() )
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

            $el->getimagen();

            $eras = date("Y-m-d-H-i-s");

            copy("archivos/ImagenesDeComentarios/".$el->getimagen(),"archivos/backUpFotos/".$eras);

            $ar = fopen("archivos/backUpFotos/info.txt", "a");
		
		    //ESCRIBO EN EL ARCHIVO
            fwrite($ar, $eras."\r\n");		
        
            //CIERRO EL ARCHIVO
            fclose($ar);		
            
            // ver unlink para la foto
        
        } else {
            echo "comentario sin imagen";
        }

        // borrrarrr el comentarios


        $point = array_search($el,$loscometas);

        array_splice($loscometas,$point,1);

        echo "<pre>";
        var_dump($loscometas);
        echo "</pre>";
        
     /*   $arch = fopen("archivos/Comentarios.txt", "w");
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
		    
        fclose($chivo);*/

    }else {

    echo "No hemos podido procesar su solicitud";

    }





}



} // Borrado


}



?>