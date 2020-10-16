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
          <div class="jumbotron" style="margin-top: 35px;">
            <h3 class="display-4 text-center">Mesas</h3>
            <hr>
            <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#Agregarmesa">Agregar Mesa</button>  
          </div>
            <table class="table text-center">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Numero de Mesa</th>
                  <th scope="col">Cantidad de Personas</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Desactivar</th>
                </tr>
              </thead>
                <tbody>
                  <?php
                    $mesas = "select * from mesas where estado = 1";
                    $Adminmesa = mysqli_query($conexion, $mesas);

                    foreach ($Adminmesa as $columna) {
                      
                  ?>
                  <tr>
                    <th><?php echo $columna['id']; ?></th>
                    <td><?php echo $columna['numero']; ?></td>
                    <td><?php echo $columna['cantidadMaxSillas']; ?></td>
                    <?php $id= $columna['id'];
                          $sillas= $columna['cantidadMaxSillas']
                     ?>
                    <td><button class="btn btn-warning Editarmesa" id="editMesa" data-id='$id' data-sillas='$sillas' data-toggle='modal' data-target='#Editarmesa'>Modificar</button> </td>
                    <td><a class="btn btn-danger">Desactivar</a></td>
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
        <input type="text" name="sillasId" id="sillasId">
        <div class="form-group">
          <label>Cantidad Maxima de sillas</label>
          <input type="number" class="form-control" name="sillasUpdate" id="sillasUpdate" placeholder="Ingrese cantidad de sillas.">
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

 $(document).ready(function(){

    $(document).on("click","#editMesa",function() {

        var id = $(this).data('id');
        var sillas = $(this).data('sillas');

        $('#Editarmesa').modal('show');
        $('#sillasId').val(id);
        $('#sillasUpdate').val(sillas);

    });

 });

</script>
  </body>
</html>
