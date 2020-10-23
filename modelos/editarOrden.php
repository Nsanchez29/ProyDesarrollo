<?php 

require_once "../config/conexion.php";

if(isset($_POST['guardar']))
{	 

		$idOr = $_POST['idOrden'];
	    $idconsu = $_POST['idEditar'];
	    $cantedit = $_POST['cantidadEditar'];
	 
	   
	  	$error="'<script> 
 		alert('La cantidad no puede ser 0');
 		location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idOr."';</script>'";

 			$exito="'<script> 
 		alert('Cantidad modificada con exito');
 		location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idOr."';</script>'";
	  
	  	           $valor = "select   consu.precio as precio
                   from consumoporordenes consord
                   INNER JOIN consumibles as consu on consord.idConsumible = consu.id
                   where consord.id = $idconsu";

				$query = mysqli_query($conexion,$valor) or die(mysqli_error($conexion));
    			$result=mysqli_fetch_array($query);
    			$precio = $result['precio'];
    			

    			
    			


    			if ($cantidad = 0) {
    				echo $error;
    			}else{

    				$subord = $cantedit * $precio;

    				$edit = "UPDATE consumoporordenes set cantidad = $cantedit, subTotal = $subord where id = $idconsu";
	  				if(mysqli_query($conexion, $edit)){

	  				$cons = "SELECT SUM(subTotal) as Tot FROM consumoporordenes WHERE idOrden = $idOr";
    				$total = mysqli_query($conexion,$cons) or die(mysqli_error($conexion));
    				$result=mysqli_fetch_array($total);
    				$totf = $result['Tot'];

    				$orupd = "UPDATE ordenes set total = $totf";
    				mysqli_query($conexion, $orupd);

	  					echo $exito;
	  				}
    			}


		




}
mysqli_close($conexion);









 ?>