 <section>
    <h3 align="center">Registro de Usuario:</h3>
   <div class="container">
    <form action='Controllers/usuario_controller.php' method='post' id="register_form">
      <input type='hidden' name='action' value='register'>

      <div class="form-group">
      <label>Usuario:</label>
      <input class="form-control" type="text" name="username" maxlength="30" placeholder="Nombre">
      </div>
      <div class="form-group">
      <label >Password:</label>
      <input class="form-control" type="password" name="password" maxlength="30" placeholder="Password" autocomplete="off">
      </div>
      <div class="form-group">
      <label >Cargo:</label>
      <input class="form-control" type="text" name="cargo" maxlength="30" placeholder="Cargo">
      </div>
      <div class="form-group">
      <label >Nombre:</label>
      <input class="form-control" type='text' name='nombre' maxlength="30" placeholder="Cargo">
      </div>
      <div class="form-group">
      <label >E-mail:</label>
      <input class="form-control" type="email" name="email" maxlength="30" placeholder="E-mail">
      </div>
      <button class="btn-primary">Enviar</button>
    </form>
  </div>
</section>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
