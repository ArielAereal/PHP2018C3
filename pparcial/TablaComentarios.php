<?php


class Tabla{


    public static function GenerarTabla($usuario ="",$titulo = ""){

echo "<table border='2px' solid>";

echo "<thead>";

echo "<th>Imágen</th>";

echo "<th>Título</th>";

echo "<th>Comentario</th>";

echo "<th>Nombre</th>";

echo "<th>Edad</th>";

echo "</thead>";

echo "<tbody>";

$users = Usuario::TraerTodosLosUsuarios();

$comentz = ComentarioImagen::TraerTodosLosComentarios();

// viene bien
//var_dump($comentz);

    if($usuario!=""){
        
        if($titulo!= ""){

            // con tutti

            $emailf = "";
            $edadf;        

            $comentariof = "";
            $imagenf = "";
    
            //$usuario;
            // $titulo;            
    
            foreach ($users as $key => $value){
    
                if(trim($usuario) === trim($value->getnombre()))
                    {               
                   $emailf = $value->getemail();
                   $edadf = $value->getedad();
                   break;
                    }
        
    
                                                }
                                                
                if ($emailf == ""){
    
                    echo $usuario . "-" . $titulo . " no corresponden";            
                    }
                    
    
            foreach ($comentz as $key => $value) {   

                    if($emailf === trim($value->getemail())){
                                   
                        $comentariof = $value->getcomentario();
        
                        if($value instanceof ComentarioImagen){
                            $imagenf = $value->getimagen();
                        }
                        break;
                    }
    
                
                } 
                                             
    
    
                if ($comentariof == ""){
    
                echo $titulo . " es un titulo desconocido para el usuario";            
                }
                
    
            // tabla titulo y usuario
            
                     echo "<tr >";
    
                    if($imagenf != ""){
                
                        echo "<td ><img height = '200px' width='200px' src='archivos/ImagenesDeComentarios/".$imagenf."' alt='imagencomment.punk'></td>";            
                    }else {
                        echo "<td ><img height = '200px' width='200px' src='archivos/ImagenesDeComentarios/#' alt='imagencomment.punk'></td>";    
                    }
                
                    echo "<td >".$titulo."</td>";
                    echo "<td >".$comentariof."</td>";
                                         
                    echo "<td >".$usuario."</td>";
                    echo "<td >".$edadf."</td>";
                
                            echo "</tr>";          

                        }else{

                       
      // con usuario sin titulo

        $nombref;
        $emailf = "";
        $edadf; 
        
       $listadecomentariosf = array();
       
        $imagenf = "";
        $comentariof;
        $titulof;

        foreach ($users as $key => $value) {

            if(trim($usuario) === trim($value->getnombre()))
                {
               $emailf = $value->getemail();
               $nombref = $value->getnombre();
               $edadf = $value->getedad();
               break;
                }
    

                                            }
         
        if($emailf == ""){
            echo "Usuario desconocido";            
        }else{

            foreach ($comentz as $key => $value) {
                
                if(trim($emailf) === trim($value->getemail()))
                {
                 $comentariof = $value->getcomentario();
                 $titulof = $value->gettitulo();

                 if($value instanceof ComentarioImagen)
                 {
                     $imagenf = $value->getimagen();
                     $listadecomentariosf[] = new ComentarioImagen($emailf,$titulof,$comentariof,$imagenf);
                 }else{
                     $imagenf = "";

                     $listadecomentariosf[] = new Comentario($emailf,$titulof,$comentariof);
                 }


                }
            }
            
        }              

        // tabla f
        
        foreach ($listadecomentariosf as $key => $value) {

            echo "<tr >";
            
                if($value instanceof ComentarioImagen){
            
                    echo "<td ><img height = '200px' width='200px' src='archivos/ImagenesDeComentarios/".$value->getimagen()."' alt='imagencomment.punk'></td>";            
                }else {
                    echo "<td ><img height = '200px' width='200px' src='archivos/ImagenesDeComentarios/#' alt='imagencomment.punk'></td>";    
                }
            
                echo "<td >".$value->gettitulo()."</td>";
                echo "<td >".$value->getcomentario()."</td>";
            
                foreach ($users as $clave => $valor) {
                    
                    
                    if( trim($value->getemail()) === trim($valor->getemail())){
                        
                        echo "<td >".$valor->getnombre()."</td>";
                        echo "<td >".$valor->getedad()."</td>";
            
                        echo "</tr>";
            
                    }
                }
            
                }
                        echo "</tbody>";
                        echo "</table>";

                        $check++;




    
}

}else if($titulo != "" && $usuario == ""){
    
        // tengo parametro $titulo;
        //sin usuario con titulo
        $emailf = "";
        $comentariof;
        $imagenf = "";

        $nombref;
        $edadf;        
   
        $flag = 0;


        foreach ($comentz as $key => $value) {

            if ($flag == 0){              

                similar_text(trim($value->gettitulo()),$titulo,$res);

                
                if($res > 70){
                    $emailf = $value->getemail();                  
                    $comentariof = $value->getcomentario();
    
                    if($value instanceof ComentarioImagen){
                        $imagenf = $value->getimagen();
                    }
                    
                }
                
                $flag++;
            } 
            
      
         

           if(trim($titulo) === trim($value->gettitulo())){

                $emailf = $value->getemail();
                $comentariof = $value->getcomentario();

                if($value instanceof ComentarioImagen){
                    $imagenf = $value->getimagen();
                }
                break;
            }
                                            }


            if ($emailf == ""){

            echo $titulo . "es un titulo desconocido";            
            }

                       
        foreach ($users as $key => $value) {

            if(trim($emailf) === trim($value->getemail()))
                {               
               $nombref = $value->getnombre();
               $edadf = $value->getedad();
               break;
                }
                      

            }
        // tabla titulo solo
        
                 echo "<tr >";

                if($imagenf != ""){
            
                    echo "<td ><img height = '200px' width='200px' src='archivos/ImagenesDeComentarios/".$imagenf."' alt='imagencomment.punk'></td>";            
                }else {
                    echo "<td ><img height = '200px' width='200px' src='archivos/ImagenesDeComentarios/#' alt='imagencomment.punk'></td>";    
                }
            
                echo "<td >".$titulo."</td>";
                echo "<td >".$comentariof."</td>";
                                     
                echo "<td >".$nombref."</td>";
                echo "<td >".$edadf."</td>";
            
                        echo "</tr>";           

                             

    //sin usuario y con titulo

    }else if ($usuario == "" && $titulo == "") {

        // tabla sin filtros     

      $flag = 0;




foreach ($comentz as $key => $value) {

    
echo "<tr >";


    if($value instanceof ComentarioImagen){

        echo "<td ><img height = '200px' width='200px' src='archivos/ImagenesDeComentarios/".$value->getimagen()."' alt='imagencomment.punk'></td>";            
    }else {
        echo "<td ><img height = '200px' width='200px' src='archivos/ImagenesDeComentarios/#' alt='imagencomment.punk'></td>";    
    }

    echo "<td >".$value->gettitulo()."</td>";
    echo "<td >".$value->getcomentario()."</td>";

     foreach ($users as $clave => $valor) {
       
        if( trim($value->getemail()) === trim($valor->getemail())){
            
            echo "<td >".$valor->getnombre()."</td>";
            echo "<td >".$valor->getedad()."</td>";

            echo "</tr>";

        }
    }

    }
    

} // sin filtros

echo "</tbody>";
echo "</table>";
 
    } // generar tabla



}// tabla



?>