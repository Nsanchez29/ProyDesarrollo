<?php
	
	require_once "../config/conexion.php";


	$id = $_REQUEST['id'];
	$estado = 0;


	$eliPlatillo= " UPDATE consumibles SET estado = $estado where id = $id";
	$resPlatillo = mysqli_query($conexion, $eliPlatillo);

	if ($resPlatillo) {
					echo '<script> alert("Platillo desactivado");
					location.href = "../vistas/vistaAdmin/platillos.php"; 
					</script>';
				}else{
					echo '<script> alert("error al desactivar el Platillo");
					location.href = "../vistas/vistaAdmin/platillos.php"; 
					</script>';
				}

?>