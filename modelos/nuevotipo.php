<?php

	require_once "../config/conexion.php";

	
	$Tipo = $_POST['tipoC'];


		$ins= " INSERT INTO tipocomidas(nombre) VALUES ('$Tipo')";
		$q1 = mysqli_query($conexion,$ins);

				if ($q1) {
					echo '<script> alert("Tipo de comida agregado");
					location.href = "../vistas/vistaAdmin/tiposcomida.php"; 
					</script>';
				}else{
					echo '<script> alert("error al agregar Tipo de Comida");
					location.href = "../vistas/vistaAdmin/tiposcomida.php"; 
					</script>';
				}


	
?>