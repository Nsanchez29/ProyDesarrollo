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


         
    $consulta = "select ord.numero as numeroOrden, ord.total as totalOrden, ord.estado, ord.fecha, mes.numero as numeroMesa, mes.cantidadMaxSillas,mes.id as idMes, ord.id as idOrd 
     from ordenes ord INNER JOIN usuarios usu on usu.id = ord.idUsuario 
     INNER JOIN mesas mes on mes.id = ord.idMesa WHERE ord.id = $idord";
    $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
    $fila=mysqli_fetch_array($datos);

    
      $resultado= "select  consu.nombre as nombre,consord.comentario as comentario,consord.cantidad as cant, consord.subtotal as sub, consord.id as idConsOrd, consord.estado as estado
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
              <th  style="width: 350px; " class="text-center " scope="col">Descripción</th>
              <th class="text-center" scope="col">Cantidad</th>
              <th class="text-center" scope="col">Estado</th>
              <th  class="text-center" scope="col">Opciones</th>
              <th class="text-right" scope="col">Subtotal</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $i=0;
             while ($row=mysqli_fetch_array($data)){
              $i++;
              $estadoConsumo = $row['estado'];
              echo"
            <tr>
              <th scope='row'>"; echo $i; echo "</th>
              <td>"; echo $row['nombre']; echo "</td>
               <td >"; echo $row['comentario']; echo "</td>

              <td class = 'text-center'>"; echo $row['cant']; echo "</td>
              <td>";if ($estadoConsumo == 0) {
                    echo "<div class='alert alert-warning text-center' role='alert'>
                           Pendiente
                            </div>";
              }else{
                echo "<div class='alert alert-success text-center' role='alert'>
                           Servido
                            </div>";
              };
              $idOrden = $row['idConsOrd'];
              $idCantidaad = $row['cant'];
              $idComentario = $row['comentario'];
              $comentarioModificado = '"';
              $comentarioModificado = $comentarioModificado . $idComentario . '"';
                echo"</td>
              <td class='text-center'>
                <button onclick='editarCantidad("; echo $idOrden ; echo ", "; echo $idCantidaad;  echo ", "; echo $comentarioModificado; echo " )' data-toggle='modal' data-target='#exampleModal3' data-toggle='tooltip' data-placement='top' title='Editar Cantidad' type='button' style='color:white;'' class='btn btn-warning  btn-sm'"; if ($estadoConsumo == 1) {
                                                    echo "disabled";      
                                                    } echo
                "><span class='material-icons'>create</span></button>
                <button onclick='eliminarRegistro("; echo $row['idConsOrd']; echo ")' data-toggle='modal' data-target='#exampleModal4' data-toggle='tooltip' data-placement='top' title='Eliminar' type='button' class='btn btn-danger btn-sm'"; if ($estadoConsumo == 1) {
                                                                echo "disabled";      
                                                                } echo
                "><span class='material-icons'>delete</span></button>
              </td>
              <td class='text-right'>Q."; echo $row['sub']; echo "</td>
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
              <button data-toggle='modal' data-target='#exampleModal2' type='button' style='margin-right: 16px' class='btn btn-primary float-right'"; 

               if ($lineas == 0) {
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
          <form action="../../modelos/insertarconsumo.php" method="POST">
            <div class="modal-body">
              <div class="col-md-12">
                <input type="hidden" name="idOrden" value="<?php echo $idord;?>">
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
                <div id="cantidadConsumo"></div>
                
                

              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="submit" name="save" class="btn btn-primary">Agregar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal2 -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pagar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="../../modelos/insertarPago.php" method="POST">
          <div class="modal-body">
             <input type="hidden" name="idOr" value="<?php echo $idord;?>">
             <input type="hidden" name="idMes" value="<?php echo $fila['idMes'];?>">
            <div class="col-md-12">
            
            <div class="form-group col-md-12">
                <label><strong>Total Orden:</strong></label>
                <input readonly name="totalModal" id="totalModal" value="<?php echo  $fila['totalOrden'];?>" type="text" class="form-control">
              </div>

                 <div class="form-group col-md-12">
                <label><strong>Nombre y apellido:</strong></label>
                <input id="nombre" name="nombre" type="text" class="form-control">
              </div>

              <div class="form-group col-md-12">
                <label><strong>NIT:</strong></label>
                <input id="nit" name="nit" type="text" class="form-control">
              </div>

              <div class="form-group col-md-12">
                <label><strong>Cantidad Pago:</strong></label>
                <input id="cantidadPago" name="cantidadPago" type="text" class="form-control">
              </div>

              <div class="form-group col-md-12">
                <label><strong>Cantidad Cambio:</strong></label>
                <input readonly id="cantidadCambio" name="cantidadCambio" value="0" type="text" class="form-control">
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="submit" id="boton" name="guardar" class="btn btn-primary">Aceptar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal 3-->
      <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="../../modelos/editarOrden.php" method="POST">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar articulo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
              <input type="hidden" id="idEditar" name="idEditar">
              <input type="hidden" name="idOrden" value="<?php echo $idord;?>">
                <div class="form-group col-md-12">
                    <label><strong>Cantidad:</strong></label>
                    <input name="cantidadEditar" id="cantidadEditar" type="number" class="form-control">
                </div>

                <div class="form-group col-md-12">
                    <label><strong>Descripción:</strong></label>
                    <textarea  name="newdesc" id="newdesc" type="text" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button id="botonEditar" type="submit" name="guardar" class="btn btn-primary">Aceptar</button>
            </div>
          </div>
        </div>
        </form>
      </div>


      <!-- Modal 4 -->
        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <form action="../../modelos/eliminarConsumo.php" method="POST">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
              <input type="hidden" id="idEliminar" name="idEliminar">
                <input type="hidden" name="idOrden" value="<?php echo $idord;?>">
                <label><strong>¿Esta seguro que desea eliminar este Alimento de la Orden?</strong></label>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" name="guardar" class="btn btn-primary">Aceptar</button>
              </div>
            </div>
          </div>
          </form>
        </div>


  </body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#lista1').change(function(){
			recargarLista();
		});
	});

  $(document).ready(function(){
		$('#cantidadEditar').change(function(){
			var cantidad = $('#cantidadEditar').val();
      if(cantidad <= 0) {
        $('#botonEditar').attr("disabled", true);
      } else {
        $('#botonEditar').attr("disabled", false);
      }
		});
	});


  $(document).ready(function(){
    $('#boton').attr("disabled", true);
		$('#cantidadPago').change(function(){
			var total = parseFloat($('#totalModal').val());
      var pago = parseFloat($('#cantidadPago').val());
      var cambio = pago - total;
      if(pago >= total) {
        $('#cantidadCambio').val(cambio);
        $('#boton').attr("disabled", false);
      } else {
        $('#cantidadCambio').val(0);
        $('#boton').attr("disabled", true);
      }
		});
	})
</script>
<script type="text/javascript">

  function editarCantidad(id, cantidad, comentario){
    $('#cantidadEditar').val(cantidad);
    $('#idEditar').val(id);
    $('#newdesc').val(comentario);
  };

  function eliminarRegistro(id){
    $('#idEliminar').val(id);
  };

	function recargarLista(){
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
