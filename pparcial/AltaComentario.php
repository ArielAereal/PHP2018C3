<?php

class Comentario{

private $email;

private $titulo;

private $comentario;

public function __construct($mail,$title,$comment){

$this->email = $mail;

$this->titulo = $title;

$this->comentario = $comment;

}

public function getemail(){
    return $this->email;
}

public function setemail($elemail){
    $this->email = $elemail;
}

public function gettitulo(){
    return $this->titulo;
}

public function settitulo($eltitulo){
    $this->titulo = $eltitulo;
}

public function getcomentario(){
    return $this->comentario;
}

public function setcomentario($elcomentario){
    $this->comentario = $elcomentario;
}


public static function SubirComentario($mail,$title,$comment){

$users = Usuario::TraerTodosLosUsuarios();


$flag = 0;

foreach ($users as $key => $value) {
        
    if ($value->getemail() === $mail){
        $flag = 1;
    }

}

if($flag == 1){

    $ar = fopen("archivos/Comentarios.txt", "a");
		
		
    //ESCRIBO EN EL ARCHIVO

    $todo = $title . "-" . $comment;

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

}// Subir Comentario



// OK

public static function TraerTodosLosComentarios(){
  
    $ListaDeComentariosLeidos = array();

    $conesion = Comentario::TituloMail();

    $titulosencontrados = array();

    $mailsencontrados = array();

    // recorro el mismo archivo, con y sin fotos

   $archivo=fopen("archivos/Comentarios.txt","r");

   
   for ($i=0; $i < count($conesion) ; $i++) { 
       
       if($i%2 == 0){
           $titulosencontrados[] = $conesion[$i];
        }else{
            $mailsencontrados[] = $conesion[$i];
        }
        
    } 

  
  //var_dump($mailsencontrados);

    while(!feof($archivo))
    {

        
        $archAux = fgets($archivo);
        $comentarios = explode("-",$archAux);     
       
        $email ="";
        $titulo ="";
        $comentario = "";               
        $laimagen = "";       
        
        // 3 caracteres fantasmas 

        // problema con el primer objeto del array

        for ($j=0; $j <count($titulosencontrados) ; $j++) { 

            $tit = str_replace(' ', '',$comentarios[0]); // Replaces all spaces.
            $alt = str_replace(' ', '',$titulosencontrados[$j]); // Replaces all spaces.
            //$alt = preg_replace('/[^A-Za-z0-9\-]/','',$titulosencontrados[$j]);          
            
            //$tit = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $comentarios[0]);
            //preg_replace('/[^A-Za-z0-9\-]/', '', $tit); // Removes special chars.
            //$er = $tit;

            //var_dump($er);

            //var_dump(strcmp($tit,$alt));
            //if()


            // hay tres caracteres fantasmas
            if($j == 0)
            {
                $tituloparch = $titulosencontrados[0] . "   ";

                $tituloparch = trim($tituloparch);
                //var_dump($tituloparch);

                // al principio del archivo de texto aparecen 3 caracteres invisibles
                // reflejados en el lenght del primer string

                // con la opción similar text reduzco la posibilidad de error
                // cuando el título es mayor a 12 caracteres

                similar_text($tituloparch,$comentarios[0],$per);

               if($per> 70){
                $email = $mailsencontrados[0];                        
               }                               
            
            }


           if((strcmp($tit,$alt)== 0))
            {    
           //     echo $j;
                if(isset($mailsencontrados[$j])) 
                $email = $mailsencontrados[$j];                     
            }
        }
          $titulo =  $comentarios[0];
            //comentario
            if(isset($comentarios[1])){

                $comentario = $comentarios[1];
            }else {
                break;
            }
            //foto
            if(isset($comentarios[2])){

                $laimagen =  $comentarios[2];                
                $elcomentario = new ComentarioImagen($email,$titulo,$comentario,$laimagen);                       
                $ListaDeComentariosLeidos[] = $elcomentario;    
                }else {
                    
                    $elcomentario = new Comentario($email,$titulo,$comentario);            
                        $comentarios[0] = trim($comentarios[0]);
                        if($comentarios[0] != ""){
                                
                            $ListaDeComentariosLeidos[] = $elcomentario;
                }
                
                
            }
    }

fclose($archivo);  
echo "<pre>";
//var_dump($ListaDeComentariosLeidos);
echo "</pre>";
return $ListaDeComentariosLeidos;       

}// Traer todos
    
public static function TituloMail(){

//METODO APARTE PARA COMPARAR NOMBRES Y COMENTARIOS

$ColeccionTituloMail = array();

$link = fopen("archivos/houner.txt","r");

while(!feof($link))
    {
        $archAux = fgets($link);
        $ust = explode("-",$archAux);    
       
        foreach ($ust as $key => $value) {                            
            
            
            if ($value!= "")
            {
               
                $ColeccionTituloMail[] = $value;         

            }



            
        }

        
        
    }

   // var_dump($ColeccionTituloMail);
        
        fclose($link);
        
     return $ColeccionTituloMail;
}



}// Comentario
?>