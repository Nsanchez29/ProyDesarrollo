<?php
require_once "../config/conexion.php";

	
	$id = $_POST['idTipo'];
	$TipoC = $_POST['TipoComida'];
	$estado = 1;


	$EditTipo = " UPDATE tipocomidas SET nombre ='$TipoC', estado='$estado' where id = $id ";
	$qTipo = mysqli_query($conexion, $EditTipo);
	
	if ($qTipo) {
					echo '<script> alert("Tipo de Comida modificado");
					location.href = "../vistas/vistaAdmin/tiposcomida.php"; 
					</script>';
				}else{
					echo '<script> alert("error al modificar el Tipo de Comida");
					location.href = "../vistas/vistaAdmin/tiposcomida.php"; 
					</script>';
				}
	

?>