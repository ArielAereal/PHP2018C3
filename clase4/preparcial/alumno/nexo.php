<?php

require_once ("entidades/alumno.php");
require_once ("entidades/archivo.php");

if(isset($_GET['queHago'])){
	// armar el listado
}

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

switch($queHago){


	case "Subir":

	$p = new Alumno($_POST['nombre'],$_POST['legajo']);
	
//	var_dump($p);
	$fotoname = $p->getNombre().$p->getlegajo();
	$respuestaDeSubir = Archivo::Subir($fotoname);
	
	if(!$respuestaDeSubir["Exito"]){
		echo "error " .$respuestaDeSubir["Mensaje"];
		break;
	}
	$archivo = $respuestaDeSubir["PathTemporal"];
	echo "Bien " ;
	
	$p->establecerfoto($archivo);

	if(!Alumno::Guardar($p)){
		echo "Error al generar archivo";
		break;
	}
	

	//		var_dump($p);

		// guardar en el archivo
		break;
		
	case "eliminar":

	// si el legajo viene, ok, si no, el legajo es null

		$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
	
		if(!Alumno::Eliminar($legajo)){
			$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$mensaje = "El archivo fue escrito correctamente. ALUMNO eliminado CORRECTAMENTE!!!";
		}
	
		echo $mensaje;
		
		break;
		
	default:
		echo ":(";
}
?>