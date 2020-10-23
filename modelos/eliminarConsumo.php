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

		$delete = "DELETE FROM consumoporordenes where id = $idcons";
			if(mysqli_query($conexion, $delete)){

				$cons = "SELECT SUM(subTotal) as Tot FROM consumoporordenes WHERE idOrden = $idOr";
    				$total = mysqli_query($conexion,$cons) or die(mysqli_error($conexion));
    				$result=mysqli_fetch_array($total);
    				$totf = $result['Tot'];

    				$orupd = "UPDATE ordenes set total = $totf";
    				mysqli_query($conexion, $orupd);

	  					echo $exito;


		}else{
			echo $error;

		}
		
}
mysqli_close($conexion);

?>