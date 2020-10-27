<?php

	require_once "../config/conexion.php";

	$nombre = $_POST['name'];
	$usuario = $_POST['usuario'];
	$pass = sha1($_POST['password']);
	$rol = $_POST['rol'];
	$estado = 1;

	
		$insUsuario= " INSERT INTO usuarios(nombre,username,password,idRol,estado) VALUES ('$nombre','$usuario','$pass','$rol','$estado')";
		$qUsuario = mysqli_query($conexion,$insUsuario);

				if ($qUsuario) {
					echo '<script> alert("Nuevo Usuario agregado");
					location.href = "../vistas/vistaAdmin/usuarios.php"; 
					</script>';
				}else{
					echo '<script> alert("error al agregar Usuario");
					location.href = "../vistas/vistaAdmin/usuarios.php"; 
					</script>';
				}


	
?>