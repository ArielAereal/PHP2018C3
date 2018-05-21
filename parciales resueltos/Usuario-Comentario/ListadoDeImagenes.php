<?php


class TablaImagenes extends Tabla
{

    // por post no las puedo ver

    // las probé por get y andan

    public static function TablaImg($elestado){

        echo "<table border='2px' solid>";

    echo "<caption>Imagenes $elestado </caption>";

    echo "<thead>";

    echo "<th>Imágen</th>";
    
    echo "</thead>";

    echo "<tbody>";

        if($elestado == "cargadas"){

            $comz = ComentarioImagen::TraerTodosLosComentarios();

          

            foreach ($comz as $key => $value) {
            
                

                if($value instanceof ComentarioImagen)
                {                
                    echo "<tr>";
                    echo "<td><img heigth='200px' width='200px' src= 'archivos/ImagenesDeComentarios/".$value->getimagen() . "' alt='noimg.mig'></td>";

                    echo "</tr>";

                }
            }

            

        }else {
            if($elestado == "borradas"){

                $datos = fopen("archivos/backUpFotos/info.txt","r");

                while(!feof($datos))
                {
                    $value = fgets($datos);
                    if(trim($value)!= ""){
                        
                echo "<tr>";
                echo "<td><img heigth='200px' width='200px' src= 'archivos/backUpFotos/".trim($value) . "' alt='noimg.mig'></td>";
                echo "</tr>";

                    }
                }
            }
        }


    

        


    echo "</tbody>";

    echo "</table>";


    }

}







?>