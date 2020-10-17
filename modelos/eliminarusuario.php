<?php
	
	require_once "../config/conexion.php";


	$id = $_REQUEST['id'];
	$estado = 0;


	$eliUsuario= " UPDATE usuarios SET estado = $estado where id = $id";
	$resUsuario = mysqli_query($conexion, $eliUsuario);

	if ($resUsuario) {
					echo '<script> alert("usuario eliminado");
					location.href = "../vistas/vistaAdmin/usuarios.php"; 
					</script>';
				}else{
					echo '<script> alert("error al eliminar el usuario");
					location.href = "../vistas/vistaAdmin/usuarios.php"; 
					</script>';
				}

?>