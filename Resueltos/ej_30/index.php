<?php

echo '<form action="index.php" method="POST">';

echo '<fieldset >';


echo '<legend>Tabla</legend>';
echo '<label for="slcfila">Filas: ';
    echo '<select name="fila" id="slcfila">';
    for ($k=1; $k <51 ; $k++) { 
        echo '<option value="'.$k.'">'.$k.'</option>';
    }

    
    echo '</select>';
    echo '</label>';

echo '<label for="slccolumna">Columnas: ';
    echo '<select name="columna" id="slccolumna">';
    for ($l=1; $l < 51 ; $l++) { 
        
        echo '<option value="'.$l.'">'.$l.'</option>';
    }
    
    
    
    echo '</select>';
echo '</label>';

echo '<input type="submit" value="Generar Tabla">';

echo '</fieldset>';

echo '</form>';

$contenido=1;

if(count($_POST)!= 0)
{
    echo "<table border='2px' solid>";
    
    $fila = $_POST["fila"];
    $columna = $_POST["columna"];



    for ($i=0; $i < $fila; $i++) { 
        
        echo "<tr>";
        for ($j=0; $j < $columna; $j++) { 
            echo "<td>$contenido</td>";
            $contenido ++;
        }
        echo "</tr>";
    }

    echo "</table>";
}

?>