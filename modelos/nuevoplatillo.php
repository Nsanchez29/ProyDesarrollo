<?php

	require_once "../config/conexion.php";

	
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$tipo = $_POST['tipo'];
	$estado = 1;

		$insPlatillo= " INSERT INTO consumibles (nombre,descripcion,precio,idTipoComida,estado) VALUES ('$nombre','$descripcion','$precio','$tipo','$estado')";
		$qPlatillo = mysqli_query($conexion,$insPlatillo);

				if ($qPlatillo) {
					echo '<script> alert("Nuevo Platillo agregado");
					location.href = "../vistas/vistaAdmin/platillos.php"; 
					</script>';
				}else{
					echo '<script> alert("error al agregar el Platillo");
					location.href = "../vistas/vistaAdmin/platillos.php"; 
					</script>';
				}

	
?>