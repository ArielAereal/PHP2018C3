<?php

class ComentarioImagen extends Comentario
{
    private $imagen;

    public function __construct($mail,$title,$comment,$image=""){

        parent::__construct($mail,$title,$comment);

        if($image != ""){

            $this->imagen = $image;
        }

    }

    public function getimagen(){
        return $this->imagen;
    }
    
    public function setimagen($elimagen){
        $this->imagen = $elimagen;
    }



    public static function SubirComentario($mail,$title,$comment,$image){
        
        $users = Usuario::TraerTodosLosUsuarios();


        $flag = 0;

        foreach ($users as $key => $value) {
        
            if ($value->getemail() === $mail){
                $flag = 1;
                                             }

                                            }

        if($flag == 1){

             if(!file_exists("archivos/ImagenesDeComentarios")){
                 mkdir("archivos/ImagenesDeComentarios");
                                                                }

        $archivoTmp = "$title" . ".". pathinfo($image["name"],PATHINFO_EXTENSION);

         $destino = "archivos/ImagenesDeComentarios/" . $archivoTmp;

    //$esImagen = getimagesize($image["tmp_name"]);

        if (!move_uploaded_file($image["tmp_name"], $destino)) {
             echo "subida mala";
             return false;
                 }

    $ar = fopen("archivos/Comentarios.txt", "a");
		
		
    //ESCRIBO EN EL ARCHIVO

    $todo = $title . "-" . $comment . "-" . $archivoTmp;

    //var_dump($todo);

    fwrite($ar, $todo."\r\n");		

    //CIERRO EL ARCHIVO
    fclose($ar);		

    // necesito saber quién escribió el comentario (punto 5)

    $chivo = fopen("archivos/houner.txt","a");


    $usco = $title . "-" . $mail;

    fwrite($chivo,$usco . "\r\n");

    fclose($chivo);

    echo "comentario añadido exitosamente";

} else {

    echo "usuario no cargado";
}
      

}
    
    


}




?>