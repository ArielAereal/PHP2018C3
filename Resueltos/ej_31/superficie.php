<?php

if(count($_POST)!= 0){

    $base = $_POST['base'];
    $altura = $_POST['altura'];

    echo "La superficie es: " . $base * $altura;

    echo '<a href="index.php"> Volver </a>';
}

?>