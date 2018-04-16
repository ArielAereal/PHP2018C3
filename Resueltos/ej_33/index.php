<?php

if(count($_POST)!= 0){

    $contra = $_POST['pass1'];
    $seña = $_POST['pass2'];
    


    if($contra === $seña){
        header("Location: http://localhost/prog/ej_33/welcome.php");
        die();        
    }
    
}



 echo '<form action="index.php" method="POST">';


echo '<fieldset>';


echo '<legend>Contraseña requerida</legend>';
echo '<label for="txtpass1">Contraseña ';
    echo '<input type="password" name="pass1" id="txtpass1">';    
    echo '</label>';

    echo '<label for="txtpass2">Repetir contraseña ';
    echo '<input type="password" name="pass2" id="txtpass2">';    
    echo '</label><br>';
    
echo '<input type="submit">';



echo '</fieldset>';

echo '</form>';





?>