<?php
	
	require_once "../config/conexion.php";


	$id = $_REQUEST['id'];
	$estado = 0;


	$elimtipo= " UPDATE tipocomidas SET estado = $estado where id = $id";
	$rest = mysqli_query($conexion, $elimtipo);

	if ($rest) {
					echo '<script> alert("Tipo de Comida desactivado");
					location.href = "../vistas/vistaAdmin/tiposcomida.php"; 
					</script>';
				}else{
					echo '<script> alert("error al desactivar Tipo de Comida");
					location.href = "../vistas/vistaAdmin/tiposcomida.php"; 
					</script>';
				}

?>