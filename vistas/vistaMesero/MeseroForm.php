 <!--<?php
   /* session_start();
    if(!isset($_SESSION['idRol'])){
        header('location: ../vistas/login.php');
    }else{
        if($_SESSION['idRol'] != 3){
            header('location: ../vistas/login.php');
        }
    }

*/
?>-->

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
      <div class="card col-md-10" style=" margin: auto;  box-shadow: rgba(0,0,0,0.2) 0px 0px 20px 0px;">
 
  <div class="card-body">
      <div class="item">
        <div class="card-title">
          <h3><strong>Orden #10</strong></h3>
          <h5>Mesa No.1</h5>
        </div>
        <span class="spacer"></span>
        <button style="height: fit-content;margin: auto 5px;" type="button" class="btn btn-primary"><span class="material-icons">add</span></button>
        <button style="height: fit-content;margin: auto 5px;" type="button" class="btn btn-success"><span class="material-icons">done_outline</span></button>
      </div>
    <hr style="margin-top:0px">

    <div>
      <div class="col-md-12">  
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Cantidad</th>
              <th  class="text-center" scope="col">Opciones</th>
              <th class="text-right" scope="col">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td class="text-center" >
                <button type="button" style="color:white;" class="btn btn-warning  btn-sm"><span class="material-icons">create</span></button>
                <button type="button" class="btn btn-danger btn-sm"><span class="material-icons">delete</span></button>
              </td>
              <td class="text-right">@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td class="text-center" >
                <button type="button" style="color:white;" class="btn btn-warning  btn-sm"><span class="material-icons">create</span></button>
                <button type="button" class="btn btn-danger btn-sm"><span class="material-icons">delete</span></button>
              </td>
              <td class="text-right">@mdo</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td class="text-center" >
                <button type="button" style="color:white;" class="btn btn-warning  btn-sm"><span class="material-icons">create</span></button>
                <button type="button" class="btn btn-danger btn-sm"><span class="material-icons">delete</span></button>
              </td>
              <td class="text-right">@mdo</td>
            </tr>
          </tbody>
        </table>
      </div>    
    </div> 
    
    <hr>
            <div class='col-md-12 item'>
              <span><strong>Total:</strong></span>
              <span class='spacer'></span>
              <span>Q.40.00</span>
              </div>
    <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
  </div>
</div>
      

      </div>
    </div>
  </body>
</html>