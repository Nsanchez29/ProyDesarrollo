<?php
    session_start();
    if(!isset($_SESSION['idRol'])){
        header('location: ../vistas/login.php');
    }else{
        if($_SESSION['idRol'] != 3){
            header('location: ../vistas/login.php');
        }
    }


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
    <div style="margin:auto;" class="col-md-10">
      <div class=" row">

        <?php
          include '../../config/conexion.php';
          $id = $_SESSION["idMesero"];
          $consulta =
          "select ord.numero as numeroOrden, ord.total as totalOrden, ord.estado, ord.fecha, mes.numero as numeroMesa, mes.cantidadMaxSillas 
          from ordenes ord INNER JOIN usuarios usu on usu.id = ord.idUsuario 
          INNER JOIN mesas mes on mes.id = ord.idMesa WHERE ord.estado = 1 or ord.estado = 2 and ord.idUsuario = $id";
          $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
          while ($fila=mysqli_fetch_array($datos)){
            // echo 
            // "<div  class='col-md-4'>
            //   <div style='box-shadow: 0 1px 4px 0 rgba(0,0,0,.14);' class='card mb-4'>
            //     <div class='card-body'>
            //       <h3 class='card-title'><strong>Mesa No.</strong>";echo $fila['numeroMesa']; echo "</h3>
            //     </div>
            //   </div>
            // </div>";

            echo
            "
            <div  class='col-md-4'>
              <div  class='card mb-4 sombra'>
                <div class='card-body'>
                  <div class='item'>
                    <div class='";
                    $estado = $fila['estado'];
                    if($estado == 1) {
                      echo "box-accept";
                    } else if($estado == 2) {
                      echo "box-waiting";
                    };
                    echo " sombra'><span class='material-icons'>";
                    
                    if($estado == 1) {
                      echo "done_outline";
                    } else if($estado == 2) {
                      echo "av_timer";
                    };
                  
                    echo "</span></div>
                    <h3 style='margin-bottom: 0; margin-top: 15px;' class='card-title'>
                      <strong>Mesa No."; echo $fila['numeroMesa']; echo "</strong>
                    </h3>
                  </div>
                  <hr>
                  <div class='text-center'>
                    <h1 class='orden'>#";echo $fila['numeroOrden']; echo "</h1>
                  </div>
                  <hr>
                  <div class='col-md-12 item'>
                    <span><strong>Total:</strong></span>
                    <span class='spacer'></span>
                    <span>Q"; echo $fila['totalOrden']; echo "</span>
                  </div>
                </div>
              </div>
            </div>
            ";
          }
        ?>

            <!-- <div  class='col-md-4'>
              <div  class='card mb-4 sombra'>
                <div class='card-body'>
                  <div class="item">
                    <div class="box-waiting sombra"  ><span class="material-icons">av_timer</span></div>
                    <h3 style="margin-bottom: 0; margin-top: 15px;" class='card-title'>
                      <strong>Mesa No.1</strong>
                    </h3>
                  </div>
                  <hr>
                  <div class="text-center">
                    <h1 class="orden">#53</h1>
                  </div>
                  <hr>
                  <div class="col-md-12 item">
                    <span><strong>Total:</strong></span>
                    <span class="spacer"></span>
                    <span>Q100</span>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- <div  class='col-md-4'>
              <div  class='card mb-4 sombra'>
                <div class='card-body'>
                  <div class="item">
                    <div class="box-accept sombra"  ><span class="material-icons">done_outline</span></div>
                    <h3 style="margin-bottom: 0; margin-top: 15px;" class='card-title'>
                      <strong>Mesa No.9</strong>
                    </h3>
                  </div>
                  <hr>
                  <div class="text-center">
                    <h1 class="orden">#1</h1>
                  </div>
                  <hr>
                  <div class="col-md-12 item">
                    <span><strong>Total:</strong></span>
                    <span class="spacer"></span>
                    <span>Q100</span>
                  </div>
                </div>
              </div>
            </div> -->


        

      </div>
    </div>
  </body>
</html>