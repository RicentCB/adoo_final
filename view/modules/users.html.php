  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">  
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">Agregar Usuario</button>
        </div>

        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tabla-dt">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo Login</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Usuario Admin</td>
                <td>admin</td>
                <td><img src="view/img/usuarios/default/anonymous.png" clas="img-thumbnail" width="40px"></td>
                <td>Administrador</td>
                <td><button class="btn btn-success btn-xs">Activado</button></td>
                <td>2019-12-11 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td>Usuario Admin</td>
                <td>admin</td>
                <td><img src="view/img/usuarios/default/anonymous.png" clas="img-thumbnail" width="40px"></td>
                <td>Administrador</td>
                <td><button class="btn btn-success btn-xs">Activado</button></td>
                <td>2019-12-11 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td>Usuario Admin</td>
                <td>admin</td>
                <td><img src="view/img/usuarios/default/anonymous.png" clas="img-thumbnail" width="40px"></td>
                <td>Administrador</td>
                <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
                <td>2019-12-11 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>  
        </div>
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- =======================================================================
    Modal Window Add User 
  =========================================================================-->
  <div id="modalAddUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content"><form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button class="close" type="button" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group"> <!-- Input Nombre -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresa nombre" required>
              </div>
            </div>
            <div class="form-group"> <!-- Input Usuario -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresa usuario" required>
              </div>
            </div>
            <div class="form-group"> <!-- Input Password -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPasswprd" placeholder="Ingresa contraseña" required>
              </div>
            </div>
            <div class="form-group"> <!-- Seleccionar Perfil -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="nuevoPerfil" class="form-control input-lg">
                  <option value="">Seleccionar Perfil</option>
                  <option value="1">Administrador</option>
                  <option value="2">Especial</option>
                  <option value="3">Vendedor</option>
                </select>
              </div>
            </div>
            <div class="form-group"> <!-- Subir Foto -->
              <div class="panel">SUBIR FOTO</div>
              <input type="file" name="nuevaFoto" id="nuevaFoto">
              <p class="help-block">Peso m&aacute;ximo de la foto 2MB</p>
              <img src="view/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>
      </form></div>
    </div>
  </div>
