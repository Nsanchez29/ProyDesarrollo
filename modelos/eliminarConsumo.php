<?php 

require_once "../config/conexion.php";

if(isset($_POST['guardar']))
{	 
		$idOr = $_POST['idOrden'];
		$idcons = $_POST['idEliminar'];
		

		$error="'<script> 
 		alert('Error al eliminar');
 		location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idOr."';</script>'";

 		$exito="'<script> 
 		alert('Eliminado con exito');
		 location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idOr."';</script>'";
		 
		$getSubTotal = "SELECT subTotal FROM consumoporordenes where id = $idcons";
		$conectGetSubTotal = mysqli_query($conexion,$getSubTotal) or die(mysqli_error($conexion));
		$resultSubtotal=mysqli_fetch_array($conectGetSubTotal);
		$subtotal = $resultSubtotal['subTotal'];

		$getTotal = "SELECT total FROM ordenes where id = $idOr";
		$conectGetTotal = mysqli_query($conexion,$getTotal) or die(mysqli_error($conexion));
		$resultTotal=mysqli_fetch_array($conectGetTotal);
		$total = $resultTotal['total'];

		$newTotal = $total - $subtotal;
		
		$delete = "DELETE FROM consumoporordenes where id = $idcons";
		if(mysqli_query($conexion, $delete)){
    	 			$orupd = "UPDATE ordenes set total = $newTotal";
    	 			mysqli_query($conexion, $orupd);
	  	 			echo $exito;
		}else{
			echo $error;
		}
		
}
mysqli_close($conexion);

?>