<?php 
require_once "../config/conexion.php";

if(isset($_POST['guardar']))
{	 

	  $idord = $_POST['idOr'];
	  $tot = $_POST['totalOrd'];
	  $efectivo = $_POST['cantidadPago'];
	  $cambio = $_POST['cantidadCambio'];

	  	$exito="'<script> 
 		alert('Consumo agregado');
 		location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idorden."';</script>'";

 		$error="'<script> 
 		alert('Error al ingresar consumo');
 		location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idorden."';</script>'";

		 $consul = "INSERT INTO pago (idOrden,nit,montoEfectivo,cambioEfectivo)
	     VALUES ('$idord','$tot','$efectivo','$cambio')";
	 	 if (mysqli_query($conexion, $consul)) {

	 			$cons = "UPDATE ordenes set estado = 0 where id = $idord";
    			mysqli_query($conexion, $upd);
    			
    			echo $exito;
    							
				}else{
					mysqli_close($conexion);
					echo $error;
				}



}
mysqli_close($conexion);
	 ?>