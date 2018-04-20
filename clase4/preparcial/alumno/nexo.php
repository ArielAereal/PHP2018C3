<?php



require_once ("entidades/alumno.php");
require_once ("entidades/archivo.php");

if(isset($_GET['queHago'])){
	// armar el listado
	$queHago = isset($_GET['queHago']) ? $_GET['queHago'] : NULL;

	if($queHago == "listado"){

		$datos = Alumno::TraerTodosLosAlumnos();
		
		
		chdir("../archivos/fotos");
		
		

		echo "<table border='2px' solid>";

		echo "<caption>Tabla de Ganadores</caption>";

		echo "<thead>";

		echo "<tr>";

		echo "<th>Legajo</th>";

		echo "<th>Nombre</th>";

		echo "<th>Rostro</th>";

		echo "</tr>";

		echo "</thead>";

		echo "<tbody>";

		foreach ($datos as $key => $value) {
			
			echo "<tr>";

		echo "<td>".$value->getlegajo()."</td>";

		echo "<td>".$value->getnombre()."</td>";
	
		echo '<td><img height="70px" width="100px" src="http://localhost/prog\preparcial\archivos\fotos/'.$value->getfoto().'"></td>';

		echo "</tr>";
		
			
		}

		echo "</tbody>";


		echo "</table>";

	}else{

		echo "No pudimos procesar su solicitud";
	}

} else {

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

		case "modificar":
			
			$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
			$foto = isset($_POST['archivo']) ? $_POST['archivo'] : NULL;

			$amod = new Alumno($nombre,$legajo);

			// problema con la foto nueva
			$fotoname = $amod->getNombre().$amod->getlegajo();
			$respuestaDeSubir = Archivo::Subir($fotoname);
	
	if(!$respuestaDeSubir["Exito"]){
		echo "error " .$respuestaDeSubir["Mensaje"];
		break;
	}
	$archivo = $respuestaDeSubir["PathTemporal"];
	echo "Bien " ;


			$amod->establecerfoto($archivo);

		
		if(!Alumno::Modificar($amod)){
			$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$mensaje = "El archivo fue escrito correctamente. ALUMNO modificado CORRECTAMENTE!!!";
		}
	
		echo $mensaje;
		
		break;
		
	default:
		echo ":(";

	}

}
?>




