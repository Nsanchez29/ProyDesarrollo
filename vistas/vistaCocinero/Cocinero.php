<?php
    session_start();
    if(!isset($_SESSION['idRol'])){
        header('location: ../vistas/login.php');
    }else{
        if($_SESSION['idRol'] != 4){
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
    
    <?php include("../navbar/navbarCocinero.php");?>

    
</body>
</html>