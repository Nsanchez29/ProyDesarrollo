<?php 
include '../../config/conexion.php';

$idConsumible=$_POST['idConsumible'];

	
    if($idConsumible == 0) {
        echo"";
    } else {
        echo  '
            <label><strong>Cantidad:</strong></label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="1">
        ';
    }
	

?>