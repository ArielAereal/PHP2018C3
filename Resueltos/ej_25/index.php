<?php

// abro el archivo
$archivo = fopen("misArchivos/palabras.txt","r+");
$aus = fopen("misArchivos/extra.txt","w+");

// leo el archivo
$todo = fread($archivo,filesize("misArchivos/palabras.txt"));

// probando trim, sirve
/*
function trim_value(&$value) 
{ 
    $value = trim($value); 
}*/

//$cadena = eregi_replace(“[\n|\r|\n\r]”, ‘ ‘, $cadena);NO ANDA
$split = array();

$split = fread($aus,filesize("misArchivos/palabras.txt"));
$split = explode("\n",$todo);
$arraypulido = array();
foreach ($split as $key => $value) {
    
    array_push($arraypulido,trim($value));
    
}

$arrayfinal = array();  

foreach ($arraypulido as $key => $value) {
    array_push($arrayfinal,explode(" ",$value));
}




foreach ($arrayfinal as $key => $value) {
    
    foreach ($value as $llave => $valor) {


        fwrite($aus,$valor." ");        
    }

}
fclose($archivo);
fclose($aus);

$ref = fopen("misArchivos/extra.txt","r");
$estrin = fread($ref,filesize("misArchivos/extra.txt"));

$arr = array();

$arr = explode(" ",$estrin);

// ACCION

$de1 = 0;
$de2 = 0;
$de3 = 0;
$de4 = 0;
$demas = 0;

foreach ($arr as $key => $value) {
    
    if($value != "")
    {
        switch (strlen($value)) {
            case '1':
            
                    $de1++;
                break;

            case '2':
                    $de2++;
                break;

            case '3':
                    $de3++;
                break;
            
            case '4':
                    $de4++;
                break;

            default:
                    $demas++;
            
                break;
        }
        
    }
}

echo "<pre><br>";

echo "Informe del conteo de letras del archivo 'palabras'<br><br>"; 
echo "Una letra: ".$de1."<br>";
echo "Dos letras: ".$de2."<br>";
echo "Tres letras: ".$de3."<br>";
echo "Cuatro letras: ".$de4."<br>";
echo "Más de Cuatro letras: ".$demas."<br>";

echo "<br><br><br><br> El fragmento: <br><br>" . $todo;
echo "</pre>";

?>