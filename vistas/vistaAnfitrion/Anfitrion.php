<?php
    session_start();
    if(!isset($_SESSION['idRol'])){
        header('location: ../vistas/login.php');
    }else{
        if($_SESSION['idRol'] != 2){
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
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(245,8,8,1) 0%, rgba(252,19,19,1) 43%, rgba(242,131,131,1) 100%, rgba(255,255,255,1) 100%);
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
    
    <?php include("../navbar/navbarAnfitrion.php");?>

    <br><br>
    <div style="margin:auto;" class="col-md-10">
      <div class=" row">

        <?php
          include '../../config/conexion.php';
          $id = $_SESSION["idMesero"];
          $consulta =
          "SELECT m.id as id, m.numero as numero, m.cantidadMaxSillas as sillas, u.nombre as usuario, m.estado FROM ordenes o 
          INNER JOIN mesas m on o.idMesa = m.id
          INNER JOIN usuarios u on o.idUsuario = u.id
          WHERE m.estado !=0";
          $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
          while ($fila=mysqli_fetch_array($datos)){
            
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
                      echo "block";
                    };
                  
                    echo "</span></div>
                    
                    <h3 style='margin-bottom: 0; margin-top: 15px;' class='card-title'>
                      
                      <strong>Mesa No."; echo $fila['numero']; echo "</strong>
                    </h3>
                    
                  </div>
                  <hr>
                  <div class='text-center'>
                    <h1 class='orden'>";echo $fila['sillas']; echo "</h1><h3> Personas</h3>
                  </div>
                  <hr>
                  <div class='text-center'>
                    <small>Mesero Asignado: </small>";
                    echo "</h1>"; echo $fila['usuario']; echo "</h1>
                    
                  </div>
                  <div class='card-footer'>";
                  $boton = $fila['estado'];
                  if ($boton==2) {
                    echo "<button type='button' class='btn btn-primary btn-lg btn-block' disabled>Asignar Mesero</button>";
                  }else if ($boton ==1) {
                    $mesa = $fila['numero'];
                    $IdMesa = $fila['id'];
                    echo "<button id='btnModal' type='button' data-numero='$mesa' data-mesa='$IdMesa' class='btn btn-primary btn-lg btn-block ModalMesero' data-toggle='modal' data-target='#ModalMesero'>Asignar Mesero</button>";
                  };
                  echo "</div>
                </div>
              </div>
            </div>
            ";
          }
        ?>
      </div>
    </div>

<?php
          include 'modalAnfitrion.php';
?>

<script src="traspaso.js"></script>

</body>
</html>