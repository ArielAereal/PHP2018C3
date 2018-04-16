<?php

echo '<form action="index.php" method="POST">';

echo '<fieldset>';


echo '<legend>Superficie de un rectángulo AQUÍ Y AHORA</legend>';
echo '<label for="txtbase">Base: ';
    echo '<input type="number" name="base" id="txtbase">';    
    echo '</label>';

    echo '<label for="txtaltura">Altura: ';
    echo '<input type="number" name="altura" id="txtaltura">';    
    echo '</label>';

echo '<input type="submit" value="Calcular" >';

echo '</fieldset>';

echo '</form>';


if(count($_POST)!= 0){

    $base = $_POST['base'];
    $altura = $_POST['altura'];

    echo "La superficie es: " . $base * $altura;
}

echo '<form action="superficie.php" method="POST">';

echo '<fieldset>';


echo '<legend>Superficie de un rectángulo DONDE CORRESPONDE</legend>';
echo '<label for="txtbase">Base: ';
    echo '<input type="number" name="base" id="txtbase">';    
    echo '</label>';

    echo '<label for="txtaltura">Altura: ';
    echo '<input type="number" name="altura" id="txtaltura">';    
    echo '</label>';

echo '<input type="submit" value="Calcular" >';

echo '</fieldset>';

echo '</form>';
?>