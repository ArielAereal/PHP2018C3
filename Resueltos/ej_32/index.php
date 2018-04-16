<?php

echo '<form action="index.php" method="POST">';

echo '<fieldset>';


echo '<legend>Un rectángulo AQUÍ Y AHORA</legend>';
echo '<label for="txtbase">Base: ';
    echo '<input type="number" name="base" id="txtbase">';    
    echo '</label>';

    echo '<label for="txtaltura">Altura: ';
    echo '<input type="number" name="altura" id="txtaltura">';    
    echo '</label><br>';

    echo '<input type="radio" name="tipo" value="superficie">Superficie<br>';
    echo '<input type="radio" name= "tipo" value="perimetro">Perimetro<br>';


echo '<input type="submit" value="Calcular" >';



echo '</fieldset>';

echo '</form>';


if(count($_POST)!= 0){

    $base = $_POST['base'];
    $altura = $_POST['altura'];

    if($_POST['tipo']!= null){

        if($_POST['tipo']== "superficie"){
            
            
            echo "La superficie es: " . $base * $altura;
        } else{
            echo "El perimetro es : " . (2 * $base + 2 * $altura);
        }
    }
}


echo '<form action="resultado.php" method="POST">';

echo '<fieldset>';


echo '<legend>Un rectángulo EN SU LUGAR</legend>';
echo '<label for="txtbase">Base: ';
    echo '<input type="number" name="base" id="txtbase">';    
    echo '</label>';

    echo '<label for="txtaltura">Altura: ';
    echo '<input type="number" name="altura" id="txtaltura">';    
    echo '</label><br>';

    echo '<input type="radio" name="tipo" value="superficie">Superficie<br>';
    echo '<input type="radio" name= "tipo" value="perimetro">Perimetro<br>';


echo '<input type="submit" value="Calcular" >';



echo '</fieldset>';

echo '</form>';
?>