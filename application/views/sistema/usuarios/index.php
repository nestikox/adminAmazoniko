<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuario
        <small>Listado de Usuarios del Sistema</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i>Tablero Principal</a></li>
        <li class="active"><i class="fa fa-user"></i> Usuarios</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Usuarios de Amazoniko</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
								<?php if(isset($message)):?>
                 <div class="col-sm-10">
                  <div class="alert alert-info alert-dismissible">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Información!</strong>
                   <?php echo $message;?>
                  </div>
                 </div>
                 <?php endif;?>     
                <div class="col-md-12">
                        <a href="<?= site_url('usuarios/vCrearUsuario') ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Crear Usuario</a>
                   
                </div>
                <div class="col-md-12 datatable-contenedor" >
                    <div >
                        <!-- /.box-body -->
                        <table id="usuariosT" class="display hover responsive cell-border" style="overflow:scroll; width:100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Amazóniko</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Tipo Usuario</th>
                                <th>Puntos</th>
                                <th>Opciones / Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
              <!-- /.box-body -->
							
							<script>
								$(document).ready(function(){
										var es = {"decimal":"","emptyTable":"No hay datos disponibles...","info":"Mostrando _START_ a _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 a 0 de 0 entradas","infoFiltered":"(filtrado de _MAX_ total de entradas)","infoPostFix":"","thousands":",","lengthMenu":"Mostrar _MENU_ entradas","loadingRecords": "Cargando...","processing":"Procesando datos...","search":"Busqueda:","zeroRecords":"No se encontraron coincidencias.","paginate": {"first": "Primer","last":"Ultimo","next":"Próximo","previous":"Anterior"}};
										$('#usuariosT').DataTable( {
												"processing": true,
												"serverSide": true,
												"ordering": false,
												"ajax": "<?=site_url('ajax_request/pag_usuarios')?>",
												"language": es
												});
										});
						</script>
							
            </form>
          </div>
          <!-- /.box -->
        </div>
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

