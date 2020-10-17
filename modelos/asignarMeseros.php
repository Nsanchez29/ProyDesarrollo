<?php

$idMesa = $_POST['mesa'];
$NMesa = $_POST['numero'];
$Mesero = $_POST['mesero'];

//echo $idMesa;
//echo $NMesa;
//echo $Mesero;


require_once "../config/conexion.php";

$consulta = "SELECT * FROM `ordenes` WHERE fecha > CURRENT_DATE()";
$q = mysqli_query($conexion, $consulta);
$result = mysqli_num_rows($q);

while ($fila=mysqli_fetch_array($q)){


if ($result!=0) {
	
	

	$Orden = $fila['numero']+1; 
	//echo $Orden;
	//echo $idMesa;
	//echo $NMesa;
	//echo $Mesero;

	$asignacionMesaDia = "INSERT INTO ordenes (numero,idMesa,total,idUsuario) 
		VALUES ('$Orden','$idMesa','0','$Mesero')";
	$estadoMesa = "UPDATE mesas SET estado = 2 where id = $idMesa";

	$Query3 = mysqli_query($conexion, $asignacionMesaDia);
	$Query4 = mysqli_query($conexion, $estadoMesa);


	if ($Query3) {

		if ($Query4) {
			echo '<script> alert("Mesa Asignada Exitosamente");
		location.href = "../vistas/vistaAnfitrion/Anfitrion.php"; 
		</script>';
		}else{
			echo '<script> alert("Error al Asignar la Mesa !);
		location.href = "../vistas/vistaAnfitrion/Anfitrion.php"; 
		</script>';
		}
		
	}else{
		echo '<script> alert("Error al Asignar la Mesa 1");
		location.href = "../vistas/vistaAnfitrion/Anfitrion.php"; 
		</script>';
	}
	



}else{
	
	//echo "No hay";
	$asignacionMesa = "INSERT INTO ordenes (numero,idMesa,total,idUsuario) VALUES ('1','$idMesa','0','$Mesero')";
	$estadoMesa = "UPDATE mesas SET estado = 2 where id = $idMesa";

	$Query = mysqli_query($conexion, $asignacionMesa);
	$Query2 = mysqli_query($conexion, $estadoMesa);

	if ($Query) {

		if ($Query2) {
			echo '<script> alert("Mesa Asignada Exitosamente");
		location.href = "..vistas/vistaAnfitrion/Anfitrion.php"; 
		</script>';
		}else{
			echo '<script> alert("Error al Asignar la Mesa");
		location.href = "../vistas/vistaAnfitrion/Anfitrion.php"; 
		</script>';
		}

		
	}else{
		echo '<script> alert("Error al Asignar la Mesa");
		location.href = "../vistas/vistaAnfitrion/Anfitrion.php"; 
		</script>';
	}

}

}

?>