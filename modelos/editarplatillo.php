<?php
require_once "../config/conexion.php";

	$id = $_POST['idPlatillo'];
	$nombre = $_POST['nombreU'];
	$descripcion = $_POST['descripcionU'];
	$precio = $_POST['precioU'];
	$tipo = $_POST['tipoU'];
	$estado = 1;


	$EditPlatillo = " UPDATE consumibles SET nombre ='$nombre', descripcion='$descripcion', precio='$precio', idTipoComida='$tipo' where id = $id ";
	$qPlatillo = mysqli_query($conexion, $EditPlatillo);
	
	if ($qPlatillo) {
					echo '<script> alert("Platillo modificado");
					location.href = "../vistas/vistaAdmin/platillos.php"; 
					</script>';
				}else{
					echo '<script> alert("error al modificar el Platillo");
					location.href = "../vistas/vistaAdmin/platillos.php"; 
					</script>';
				}
	

?>