<?php
	
	require_once "../config/conexion.php";


	$id = $_REQUEST['id'];
	$estado = 1;


	$eliPlatillo= " UPDATE consumibles SET estado = $estado where id = $id";
	$resPlatillo = mysqli_query($conexion, $eliPlatillo);

	if ($resPlatillo) {
					echo '<script> alert("Platillo Activado");
					location.href = "../vistas/vistaAdmin/platillos.php"; 
					</script>';
				}else{
					echo '<script> alert("error al Activar el Platillo");
					location.href = "../vistas/vistaAdmin/platillos.php"; 
					</script>';
				}

?>