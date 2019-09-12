 <?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
						 <section class="content-header">
					<h1>
						Editar Unidad
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li><a href="#"> Configuracion </a></li>
            <li >Unidades</li>
            <li class="active">Editar unidad</li>
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
            <div class="box-header"></div>
              <div class="box-body">
                <form method="POST" action="<?php echo site_url('sistema/actualizarUnidad');?>">
                  <div class="col-md-6 form-group">
                    <label>Nombre de la unidad</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $unidad[0]->nombre?>">
                    <input type="hidden" class="form-control" name="unidad_id" value="<?php echo $unidad[0]->id?>">
                  </div>
                  <div class="col-md-6 form-group">
                    <button class="btn btn-success" style="margin-top:20px;">Guardar Unidad</button>
                  </div>
                </form>
              </div>
              </div>
              <!-- /.box-body --> 
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
    </section>
    <!-- /.content -->
  </div>
<?php echo $controlsidebar;?>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('resources');?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources');?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('resources');?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources');?>/dist/js/adminlte.min.js"></script>
<!--
<script src="<?= base_url('resources/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('resources/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
        $(document).ready(function(){
            var es = {"decimal":"","emptyTable":"No hay datos disponibles...","info":"Mostrando _START_ a _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 a 0 de 0 entradas","infoFiltered":"(filtrado de _MAX_ total de entradas)","infoPostFix":"","thousands":",","lengthMenu":"Mostrar _MENU_ entradas","loadingRecords": "Cargando...","processing":"Procesando datos...","search":"Busqueda:","zeroRecords":"No se encontraron coincidencias.","paginate": {"first": "Primer","last":"Ultimo","next":"Próximo","previous":"Anterior"}};
            $('#unidades_table').DataTable( {
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "<?=site_url('ajax_request/pag_unidades')?>",
                "language": es
                });
            });
    </script>-->
</body>
</html>
