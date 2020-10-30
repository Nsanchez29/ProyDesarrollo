
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
              if(isset($_GET['nombreMesero']))                  
              {   
                    $fechaDes = $_GET['fechaDesde'];
                    $fechaHas = $_GET['fechaHasta'];
                    $mesero = $_GET['nombreMesero'];
                    $consulta = "SELECT ord.numero as numOrden, mesa.numero as numMesa, ord.fecha as fecha, user.nombre as usuario, ord.total as total FROM consumoporordenes detOrd INNER JOIN ordenes ord on ord.id = detOrd.idOrden INNER JOIN mesas as mesa on mesa.id = ord.idMesa INNER JOIN usuarios as user on user.id = ord.idUsuario INNER JOIN consumibles cons on cons.id = detOrd.idConsumible INNER JOIN tipocomidas as tipCom on tipCom.id = cons.idTipoComida WHERE ord.fecha BETWEEN '$fechaDes' AND '$fechaHas' AND user.id = '$mesero' GROUP BY numOrden, numMesa";
                    $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                    $dto=mysqli_fetch_array($datos);
              ?>
              <div class="col-md-12">
              <div>
                <br>
                <h3 class="text-center font-weight-bold">Reporte de Meseros</h3>
                <br>
                <div class="">
                  <div class="">
                    <h4 class="text-center">Nombre de Mesero:  <?=$dto['usuario']?></h4>
                  </div>
                </div>
                <div class="">
                  <div class="">
                    <h4 class="text-center">Fecha Desde: <?=date("d-m-Y", strtotime($fechaDes))?>  |  Fecha Hasta: <?=date("d-m-Y", strtotime($fechaHas))?></h4>
                  </div>
                </div>
              </div>
              <br>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-left" scope="col">Número de Orden</th>
                    <th class="text-left" scope="col">Número de Mesa</th>
                    <th class="text-left" scope="col">Fecha</th>
                    <th class="text-right" scope="col">Total</th>
                  </tr>
                </thead>
                <tbody> 
                <?php
                    $campos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                    while ($fila=mysqli_fetch_array($campos)){
                    ?> 
                    <tr>
                      <td class="text-left" scope="col"><?=$fila['numOrden']?></td>
                      <td class="text-left" scope="col"><?=$fila['numMesa']?></td>
                      <td class="text-left" scope="col"><?=$fila['fecha']?></td>
                      <td class="text-right" scope="col">Q. <?=$fila['total']?></td>
                    </tr> 
                    <?php 
                        }
                        ?>
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
$filename = "ReporteDetalleMeseros.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>