<?php 
include '../../config/conexion.php';

$idConsumible=$_POST['idConsumible'];

	
    if($idConsumible == 0) {
        echo"";
    } else {
        echo  '
        <div class="form-group col-md-12" >
            <label><strong>Cantidad:</strong></label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="1">
            </div>
            <div class="form-group col-md-12" >
                <label><strong>Descripción:</strong></label>
                <textarea id="desc" name="desc" type="text" class="form-control"></textarea>
              </div>
        ';
    }
	

?>