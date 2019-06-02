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
          <button class="btn btn-primary" id="btnAddUser" data-toggle="modal" data-target="#modalAddUser">Agregar Usuario</button>
        </div>

        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tabla-dt" style="width: 100%">
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
              <?php
                $item = NULL;
                $valor = NULL;
                $usuarios = ControllerUsers::ctrShowUser($item, $valor);

                $cont = 1;
                foreach($usuarios as $user){
                  //Perfil
                  $perfil = "";
                  switch ($user["perfil"]) {
                    case '1': $perfil = "Administrador"; break;
                    case '2': $perfil = "Especial"; break;
                    case '3': $perfil = "Vendedor"; break;
                    default: break;
                  }
                  //Imagen
                  $imagen = "view/img/usuarios/default/anonymous.png";
                  if($user["foto"] != NULL){ $imagen = $user["foto"];}
                  //Usuario Activo o Inactivo
                  $btnActivado = '<button edoUsuario="0" idUsuario="'.$user["id_usuario"].'" class="btn btn-success btn-xs btn-activar-usuario">Activado</button>';
                  if($user["estado"] == '0')//Estado desactivado
                    $btnActivado = '<button edoUsuario="1" idUsuario="'.$user["id_usuario"].'" class="btn btn-danger btn-xs btn-activar-usuario">Desactivado</button>';
                  // ----------------- Imprimir Informacion -----------------
                  echo '
                    <tr>
                      <td>'.$cont.'</td>
                      <td>'.$user["nombre"].'</td>
                      <td>'.$user["usuario"].'</td>
                      <td><img src="'.$imagen.'" clas="img-thumbnail" width="40px"></td>
                      <td>'.$perfil.'</td>
                      <td>'.$btnActivado.'</td>
                      <td>'.$user["ultimo_login"].'</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning btnEditarUsuario" idUser="'.$user["id_usuario"].'" data-toggle="modal" data-target="#modalEditUser"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$user["id_usuario"].'" fotoUsuario="'.$user["foto"].'" usuario="'.$user["usuario"].'"><i class="fa fa-times"></i></button>
                        </div>
                      </td>
                    </tr>';
                    $cont ++;
                }
              ?>
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

  <!-- ======================================================================
    Modal Window Add User 
  ========================================================================-->
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
                <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder="Ingresa usuario" required>
              </div>
            </div>
            <div class="form-group"> <!-- Input Password -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresa contraseña" required>
              </div>
            </div>
            <div class="form-group"> <!-- Seleccionar Perfil -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="nuevoPerfil" class="form-control input-lg" requred>
                  <option value="">Seleccionar Perfil</option>
                  <option value="1">Administrador</option>
                  <option value="2">Especial</option>
                  <option value="3">Vendedor</option>
                </select>
              </div>
            </div>
            <div class="form-group"> <!-- Subir Foto -->
              <div class="panel">SUBIR FOTO</div>
              <input type="file" name="nuevaFoto" class="nuevaFoto">
              <p class="help-block">Peso m&aacute;ximo de la foto 2MB</p>
              <img src="view/img/usuarios/default/anonymous.png" class="img-thumbnail img-previsualizar" width="100px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>
        <?php
          $crearUsuario = new ControllerUsers();
          $crearUsuario -> ctrCreateUser();
        ?>
      </form></div>
    </div>
  </div>
  <!-- ======================================================================
    Modal Window Edit User 
  ========================================================================-->
  <div id="modalEditUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content"><form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button class="close" type="button" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group"> <!-- Input Nombre -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" placeholder="Ingresa nombre" required>
              </div>
            </div>
            <div class="form-group"> <!-- Input Usuario -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" placeholder="Ingresa usuario" readonly>
              </div>
            </div>
            <div class="form-group"> <!-- Input Password -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba nueva contraseña">
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>
            <div class="form-group"> <!-- Seleccionar Perfil -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select id="editarPerfil" name="editarPerfil" class="form-control input-lg">
                  <!-- <option value="" id="editarPerfil">Editar Perfil</option> -->
                  <option value="1">Administrador</option>
                  <option value="2">Especial</option>
                  <option value="3">Vendedor</option>
                </select>
              </div>
            </div>
            <div class="form-group"> <!-- Subir Foto -->
              <div class="panel">SUBIR FOTO</div>
              <input type="file" name="editarFoto" class="nuevaFoto">
              <p class="help-block">Peso m&aacute;ximo de la foto 2MB</p>
              <img src="view/img/usuarios/default/anonymous.png" class="img-thumbnail img-previsualizar" width="100px">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Usuario</button>
        </div>
        <?php
          $editarUsuario = new ControllerUsers();
          $editarUsuario -> ctrEditUser();
        ?>
      </form></div>
    </div>
  </div>

  <?php
  $borrarUsuario = new ControllerUsers();
  $borrarUsuario -> ctrBorrarUsuario();

  ?> 

