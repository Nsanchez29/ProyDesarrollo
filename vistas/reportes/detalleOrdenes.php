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
        <div class="item">
          <?php
              include '../../config/conexion.php';                  
              if(isset($_POST['buscar']))                  
              {   
                    $fecha = $_POST['fecha'];
                    $orden = $_POST['orden'];
                    $consulta = "SELECT ord.id as numOrden, ord.fecha as fecha, mesa.numero as numMesa, mesa.cantidadMaxSillas as canSillas, user.nombre as usuario, tipCom.nombre as tipoComida, cons.nombre as nombreComida, cons.precio as precioComida, detOrd.cantidad as cantPlatos, detOrd.subTotal as subTotal, ord.total as total FROM consumoporordenes detOrd INNER JOIN ordenes ord on ord.id = detOrd.idOrden INNER JOIN mesas as mesa on mesa.id = ord.idMesa INNER JOIN usuarios as user on user.id = ord.idUsuario INNER JOIN consumibles cons on cons.id = detOrd.idConsumible INNER JOIN tipocomidas as tipCom on tipCom.id = cons.idTipoComida WHERE ord.fecha like '%$fecha%' AND ord.id LIKE '%$orden%'";
                    $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                    $datos2=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                    $otro=mysqli_fetch_array($datos2);
              ?>
              <div class="col-md-12">
              <div>
                <br>
                <h3 class="text-center font-weight-bold">Reporte de Ordenes</h3>
                <br>
                <h4 class="text-center font-weight-bold">Número de Orden:  <label><?=$otro['numOrden']?>  <span>|</span></label>  Fecha:   <label><?=$otro['fecha']?></label></h4>
                <br>
                <h5>Número de Mesa:  <label><?=$otro['numMesa']?></label></h5>
                <h5>Cantidad de Sillas:  <label><?=$otro['canSillas']?></label></h5>
                <h5>Usuario:  <label><?=$otro['usuario']?></h5>
              </div>
              <br>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center" scope="col">Tipo de Platillo</th>
                    <th class="text-center" scope="col">Nombre del Platillo</th>
                    <th class="text-center" scope="col">Precio</th>
                    <th class="text-center" scope="col">Cantidad</th>
                    <th class="text-center" scope="col">Sub Total</th>
                  </tr>
                </thead>
                <tbody> 
                <?php
                    while ($fila=mysqli_fetch_array($datos)){
                    ?> 
                    <tr>
                      <td class="text-center" scope="col"><?=$fila['tipoComida']?></td>
                      <td class="text-center" scope="col"><?=$fila['nombreComida']?></td>
                      <td class="text-center" scope="col"><?=$fila['precioComida']?></td>
                      <td class="text-center" scope="col"><?=$fila['cantPlatos']?></td>
                      <td class="text-center" scope="col"><?=$fila['subTotal']?></td>
                    </tr> 
                    <?php 
                        }
                        //$total=mysqli_fetch_array($datos2);
                        ?>
                    <tr>
                      <td class="text-center font-weight-bold" scope="col">Total:</td>
                      <td class="text-center" scope="col"></td>
                      <td class="text-center" scope="col"></td>
                      <td class="text-center" scope="col"></td>
                      <td class="text-center font-weight-bold" scope="col"><?=$otro['total']?></td>
                    </tr>
                </tbody>
              </table>
              <!--<div class="row align-items-center">
                <div class="col py-3 px-md-5 bordered col-example">Total</div>
                <div class="col-md-14"><?=$total['total']?></div>
              </div>-->
              <div class="col-md-10">
                <br>
                <a href="buscar.php" class="btn btn-primary mb-1 float-left">Nueva Busqueda
                  <i class="fas fa-file-pdf"></i>
                </a>   
                <a href="detalleOrdenesPDF.php?t=pdf&palabra=<?php echo urlencode($buscar);?>" id="GenerarMysql" class="btn btn-primary mb-3 float-right">Crear PDF
                  <i class="fas fa-file-pdf"></i>
                </a>                      
                <br>
              </div>
          <?php
              }
              ?>              
          </div>
        <hr>
      </div>
    </div>
  </body>
</html>