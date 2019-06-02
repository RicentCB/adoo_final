<div id="back">

</div>

<div class="login-box">
    <div class="login-logo">
      <img src="view/img/plantilla/logo-blanco-bloque.png" class="img-responsive" style="padding: 30px 100px 0 100px">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Ingresa al Sistema</p>    

      <form method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Usuario" name="ingUser" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        
        <div class="row">
          <div class="col-xs-5">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          </div><!-- /.col -->
        </div>

        <?php

            $login = new ControllerUsers();
            $login -> ctrLoginUser();
        ?>

      </form>   

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->