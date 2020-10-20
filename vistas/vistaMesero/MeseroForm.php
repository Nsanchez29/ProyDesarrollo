<?php
 include '../../config/conexion.php';
    session_start();
    if(!isset($_SESSION['idRol'])){
        header('location: ../vistas/login.php');
    }else{
        if($_SESSION['idRol'] != 3){
            header('location: ../vistas/login.php');
        }
    }

    $idord = $_REQUEST['idOrd'];


         
    $consulta = "select ord.numero as numeroOrden, ord.total as totalOrden, ord.estado, ord.fecha, mes.numero as numeroMesa, mes.cantidadMaxSillas, ord.id as idOrd 
     from ordenes ord INNER JOIN usuarios usu on usu.id = ord.idUsuario 
     INNER JOIN mesas mes on mes.id = ord.idMesa WHERE ord.id = $idord";
    $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
    $fila=mysqli_fetch_array($datos);
    
    $resultado= "select  consu.nombre as nombre, consord.cantidad as cant, consord.subtotal as sub
                   from consumoporordenes consord
                   INNER JOIN consumibles as consu on consord.idConsumible = consu.id
                   where consord.idOrden = $idord";
    $data=mysqli_query($conexion,$resultado) or die(mysqli_error($conexion));
    
    $tiposConsumible = "select * from tipocomidas";
    $response=mysqli_query($conexion,$tiposConsumible) or die(mysqli_error($conexion));
      
    $numord = "select * from consumoporordenes where idOrden = $idord";
    $num= mysqli_query($conexion,$numord) or die(mysqli_error($conexion));
    $lineas=mysqli_num_rows($num);
            
   
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Proyecto Restaurante</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    <!-- JS, Popper.js, and jQuery -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../../css/styles.css" />
    <style>
      .box-accept {
        padding: 10px 15px 7.5px 15px;
        position: absolute;
        background: -webkit-linear-gradient(
          90deg,
          rgb(23, 237, 22),
          rgb(137, 255, 125)
        );
        background: linear-gradient(90deg, rgb(23, 237, 22), rgb(137, 255, 125));
        color: white;
        border-radius: 7px;
        margin-left: -17px;
        margin-top: -35px;
      }

      .box-waiting {
        padding: 10px 15px 7.5px 15px;
        position: absolute;
        background: -webkit-linear-gradient(90deg, rgb(237, 189, 22), rgb(255, 249, 125));
        background: linear-gradient(90deg, rgb(237, 189, 22), rgb(255, 249, 125));
        color: white;
        border-radius: 7px;
        margin-left: -17px;
        margin-top: -35px;
      }
      .sombra {
        box-shadow: 0 1px 4px 0 rgba(0,0,0,.14);
      }

      .orden {
        font-size: 60px;
        font-weight: 100;
        color: rgba(0,0,0,0.7);
      }

    </style>
  </head>
  <body>
    
    <?php include("../navbar/navbarMesero.php");?>

   <br><br>
      <div class="card col-md-10" style=" margin: auto;  box-shadow: rgba(0,0,0,0.2) 0px 0px 20px 0px;">
 
  <div class="card-body">
      <div class="item">
        <div class="card-title">
          <h3><strong>Orden #<?php echo $fila['numeroOrden'];?></strong></h3>
          <h5>Mesa No.<?php echo $fila['numeroMesa'];?></h5>
        </div>
        <span class="spacer"></span>
        <button style="height: fit-content;margin: auto 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><span class="material-icons">add</span></button>
        <a href="Mesero.php" style="height: fit-content;margin: auto 5px;" type="button" class="btn btn-success"><span class="material-icons">done_outline</span></a>
      </div>
    <hr style="margin-top:0px">

    <div>
      <div class="col-md-12">  
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Cantidad</th>
              <th  class="text-center" scope="col">Opciones</th>
              <th class="text-right" scope="col">Subtotal</th>
            </tr>
          </thead>
          <tbody>
          <?php
             while ($row=mysqli_fetch_array($data)){
              echo"
            <tr>
              <th scope='row'>1</th>
              <td>"; echo $row['nombre']; echo "</td>
              <td>"; echo $row['cant']; echo "</td>
              <td class='text-center'>
                <button type='button' style='color:white;'' class='btn btn-warning  btn-sm'><span class='material-icons'>create</span></button>
                <button type='button' class='btn btn-danger btn-sm'><span class='material-icons'>delete</span></button>
              </td>
              <td class='text-right'>"; echo $row['sub']; echo "</td>
            </tr>

            ";
          }
           ?>
          </tbody>
        </table>

      </div>

    </div> 
       
    <hr>
    <?php  
    echo "
            <div class='col-md-12 item'>
              <span><strong>Total:</strong></span>
              <span class='spacer'></span>
              <span>Q.";echo $fila['totalOrden']; echo"</span>
              </div>
              <br>
              <button type='button' style='margin-right: 16px' class='btn btn-primary float-right'"; 

               if ($lineas < 1) {
                echo "disabled";
                }

                echo">Pagar</button>  
          
            </div>  
          </div>
        "; 
      ?>

      </div>
      
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-md-12">

              <div class="form-group col-md-12">
                <label><strong>Tipo Comida:</strong></label>
                <select class="form-control"  id="lista1" name="lista1">
                  <option value="0">Selecciona una opcion</option>
                  <?php
                    while ($row2=mysqli_fetch_array($response)){
                      echo"<option value='";echo $row2['id']; echo"'>";echo $row2['nombre'];echo"</option>";
                    }
                  ?>
                </select>
              </div>

              <div class="form-group col-md-12" id="select2lista"></div>
              <div class="form-group col-md-12" id="cantidadConsumo"></div>
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#lista1').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
    console.log('ENTRA ACA');
		$.ajax({
			type:"POST",
			url:"datos.php",
			data:"continente=" + $('#lista1').val(),
			success:function(r){
				$('#select2lista').html(r);
			}
		});
	}
</script>
