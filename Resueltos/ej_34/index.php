<?php

if(count($_POST)!= 0){


    // alta línea, loco
    error_reporting(E_ALL ^ E_NOTICE);
    

   // var_dump($_POST);

    $dia = date("d");

    $mes = date("m");

    $año = date("Y");

    if($_POST['dia']!= null)
    {

        if($_POST['dia'] === "dia")
        {
            echo $dia."/";
        }
    }

    if($_POST['mes'] === "mes")
    {
        echo $mes."/";
    }
    if($_POST['año'] === "año")
    {
        echo $año;
    }

    
    



    
}



 echo '<form action="index.php" method="POST">';


echo '<fieldset>';


echo '<legend>Fecha oculta</legend>';
echo '<label for="txtpass1">Día ';
    echo '<input type="checkbox" name="dia" id="txtdia" value="dia">';    
    echo '</label>';

    echo '<label for="txtmes">Mes ';
    echo '<input type="checkbox" name="mes" id="txtmes" value="mes">';    
    echo '</label>';

    echo '<label for="txtaño">Año ';
    echo '<input type="checkbox" name="año" id="txtaño" value="año">';    
    echo '</label><br>';
    
echo '<input type="submit">';



echo '</fieldset>';

echo '</form>';





?>