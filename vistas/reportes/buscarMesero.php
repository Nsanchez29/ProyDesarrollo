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

    $tiposUsuarios = "select * from usuarios where idRol = 3";
    $obtener=mysqli_query($conexion,$tiposUsuarios) or die(mysqli_error($conexion));

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
          <div class="item">
          <div class="item">
            <div class="container h-100">
            <div class="row justify-content-center h-100">
            <div class="col-sm-10 align-self-center text-center">
              <div class="card shadow">
              <div class="card-body align-self-center text-center"> 
                <form method="POST" action="detalleMesero.php" onSubmit="return validarForm(this)">
                  <br></br>
                  <h3>Buscar Mesero</h3>
                  <br>
                  <div  class="form-inline">
                  <div class="form-group mx-sm-3 mb-5">
                    <h5>Fecha Desde:&nbsp</h5><input type="date" class="form-control" name="fechaDes" placeholder="Fecha Desde">
                  </div>
                  <div class="form-group mx-sm-3 mb-5">
                    <h5>Fecha Hasta:&nbsp</h5><input type="date" class="form-control" name="fechaHas" placeholder="Fecha Hasta">
                  </div>
                  </div>
                  <div class="form-group mx-sm-3 mb-5">
                    <h5>Nombre de Mesero</h5>
                  <select class="container text-center h-100 d-flex justify-content-center align-items-center form-control col-md-8" name="mesero">
                    <option value="0">Selecciona un Mesero</option>
                    <?php
                      while ($row=mysqli_fetch_array($obtener)){
                        echo"<option value='";echo $row['id']; echo"'>";echo $row['nombre'];echo"</option>";
                      }
                    ?>
                  </select>
                  </div>
                    <input type="submit" value="Buscar" id="buscar" name="buscar" class="btn btn-primary btn-lg mb-3">
                </form>
              </div>
              </div>
            </div>
            </div>
            </div>
          </div>
          </div>      
        </div>
      </div>
    </div>
  <script type="text/javascript">
      function validarForm(formulario) 
      {
          if(formulario.fechaDes.value.length==0 || formulario.fechaHas.value.length==0 || formulario.mesero.value==0) 
          { //¿Tiene 0 caracteres?
              formulario.fechaDes.focus();  // Damos el foco al control
              formulario.fechaHas.focus();
              formulario.mesero.focus();
              alert('Debes rellenar este campo'); //Mostramos el mensaje
              return false; 
           } //devolvemos el foco  
           return true; //Si ha llegado hasta aquí, es que todo es correcto 
       }

       /*$(function(){
        $('#buscar').click(function(){
          $('#form').hide();
        });
      }) */ 
  </script>
  </body>
</html>