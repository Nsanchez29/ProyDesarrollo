<?php
require_once "../config/conexion.php";

	
	$id = $_POST['sillasId'];
	$sillas = $_POST['sillasUpdate'];

	echo $id;
	echo $sillas;


	/*$consulta = "SELECT max(numero) as Num from mesas";
	$q = mysqli_query($conexion, $consulta);
	*/
?>