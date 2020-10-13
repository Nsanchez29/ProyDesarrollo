<?php

require_once "../config/conexion.php";

session_start();

$usuario = $_POST['user'];
$clave = $_POST['pass'];

$q = "SELECT * from usuarios where nombre = '$usuario' and password = '$clave'";
$consultaUsuario= mysqli_query($conexion,$q);
$array = mysqli_fetch_array($consultaUsuario);

if($array>0){

	if (isset($_SESSION['idRol'])) {
		switch ($_SESSION['idRol']) {
			case 1:
				$_SESSION['idRol'];
				echo '<script> alert("Bienvenido administrador");
				location.href = "../vistas/base.php"; 
				</script>';
				break;
			
			case 2:
				$_SESSION['idRol'];
				echo '<script> alert("Bienvenido anfitrion");
				location.href = "../vistas/base.php"; 
				</script>';
				break;

			case 3:
				$_SESSION['idRol'];
				echo '<script> alert("Bienvenido mesero");
				location.href = "../vistas/base.php"; 
				</script>';
				break;
		}
	}
		
}else{
	echo '<script> alert("Datos Incorrectos");
			location.href = "../vistas/login.php"; 
			</script>';
}

?>