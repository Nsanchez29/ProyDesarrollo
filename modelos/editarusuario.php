<?php
require_once "../config/conexion.php";

	
	$id = $_POST['idUsuario'];
	$nombre = $_POST['nameUpdate'];
	$usuario = $_POST['usuarioUpdate'];
	$pass = sha1($_POST['passwordUpdate']);
	$rol = $_POST['rolUpdate'];
	$estado = 1;

	
	$EditTipo = " UPDATE usuarios SET nombre ='$nombre', username ='$usuario', password = '$pass', idRol = '$rol' , estado='$estado' where id = $id ";
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