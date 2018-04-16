<?php

if(count($_POST)!= 0){

    // alta línea, loco
    error_reporting(E_ALL ^ E_NOTICE);
    

    var_dump($_POST);

    /*foreach ($_POST as $key => $value) {
        
        switch ($variable) {
            case 'value':
                # code...
                break;
            
            default:
                # code...
                break;
        }

    }*/

}



 echo '<form action="index.php" method="POST">';

 echo '<fieldset ><legend>Destinos del mes de Agosto</legend>';
 echo '<select name="selector" id="selec">';
 echo '<option value="rio de janeiro" name="selector">Río de Janeiro</option>';
 echo '<option value="100-154-238" name="selector">Punta del Este</option>';
 echo '<option value="255-168-253" name="selector">La Habana</option>';
 echo '<option value="1-168-253" name="selector">Miami</option>';
 echo '<option value="253-255-38" name="selector">Ibiza</option>'; 
 echo '</select>';
 echo '<input type="submit" value="Consultar Precio">';
 echo '</fieldset>';

echo '</form>';





?>