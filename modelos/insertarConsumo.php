<?php 
require_once "../config/conexion.php";

if(isset($_POST['save']))
{	 
	 $idorden = $_POST['idOrden'];
	 $cons = $_POST['lista2'];
	 $cantidad = $_POST['cantidad'];
     $descripcion = $_POST['desc'];

    
    
	    $consu = "select precio from consumibles where id = $cons";
    	$precio = mysqli_query($conexion,$consu) or die(mysqli_error($conexion));
        $fila=mysqli_fetch_array($precio);
        $subtot = $fila['precio'];
        $multi = $subtot * $cantidad;

        $consul = "select estado from ordenes where id = $idorden";
        $est = mysqli_query($conexion,$consul) or die(mysqli_error($conexion));
    	$row = mysqli_fetch_array($est);
		$estado = $row['estado'];


    	$exito="'<script> 
 		alert('Consumo agregado');
 		location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idorden."';</script>'";

 		$error="'<script> 
 		alert('Error al ingresar consumo');
 		location.href = '../vistas/vistaMesero/Meseroform.php?idOrd=".$idorden."';</script>'";
 		
 		if ($estado == 1) {
		$sql = "INSERT INTO consumoporordenes (idOrden,idConsumible,cantidad,comentario,subTotal)
	 	VALUES ('$idorden','$cons','$cantidad','$descripcion','$multi')";
	 	if (mysqli_query($conexion, $sql)) {
	 			$cons = "SELECT SUM(subTotal) as Tot FROM consumoporordenes WHERE idOrden = $idorden";
    			$total = mysqli_query($conexion,$cons) or die(mysqli_error($conexion));
    			$result=mysqli_fetch_array($total);
    			$totf = $result['Tot'];
    				  
    						$upd = "UPDATE ordenes SET total = $totf, estado = 2 where id = $idorden";
    						mysqli_query($conexion, $upd);
    						echo $exito;
    							
				}else{
					echo $error;
				}
			}else{

				$sql = "INSERT INTO consumoporordenes (idOrden,idConsumible,cantidad,comentario,subTotal)
	 			VALUES ('$idorden','$cons','$cantidad','$descripcion','$multi')";
	 			if (mysqli_query($conexion, $sql)) {
	 			$cons = "SELECT SUM(subTotal) as Tot FROM consumoporordenes WHERE idOrden = $idorden";
    			$total = mysqli_query($conexion,$cons) or die(mysqli_error($conexion));
    			$result=mysqli_fetch_array($total);
    			$totf = $result['Tot'];
    				  
    						$upd = "UPDATE ordenes SET total = $totf where id = $idorden";
    						mysqli_query($conexion, $upd);
    						echo $exito;
    						}else{
					echo $error;
				}

			}
	 mysqli_close($conexion);

}

 ?>


       