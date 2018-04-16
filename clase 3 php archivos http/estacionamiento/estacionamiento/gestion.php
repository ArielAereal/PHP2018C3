<?php
include "clases/vehiculo.php";
require "clases/estacionamiento.php";

$patente=$_POST['patente'];
$accion=$_POST['estacionar'];

if($accion=="ingreso")
{
// crea un vehiculo y lo guarda
	//estacionamiento::Guardar($patente);
	$unauto = new Vehiculo("fef564",date("Y-m-d H:i:s"));

	$unauto->Estacionar();

}
else
{
	// saca un vehiculo
	estacionamiento::Sacar($patente);

		//var_dump($datos);
}

header("location:index.php");
?>
