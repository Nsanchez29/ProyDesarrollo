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
    ></script><!--
    <link rel="stylesheet" href="../../css/styles.css" />-->
  </head>
    <body>

    <h1>Reporte de La Orden</h1>
    <p>Listo PUTOS............</p>
      <?php
          include '../../config/conexion.php';
          if(isset($_GET['palabra'])) 
            {   
          ?>
          <div class="col-md-12">
          <br>
          <br>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th class="text-center" scope="col">Orden</th>
                <th class="text-center" scope="col">Comida</th>
                <th class="text-center" scope="col">Cantidad</th>
                <th class="text-center" scope="col">SubTotal</th>
                <th class="text-center" scope="col">Total</th>
                <th class="text-center" scope="col">Fecha</th>
              </tr>
            </thead>
            <tbody> 
            <?php
                $buscar = $_GET["palabra"];
                $consulta = "SELECT ord.id as numeroOrden, cons.nombre as nombreComida, detOrd.cantidad as cantidadComida, detOrd.subTotal as subTotal, ord.total as total, ord.fecha as fecha FROM consumoporordenes detOrd INNER JOIN ordenes ord on ord.id = detOrd.idOrden INNER JOIN consumibles cons on cons.id = detOrd.idConsumible WHERE ord.id like '%$buscar%'";
                $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                while ($fila=mysqli_fetch_array($datos)){
                ?> 
                <tr>
                  <td class="text-center" scope="col"><?=$fila['numeroOrden']?></td>
                  <td class="text-center" scope="col"><?=$fila['nombreComida']?></td>
                  <td class="text-center" scope="col"><?=$fila['cantidadComida']?></td>
                  <td class="text-center" scope="col"><?=$fila['subTotal']?></td>
                  <td class="text-center" scope="col"><?=$fila['total']?></td>
                  <td class="text-center" scope="col"><?=$fila['fecha']?></td>
                </tr> 
                <?php 
                    }
                    ?>
            </tbody>
          </table>
          </div>
      <?php
          }else
              {                  
          ?>
          <div class="col-md-12">
          <br>
          <br>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th class="text-center" scope="col">Orden</th>
                <th class="text-center" scope="col">Comida</th>
                <th class="text-center" scope="col">Cantidad</th>
                <th class="text-center" scope="col">SubTotal</th>
                <th class="text-center" scope="col">Total</th>
                <th class="text-center" scope="col">Fecha</th>
              </tr>
            </thead>
            <tbody> 
            <?php
                $consulta = "SELECT ord.id as numeroOrden, cons.nombre as nombreComida, detOrd.cantidad as cantidadComida, detOrd.subTotal as subTotal, ord.total as total, ord.fecha as fecha FROM consumoporordenes detOrd INNER JOIN ordenes ord on ord.id = detOrd.idOrden INNER JOIN consumibles cons on cons.id = detOrd.idConsumible";
                $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                while ($fila=mysqli_fetch_array($datos)){
                ?> 
                <tr>
                  <td class="text-center" scope="col"><?=$fila['numeroOrden']?></td>
                  <td class="text-center" scope="col"><?=$fila['nombreComida']?></td>
                  <td class="text-center" scope="col"><?=$fila['cantidadComida']?></td>
                  <td class="text-center" scope="col"><?=$fila['subTotal']?></td>
                  <td class="text-center" scope="col"><?=$fila['total']?></td>
                  <td class="text-center" scope="col"><?=$fila['fecha']?></td>
                </tr> 
                <?php 
                    }
                    ?>
            </tbody>
          </table>
          </div>
      <?php
          }
          ?> 
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