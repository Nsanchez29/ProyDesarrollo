<?php

	require_once "../config/conexion.php";

	
	$Sillas = $_POST['sillas'];
	$estado = 1;


	$consulta = "SELECT max(numero) as Num from mesas";
	$q = mysqli_query($conexion, $consulta);
	while ($row = mysqli_fetch_array($q)) {
		
		$nMesa = $row['Num']+1;
		//echo $nMesa;

		$ins= " INSERT INTO mesas(numero,cantidadMaxSillas,estado) VALUES ('$nMesa','$Sillas','$estado')";
		$q1 = mysqli_query($conexion,$ins);

				if ($q1) {
					echo '<script> alert("mesa agregada");
					location.href = "../vistas/vistaAdmin/mesas.php"; 
					</script>';
				}else{
					echo '<script> alert("error al agregar mesa");
					location.href = "../vistas/vistaAdmin/mesas.php"; 
					</script>';
				}


	}

	
?>