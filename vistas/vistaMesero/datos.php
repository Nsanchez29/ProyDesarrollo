<?php 
include '../../config/conexion.php';

$continente=$_POST['continente'];

	$sql="SELECT *
		from consumibles 
		where idTipoComida='$continente'";

	$result=mysqli_query($conexion,$sql);

	$cadena="<label><strong>Tipo Comida:</strong></label> 
            <select id='lista2' name='lista2' class='form-control'>
            <option value='0'>Selecciona una opcion</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).' - Q'.utf8_encode($ver[3]).'</option>';
	}
    $cantidad = mysqli_num_rows($result);
    if($cantidad == 0) {
        echo"";
    } else {
        echo  $cadena."</select>";
    }
	

?>