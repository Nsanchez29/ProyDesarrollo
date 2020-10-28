<?php

    /*session_start();

    if(!isset($_SESSION['idRol'])){
        header('location: ../vistas/login.php');
    }else{
        if($_SESSION['idRol'] != 1){
            header('location: ../vistas/login.php');
        }
    }*/

    //include '../../config/conexion.php';

?>
<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title></title>
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
    <!--<link rel="stylesheet" href="../../css/styles.css" />-->
  </head>
  <body>
          <?php
              include '../../config/conexion.php';                  
              if(isset($_GET['numOrden']))                  
              {   
                    $fecha = $_GET['fechaOrden'];
                    $orden = $_GET['numOrden'];
                    $consulta = "SELECT ord.numero as numOrden, ord.fecha as fecha, mesa.numero as numMesa, mesa.cantidadMaxSillas as canSillas, user.nombre as usuario, tipCom.nombre as tipoComida, cons.nombre as nombreComida, cons.precio as precioComida, detOrd.cantidad as cantPlatos, detOrd.subTotal as subTotal, ord.total as total FROM consumoporordenes detOrd INNER JOIN ordenes ord on ord.id = detOrd.idOrden INNER JOIN mesas as mesa on mesa.id = ord.idMesa INNER JOIN usuarios as user on user.id = ord.idUsuario INNER JOIN consumibles cons on cons.id = detOrd.idConsumible INNER JOIN tipocomidas as tipCom on tipCom.id = cons.idTipoComida WHERE ord.fecha like '%$fecha%' AND ord.numero LIKE '%$orden%'";
                    $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                    $dto=mysqli_fetch_array($datos);
              ?>
              <div class="col-md-12">
              <div>
                <br>
                <h3 class="text-center font-weight-bold">Reporte de Ordenes</h3>
                <br>
                <div class="">
                  <div class="">
                    <h4 class="text-center font-weight-bold">Número de Orden: <?=$dto['numOrden']?></h4>
                    <h4 class="text-center font-weight-bold">Fecha: <?=$dto['fecha']?></h4>
                  </div>
                <br>
                </div>
                <div class="float-left">
                  <div class="form-inline form-group mx-sm-3 mb-2">
                    <h5 class="font-weight-bold">Número de Mesa: <?=$dto['numMesa']?></h5>
                  </div>
                  <div class="form-inline form-group mx-sm-3 mb-2">
                    <h5 class="font-weight-bold">Cantidad de Sillas: <?=$dto['canSillas']?></h5>
                  </div>
                  <div class="form-inline form-group mx-sm-3 mb-3">
                    <h5 class="font-weight-bold">Usuario: <?=$dto['usuario']?></h5> 
                  </div>
                </div>
              </div>
              <br></br>
              <br></br>
              <br></br>
              <br></br>
              <br></br>
              <br></br>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-left" scope="col">Tipo de Platillo</th>
                    <th class="text-left" scope="col">Nombre del Platillo</th>
                    <th class="text-left" scope="col">Precio</th>
                    <th class="text-center" scope="col">Cantidad</th>
                    <th class="text-right" scope="col">Sub Total</th>
                  </tr>
                </thead>
                <tbody> 
                <?php
                    $campos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                    while ($fila=mysqli_fetch_array($campos)){
                    ?> 
                    <tr>
                      <td class="text-left" scope="col"><?=$fila['tipoComida']?></td>
                      <td class="text-left" scope="col"><?=$fila['nombreComida']?></td>
                      <td class="text-left" scope="col">Q. <?=$fila['precioComida']?></td>
                      <td class="text-center" scope="col"><?=$fila['cantPlatos']?></td>
                      <td class="text-right" scope="col">Q. <?=$fila['subTotal']?></td>
                    </tr> 
                    <?php 
                        }
                        ?>
                    <tr>
                      <td class="text-left font-weight-bold" scope="col">Total:</td>
                      <td class="text-left" scope="col"></td>
                      <td class="text-left" scope="col"></td>
                      <td class="text-left" scope="col"></td>
                      <td class="text-right font-weight-bold" scope="col">Q. <?=$dto['total']?></td>
                    </tr>
                </tbody>
              </table>
              <br>
          <?php
              }
              ?>              
          </div>
        <hr>
      </div>
    </div>
  </body>
</html>
<?php
require_once '../../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ReporteDetalleOrdenes.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>