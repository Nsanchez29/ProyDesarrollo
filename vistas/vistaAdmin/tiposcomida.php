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
            <h2>Tipos de Comida</h2>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#Agregartipo">Agregar Tipo de Comida</button>  
            <br>
            <br>
            <table class="table text-center";>
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tipo de Comida</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Desactivar</th>
                </tr>
              </thead>
                <tbody>
                  <?php
                    $tiposcomida = "SELECT * from tipocomidas where estado = 1";
                    $Admintipos = mysqli_query($conexion, $tiposcomida);

                    foreach ($Admintipos as $colTipo) {
                      
                  ?>
                  <tr>
                    <td><?php echo $colTipo['id']; ?></td>
                    <td><?php echo $colTipo['nombre']; ?></td>
                    <td><button class="btn btn-warning Editartipo" data-toggle='modal' data-target='#Editartipo'><span class="material-icons">create</span></button> </td>
                    <td><a href="../../modelos/eliminartipo.php?id=<?php echo $colTipo['id']; ?>" class="btn btn-danger"><span class="material-icons">delete</span></a></td>
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
  <div class="modal fade" id="Agregartipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Tipo de Comida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../modelos/nuevotipo.php" method="POST">
      <div class="modal-body">
        
        <div class="form-group">
          <label>Tipo de Comida</label>
          <input type="text" class="form-control" name="tipoC" placeholder="Ingrese Tipo de Comida.">
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

<div class="modal fade" id="Editartipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Editar Tipo de Comida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../modelos/editartipo.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="idTipo" id="update_id">
        <div class="form-group">
          <label>Tipo de Comida</label>
          <input type="text" class="form-control" name="TipoComida" id="tipoUpdate" placeholder="Ingrese Tipo de Comida.">
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

 $('.Editartipo').on('click',function(){

  $tr=$(this).closest('tr');

  var datos=$tr.children('td').map(function(){
    return $(this).text();
  });

  $('#update_id').val(datos[0]);
  $('#tipoUpdate').val(datos[1]);

 });

</script>
  </body>
</html>
