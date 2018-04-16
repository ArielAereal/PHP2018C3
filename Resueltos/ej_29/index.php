<?php


echo '<form action="index.php" method="POST">';
echo '<fieldset ><legend>Formulario Select</legend>';
echo '<select name="selector" id="selec">';
echo '<option value="138-120-182" name="selector">Violeta</option>';
echo '<option value="100-154-238" name="selector">Celeste</option>';
echo '<option value="255-168-253" name="selector">Rosa</option>';
echo '<option value="1-168-253" name="selector">Turquesa</option>';
echo '<option value="253-255-38" name="selector">Amarillo</option>';
echo '<option value="73-71-191" name="selector">Azul</option>';
echo '</select>';
echo '<input type="submit" value="Cambiar Color">';
echo '</fieldset>';
echo '</form>';

$archivo = fopen("misArchivos/datos.txt","w");

if(count($_POST)!= 0){


fwrite($archivo,$_POST['selector']);

fclose($archivo);

$color =  fopen("misArchivos/datos.txt","r");

$rgb = fread($color,filesize("misArchivos/datos.txt"));

$datos3 = array();


$datos3 = explode("-",$rgb);

pasarcolor($datos3);

}
function pasarcolor($datos){

    $rojo = $datos[0];

    $verde = $datos[1];

    $azul = $datos[2];      
    

    echo '<style>body{background: rgb('.$rojo.','.$verde.','.$azul.');}</style>';

}

?>


