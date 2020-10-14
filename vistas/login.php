<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Proyecto Restaurante</title>
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
    <link rel="stylesheet" href="../css/styles.css">
  </head>
  <body>
    <br /><br /><br /><br><br><br><br>
    <div style="margin: auto; box-shadow: rgba(0,0,0,0.4) 0px 0px 30px -5px;" class="card col-md-4 col-sm-10 text-center">
      <div class="card-body">
        <h2 class="card-title">Iniciar Sesión</h2>
        <hr>
        <div class="text-left">

          <form action="../modelos/loguear.php" method="POST">
            <div class="form-group">
              <label><strong>Usuario:</strong></label>
              <input
                placeholder="Ingrese su usuario."
                type="text"
                class="form-control"
                name="user"
              />
            </div>
            <div class="form-group">
              <label><strong>Contraseña:</strong></label>
              <input
                placeholder="Ingrese su contraseña."
                type="password"
                class="form-control"
                name="pass"
              />
            </div>
            <hr />
            <button type="submit" class="btn btn-primary btn-block">
              Ingresar
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
