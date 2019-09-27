<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Editar Usuario - Rutas<small></small></h1>
              <ol class="breadcrumb">
                <li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Rutas</a></li>
                <li><a href="<?php echo site_url('usuarios/ruta');?>">Usuario - Rutas</a></li>
                <li class="active"><a href="#">Editar Usuario - Rutas</a></li>
            </ol>
		</section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" method="POST" action="<?php echo site_url('usuarios/guardarUsuarioZona');?>">
              <div class="box-body">
                <div class="col-md-4 form-group">
                  <label>Nombres</label>
									<input type="hidden" name="userid" value="<?php echo $usuario->id;?>">
                  <input type="text" class="form-control" placeholder="Nombres" value="<?php echo $usuario->first_name;?>" name="nombre" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" placeholder="Apellidos" name="apellido" value="<?php echo $usuario->last_name;?>" required>
                </div>
								<div class="col-md-4 form-group">
                  <label>Identificación</label>
                  <input type="text" class="form-control" placeholder="RUT" value="<?php echo $usuario->rut;?>" name="ndoc"  required readonly>
                </div>
                <!--<div class="col-md-4 form-group">
                  <label>Tipo de Usuario</label>
                  <input type="text" class="form-control" placeholder="tipo de Usuario" value="<?php echo $usuario->grupo;?>" readonly>
                </div>-->
                  <div class="col-md-8 form-group">
                  <label>Zonas Disponibles:</label>
                  <select id="selectable" name="rutasUsuario[]" class="form-control" <?php if($usuario->grupo=='recolectores' or $usuario->grupo=='admin'){ echo "multiple";}?>>
                    <?php echo $rutasOp;?>
                  </select>
                </div>
					
							<style>
								.perfilimg{width:50%;min-height:100px;
									object-fit:contain;margin:2px 25%; 
									background-color:lightgrey;
								}
								.bar {
										height: 18px;background: green;
								}
							</style>
							
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
								<a class="pull-right btn btn-warning volver"  href="<?php echo site_url('usuarios/rutas');?>">Volver</a>
              </div>
            </form>
						<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
				progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
    }
    });
});
</script>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper 
  <footer class="main-footer"><div class="pull-right hidden-xs"><b>Version</b> 1.0</div><strong>Copyright &copy; Amazoniko 2019 </strong> All rights reserved.</footer>
-->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('resources/');?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('resources/');?>dist/js/demo.js"></script>

</body>
</html>
