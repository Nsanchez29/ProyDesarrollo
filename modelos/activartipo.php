<?php
	
	require_once "../config/conexion.php";


	$id = $_REQUEST['id'];
	$estado = 1;


	$elimtipo= " UPDATE tipocomidas SET estado = $estado where id = $id";
	$rest = mysqli_query($conexion, $elimtipo);

	if ($rest) {
					echo '<script> alert("Tipo de Comida activado");
					location.href = "../vistas/vistaAdmin/tiposcomida.php"; 
					</script>';
				}else{
					echo '<script> alert("error al activar Tipo de Comida");
					location.href = "../vistas/vistaAdmin/tiposcomida.php"; 
					</script>';
				}

?>