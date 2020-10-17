<!--Modal -->


    <div class="modal fade" id="ModalMesero" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        
        <h4 style="margin-bottom: 0; margin-top: 15px;"
        <strong class="modal-title text-center" id="">Asignar Mesero</strong>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../modelos/asignarMeseros.php" method="POST">
        <div class="modal-body">
          
            <div class="form-group">
              <label>Mesa</label>
              <input type="hidden" class="form-control" id="mesa" name="mesa" readonly>
              <input type="text" class="form-control" id="numero" name="numero" readonly>
            </div>
            <div class="form-group">
              <label>Mesero</label>
              <select name="mesero" id="mesero" class="form-control">
                <option selected>Seleccione Mesero...</option>
                  <?php
                  $mesero = "SELECT * FROM usuarios where idRol = 3 and estado = 1";
                  $resultM = mysqli_query($conexion, $mesero);
                  while ($valores = mysqli_fetch_array($resultM)) {
                  echo '<option value="'.$valores['id'].'">'.$valores['nombre'].'</option>';
                  }
                  ?>
              </select>
            
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-primary">Asignar Mesero</button>
      </form>
      </div>
    </div>
  </div>
</div>