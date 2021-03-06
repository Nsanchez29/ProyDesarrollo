<?php

    session_start();

    if(!isset($_SESSION['idRol'])){
        header('location: ../vistas/login.php');
    }else{
        if($_SESSION['idRol'] != 1){
            header('location: ../vistas/login.php');
        }
    }

    require_once "../../config/conexion.php";

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
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
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
  </head>
  <body>
    
    <?php include("../navbar/navbarAdmin.php");?>

    <br>
    <br>

    <div style="margin: auto; box-shadow: rgba(0,0,0,0.2) 0px 0px 20px 0px;" class="col-md-11 card shadow-inset">
        <div class="card-body col-md-12">
            <h2>Platillos</h2>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#Agregarplatillo">Agregar Platillos</button>  
            <br>
            <br>
            <table class="table text-center";>
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Platillo</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Tipo de Comida</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
                <tbody>
                  <?php

                    $platillos = "SELECT c.id as id, c.nombre as nombre, c.descripcion as descripcion, c.precio as precio, t.nombre as tipoComida, c.estado as estado from consumibles c
                    INNER JOIN tipocomidas t on c.idTipoComida = t.id 
                    order by c.id asc";
                    $AdminPlatillo = mysqli_query($conexion, $platillos);

                    foreach ($AdminPlatillo as $colPlatillo) {
                      
                  ?>
                     
                  <tr>
                    <td><?php echo $colPlatillo['id']; ?></td>
                    <td><?php echo $colPlatillo['nombre']; ?></td>
                    <td><?php echo $colPlatillo['descripcion']; ?></td>
                    <td><?php echo $colPlatillo['precio']; ?></td>
                    <td><?php echo $colPlatillo['tipoComida']; ?></td>
                    <?php
                      if ($colPlatillo['estado']==0) {
                       echo "<td>"; echo "Desactivado"; echo "</td>";
                      }else if ($colPlatillo['estado'] ==1) {
                          echo "<td>"; echo "Activado"; echo "</td>";
                      }
                    ?>
                    <td><button class="btn btn-warning Editarplatillo" data-toggle='modal' data-target='#Editarplatillo'><span class="material-icons">create</span></button> </td>
          
                  <?php

                      if ($colPlatillo['estado']==0) {
                        ?>
                       <td><a href="../../modelos/activarplatillo.php?id=<?php echo $colPlatillo['id']; ?>" class="btn btn-success btn-block">Activar</a></td>
                       <?php
                      }else if ($colPlatillo['estado'] ==1) {
                        ?>
                         <td><a href="../../modelos/eliminarPlatillo.php?id=<?php echo $colPlatillo['id']; ?>" class="btn btn-danger btn-block">Desactivar</a></td>
                           <?php
                      }

                    ?>
                    </tr>
                  <?php
                    }
                  ?>

                </tbody>
            </table>
          </div>
    </div>
    <br>
    <br>

<!--Modal Agregar -->
  <div class="modal fade" id="Agregarplatillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Platillo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../modelos/nuevoplatillo.php" method="POST">
      <div class="modal-body">
        
        <div class="form-group">
          <label>Nombre de platillo</label>
          <input type="text" class="form-control" name="nombre" placeholder="Ingrese nombre de platillo.">
        </div>

        <div class="form-group">
          <label>Descripcion</label>
          <input type="text" class="form-control" name="descripcion" placeholder="Ingrese descripcion.">
        </div>

        <div class="form-group">
          <label>Precio</label>
          <input type="number" class="form-control" name="precio" placeholder="Ingrese precio.">
        </div>

        <div class="form-group">
          <label>Tipo de Comida</label>
          <select name="tipo" id="tipo" class="form-control">
            <option selected>Seleccione Tipo de Comida...</option>
            <?php
              $tipo = " SELECT * FROM tipocomidas where estado = 1";
              $result = mysqli_query($conexion, $tipo);

              foreach ($result as $Rowtipo) {
                
                echo '<option value= "'.$Rowtipo['id'].'">'.$Rowtipo['nombre'].'</option>';

              }
            ?>
          </select>
        </div>        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-outline-primary">Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Modal Editar -->

<div class="modal fade" id="Editarplatillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Editar Platillo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../modelos/editarplatillo.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="idPlatillo" id="update_id">
        
        <div class="form-group">
          <label>Nombre de platillo</label>
          <input type="text" class="form-control" name="nombreU" id="UpdateNombre" placeholder="Ingrese nombre de platillo.">
        </div>

        <div class="form-group">
          <label>Descripcion</label>
          <input type="text" class="form-control" name="descripcionU" id="UpdateDescripcion" placeholder="Ingrese descripcion.">
        </div>

        <div class="form-group">
          <label>Precio</label>
          <input type="number" class="form-control" name="precioU" id="UpdatePrecio" placeholder="Ingrese precio.">
        </div>

        <div class="form-group">
          <label>Tipo de Comida</label>
          <select name="tipoU" id="tipoU" class="form-control" required>
            <option selected>Seleccione Tipo de Comida...</option>
            <?php
              $tipo = " SELECT * FROM tipocomidas where estado = 1";
              $result = mysqli_query($conexion, $tipo);

              foreach ($result as $Rowtipo) {
                
                echo '<option value= "'.$Rowtipo['id'].'">'.$Rowtipo['nombre'].'</option>';

              }
            ?>
          </select>
        </div>            

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-outline-primary">Editar</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">

 $('.Editarplatillo').on('click',function(){

  $tr=$(this).closest('tr');

  var datos=$tr.children('td').map(function(){
    return $(this).text();
  });

  $('#update_id').val(datos[0]);
  $('#UpdateNombre').val(datos[1]);
  $('#UpdateDescripcion').val(datos[2]);
  $('#UpdatePrecio').val(datos[3]);


 });

</script>
  </body>
</html>
