<?php

require_once ("entidades/alumno.php");
require_once ("entidades/archivo.php");

//ver el $_GET['queHago'];

if(isset($_GET['queHago'])){
	// armar el listado
}

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

switch($queHago){


	case "Subir":

	$p = new Alumno($_POST['nombre'],$_POST['legajo']);
	
	var_dump($p);
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
	

		/*
		$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
		$archivo = $res["PathTemporal"];
*/
	//	$p = new Producto($codBarra, $nombre, $archivo);
		
	
	
		var_dump($p);

		// guardar en el archivo
		break;
		
	case "eliminar":
		$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
	
		if(!Producto::Eliminar($codBarra)){
			$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$mensaje = "El archivo fue escrito correctamente. PRODUCTO eliminado CORRECTAMENTE!!!";
		}
	
		echo $mensaje;
		
		break;
		
	default:
		echo ":(";
}
?>