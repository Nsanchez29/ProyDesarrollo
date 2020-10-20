<?php
	
	require_once "../config/conexion.php";


	$id = $_REQUEST['id'];
	$estado = 0;


	$elimesa= " UPDATE mesas SET estado = $estado where id = $id";
	$res = mysqli_query($conexion, $elimesa);

	if ($res) {
					echo '<script> alert("mesa eliminada");
					location.href = "../vistas/vistaAdmin/mesas.php"; 
					</script>';
				}else{
					echo '<script> alert("error al eliminar mesa");
					location.href = "../vistas/vistaAdmin/mesas.php"; 
					</script>';
				}

?>