<?php 
require_once "../config/conexion.php";

if(isset($_POST['guardar']))
{	 

	  $idord = $_POST['idOr'];
	  $nom = $_POST['nombre'];
	  $nit = $_POST['nit'];
	  $mesa = $_POST['idMes'];
	  $efectivo = $_POST['cantidadPago'];
	  $cambio = $_POST['cantidadCambio'];


	


 	
	

	  	$exito="'<script> 
 		alert('Pago exitoso');
 		location.href = '../vistas/vistaMesero/Mesero.php';</script>'";

 		$error="'<script> 
 		alert('Error al ingresar el pago');
 		location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idord."';</script>'";

		 $consul = "INSERT INTO pagos (idOrden,nombre,nit,montoEfectivo,cambioEfectivo)
	    			VALUES ('$idord','$nom','$nit','$efectivo','$cambio')";
	 	 if (mysqli_query($conexion, $consul)) {

	 			$cons = "UPDATE ordenes set estado = 0 where id = $idord";
    			mysqli_query($conexion, $cons);

    			$consult = "UPDATE mesas set estado = 1 where id = $mesa";
    			mysqli_query($conexion, $consult);
    			
    			echo $exito;
    							
				}else{ 
					mysqli_close($conexion);
					echo $error;
				}



}
mysqli_close($conexion);
	 ?>