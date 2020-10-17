<?php
require_once "../config/conexion.php";

	
	$id = $_POST['idUsuario'];
	$usuario = $_POST['usuarioUpdate'];
	$pass = $_POST['passwordUpdate'];
	$rol = $_POST['rolUpdate'];
	$estado = 1;

	
	$EditTipo = " UPDATE usuarios SET nombre ='$usuario', password = '$pass', idRol = '$rol' , estado='$estado' where id = $id ";
	$qTipo = mysqli_query($conexion, $EditTipo);
	
	if ($qTipo) {
					echo '<script> alert("Usuario modificado");
					location.href = "../vistas/vistaAdmin/usuarios.php"; 
					</script>';
				}else{
					echo '<script> alert("error al modificar el Usuario");
					location.href = "../vistas/vistaAdmin/usuarios.php"; 
					</script>';
				}
	

?>