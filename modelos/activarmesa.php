<?php
	
	require_once "../config/conexion.php";


	$id = $_REQUEST['id'];
	$estado = 1;


	$elimesa= " UPDATE mesas SET estado = $estado where id = $id";
	$res = mysqli_query($conexion, $elimesa);

	if ($res) {
					echo '<script> alert("mesa activada");
					location.href = "../vistas/vistaAdmin/mesas.php"; 
					</script>';
				}else{
					echo '<script> alert("error al activar la mesa");
					location.href = "../vistas/vistaAdmin/mesas.php"; 
					</script>';
				}

?>