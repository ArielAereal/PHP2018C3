<?php

/*if (isset($_POST['domicilio']){
ver esto
}*/

//var_dump($_POST);

//var_dump($_FILES);

$destino = "archivos/".$_FILES['archivo']['name'];

//echo $destino;

// EL metodo



// file exists
if(!file_exists("archivos"))
{
    mkdir("archivos");
}
move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);

//$arraynombre = array();

$arraynombre = explode(".",$destino);

//var_dump($arraynombre);

$estension = array_pop($arraynombre);

var_dump($estension);


$tipodearchivo = pathinfo($_FILES['archivo']['name'],PATHINFO_EXTENSION);

var_dump($tipodearchivo);
?>