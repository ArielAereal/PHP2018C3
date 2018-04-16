<?php

if(count($_POST)!= 0){


    $base = $_POST['base'];
    $altura = $_POST['altura'];

    if($_POST['tipo']!= null){

        if($_POST['tipo']== "superficie"){
            
            
            echo "La superficie es: " . $base * $altura;
        } else{
            echo "El perimetro es : " . (2 * $base + 2 * $altura)."<br><br>";
        }
    }
}

echo '<a href="index.php"> Volver </a>';


?>