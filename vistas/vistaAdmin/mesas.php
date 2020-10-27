<?php

    session_start();

    if(!isset($_SESSION['idRol'])){
        header('location: ../vistas/login.php');
    }else{
        if($_SESSION['idRol'] != 1){
            header('location: ../vistas/login.php');
        }
    }

    include '../../config/conexion.php';

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
            <h2>Mesas</h2>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#Agregarmesa">Agregar Mesa</button>  
            <br>
            <br>
            <table class="table text-center";>
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Numero de Mesa</th>
                  <th scope="col">Cantidad de Personas</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
                <tbody>
                  <?php
                    $mesas = "select * from mesas";
                    $Adminmesa = mysqli_query($conexion, $mesas);

                    foreach ($Adminmesa as $columna) {
                      
                  ?>
                  <tr>
                    <td><?php echo $columna['id']; ?></td>
                    <td><?php echo $columna['numero']; ?></td>
                    <td><?php echo $columna['cantidadMaxSillas']; ?></td>
                    <?php
                      if ($columna['estado']==0) {
                       echo "<td>"; echo "Desactivada"; echo "</td>";
                      }else if ($columna['estado'] ==1 || $columna['estado']==2 ) {
                          echo "<td>"; echo "Activada"; echo "</td>";
                      }
                    ?>
                    <td><button class="btn btn-warning Editarmesa" data-toggle='modal' data-target='#Editarmesa'><span class="material-icons">create</span></button> </td>
                    <?php

                      if ($columna['estado']==0) {
                        ?>
                       <td><a href="../../modelos/activarmesa.php?id=<?php echo $columna['id']; ?>" class="btn btn-success btn-block">Activar</a></td>
                       <?php
                      }else if ($columna['estado'] ==1 || $columna['estado']==2 ) {
                        ?>
                          <td><a href="../../modelos/eliminarmesa.php?id=<?php echo $columna['id']; ?>" class="btn btn-danger btn-block">Desactivar</a></td>
                          <?php
                      }

                    ?>
                    <!--<td><a href="../../modelos/eliminarmesa.php?id=<?php// echo $columna['id']; ?>" class="btn btn-danger"><span class="material-icons">block</span></a></td>
                    <td><a href="../../modelos/eliminarmesa.php?id=<?php //echo $columna['id']; ?>" class="btn btn-success"><span class="material-icons">done_outline</span></a></td>-->
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
  <div class="modal fade" id="Agregarmesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Agregar mesa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../modelos/nuevamesa.php" method="POST">
      <div class="modal-body">
        
        <div class="form-group">
          <label>Cantidad Maxima de sillas</label>
          <input type="number" class="form-control" name="sillas" placeholder="Ingrese cantidad de sillas.">
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

<div class="modal fade" id="Editarmesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Editar mesa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../modelos/editarmesa.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="id" id="update_id">
        <div class="form-group">
          <label>Cantidad Maxima de sillas</label>
          <input type="number" class="form-control" name="CantSillas" id="sillasUpdate" placeholder="Ingrese cantidad de sillas.">
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

 $('.Editarmesa').on('click',function(){

  $tr=$(this).closest('tr');

  var datos=$tr.children('td').map(function(){
    return $(this).text();
  });

  $('#update_id').val(datos[0]);
  $('#sillasUpdate').val(datos[2]);

 });

</script>
  </body>
</html>
