  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Categorias
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Categorias</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">  
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddCategory">Agregar Categoria</button>
        </div>

        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tabla-dt">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nombre</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $categorias = ControladorCategorias::ctrMostrarCategorias(null, null); //item, valor
                $cont = 1;

                foreach ($categorias as $categoria) {

                  echo 
                  '<tr>
                    <td>'.$cont.'</td>
                    <td>'.$categoria["categoria"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$categoria["id_categoria"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger"><i class="fa fa-times"></i></button>
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

  <!-- =======================================================================
    Modal Window Add Category 
  =========================================================================-->
  <div id="modalAddCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content"><form role="form" method="post" >
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button class="close" type="button" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Categoria</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group"> <!-- Input Nombre -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresa Categoria" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Categoria</button>
        </div>
        <?php
          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();
        ?>
      </form></div>
    </div>
  </div>
  <!-- =======================================================================
    Modal Editar Categoria 
  =========================================================================-->
  <div id="modalEditarCategoria" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content"><form role="form" method="post" >
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button class="close" type="button" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Categoria</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group"> <!-- Input Nombre -->
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" placeholder="Ingresa Categoria" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
        <?php
          // $crearCategoria = new ControladorCategorias();
          // $crearCategoria -> ctrCrearCategoria();
        ?>
      </form></div>
    </div>
  </div>
