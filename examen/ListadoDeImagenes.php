<?php


class TablaImagenes extends Tabla
{

    // por post no las puedo ver

    // las probé por get y andan

    // helados cargados y borrados

    public static function TablaImg($elestado){

        if(trim($elestado) == "cargadas" || trim($elestado) == "borradas"){

            
        }else{
            var_dump($elestado);
            echo "instrucción inválida, comuníquese con su creador";
            return false;
        }

        echo "<table border='2px' solid>";

    echo "<caption>Imagenes $elestado </caption>";

    echo "<thead>";

    echo "<th>Imágen</th>";
    
    echo "</thead>";

    echo "<tbody>";

        if(trim($elestado) == "cargadas"){

            $freeze = HeladoModificado::TraerTodosLosHelados();
          

            foreach ($freeze as $key => $value) {
                           
                if($value instanceof HeladoModificado)
                {                
                    echo "<tr>";
                    echo "<td><img heigth='200px' width='200px' src= 'ImagenesDeHelados/".$value->getimagen() . "' alt='noimghela.mig'></td>";

                    echo "</tr>";

                }
            }

            

        }else {
            if($elestado == "borradas"){

                $datos = fopen("backUpFotos/info.txt","r");

                while(!feof($datos))
                {
                    $value = fgets($datos);
                    if(trim($value)!= ""){
                        
                echo "<tr>";
                echo "<td><img heigth='200px' width='200px' src= 'backUpFotos/".trim($value) . "' alt='noimg.mig'></td>";
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