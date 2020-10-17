<?php

	require_once "../config/conexion.php";

	
	$usuario = $_POST['usuario'];
	$pass = $_POST['password'];
	$rol = $_POST['rol'];
	$estado = 1;

	
		$insUsuario= " INSERT INTO usuarios(nombre,password,idRol,estado) VALUES ('$usuario','$pass','$rol','$estado')";
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