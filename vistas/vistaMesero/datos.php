<?php 
include '../../config/conexion.php';

$continente=$_POST['continente'];

	$sql="SELECT *
		from consumibles 
		where idTipoComida='$continente' and estado = 1";

	$result=mysqli_query($conexion,$sql);

	$cadena="<label><strong>Tipo Comida:</strong></label> 
            <select class='form-control' id='lista2' name='lista2'>
            <option value='0'>Selecciona una opcion</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).' - Q'.utf8_encode($ver[3]).'</option>';
	}
    $cantidad = mysqli_num_rows($result);
    if($cantidad == 0) {
        echo"";
    } else {
        echo  $cadena."</select>
        
        <script type='text/javascript'>
            $(document).ready(function(){
                    $('#lista2').change(function(){
                        mostrar();
                    });
                })
            </script>
            <script type='text/javascript'>
            function mostrar(){
                console.log('ENTRA ACA2');
                    $.ajax({
                        type:'POST',
                        url:'datosConsumo.php',
                        data:'idConsumible=' + $('#lista2').val(),
                        success:function(r){
                            $('#cantidadConsumo').html(r);
                        }
                    });
                }
            </script>

        ";
    }
	

?>

