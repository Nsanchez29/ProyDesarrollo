<nav style="box-shadow: rgba(0,0,0,0.5) 0px 0px 20px 0px;" class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="../vistaAdmin/Admin.php"><strong>Restaurante</strong></a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reportes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../reportes/buscar.php">Detalle por Orden.</a>
                <a class="dropdown-item" href="#">Ordenes por Mesero.</a>
              </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a href="../vistaAdmin/mesas.php" style="margin: 2.5px;" type="button" class="btn btn-outline-secondary">Mesas</a>
          <a href="../vistaAdmin/usuarios.php" style="margin: 2.5px;" type="button" class="btn btn-outline-secondary">Usuarios</a>
          
          <a href="../vistaAdmin/tiposcomida.php" style="margin: 2.5px;" type="button" class="btn btn-outline-secondary">Tipos Comida</a>
          
          <a href="../vistaAdmin/platillos.php" style="margin: 2.5px;" type="button" class="btn btn-outline-secondary">Platillos</a>
          
          <a data-toggle="tooltip" data-placement="bottom" title="Cerrar Sesión" style="padding:0px;" href="../../modelos/salir.php" style="margin: 2.5px;" type="button" class="btn btn-danger"/>
            <span style="font-size: 20px; margin: 7px 10px 7px 6px;" class="material-icons">exit_to_app</span>
            </a>
        </form>
      </div>
    </nav>