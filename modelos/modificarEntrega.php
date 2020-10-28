<?php 
require_once "../config/conexion.php";

if(isset($_POST['enviar']))
{	 

	  $idconsumo = $_POST['idconsu'];
	 	echo $idconsumo;
/*
	  	$exito="'<script> 
 		alert('Platillo entregado');
 		location.href = '../vistas/vistaMesero/Cocinero.php';</script>'";

 		$error="'<script> 
 		alert('Error al entregar el platillo');
 		location.href = '../vistas/vistaMesero/Cocinero.php';</script>'";

		 $consul = "INSERT INTO pagos (idOrden,nombre,nit,montoEfectivo,cambioEfectivo)
	    			VALUES ('$idord','$nom','$nit','$efectivo','$cambio')";
	 	 if (mysqli_query($conexion, $consul)) {

	 			echo $exito;
    							
				}else{ 
					mysqli_close($conexion);
					echo $error;
				}


*/
}
mysqli_close($conexion);
	 ?>