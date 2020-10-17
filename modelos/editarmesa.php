<?php
require_once "../config/conexion.php";

	
	$id = $_POST['id'];
	$sillas = $_POST['CantSillas'];



	$consulta = "UPDATE mesas set cantidadMaxSillas = $sillas where id = $id ";
	$q = mysqli_query($conexion, $consulta);
	
	if ($q) {
					echo '<script> alert("mesa modificada");
					location.href = "../vistas/vistaAdmin/mesas.php"; 
					</script>';
				}else{
					echo '<script> alert("error al modificar mesa");
					location.href = "../vistas/vistaAdmin/mesas.php"; 
					</script>';
				}
	

?>