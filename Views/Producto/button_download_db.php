<div class="container">
  <center>
    <form action='Controllers/producto_controller.php' method='get'>
      <input type="hidden" name="action" value="download">
      <label>Ingresa el nombre del archivo</label><br>
      <label>ó dejelo por defecto</label><br>
      <input type="text" name="name_file" value="OCOMPRA"><br><br>
      <Button type="submit" class="btn btn-success"><span class="oi" data-glyph="data-transfer-download"></span>
        Descargar DB de Productos
      </Button>
    </form>
  </center>
</div>
