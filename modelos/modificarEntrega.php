<?php 
require_once "../config/conexion.php";


if(isset($_REQUEST['idconsu']))
{	 

	$idconsumo = $_REQUEST['idconsu'];
		
		
	
	  	$exito="'<script> 
 		alert('Platillo entregado');
 		location.href = '../vistas/vistacocinero/Cocinero.php';</script>'";

 		$error="'<script> 
 		alert('Error al entregar el platillo');
 		location.href = '../vistas/vistacocinero/Cocinero.php';</script>'";

		 $consul = "UPDATE consumoporordenes set estado = 1 where id = $idconsumo";
	 	 if (mysqli_query($conexion, $consul)) {
	 	 		header('Location: ../vistas/vistacocinero/Cocinero.php');
	 			echo $exito;
    							
				}else{ 
					mysqli_close($conexion);
					echo $error;
				}




mysqli_close($conexion);

}
	 ?>