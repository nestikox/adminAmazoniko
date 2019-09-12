<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
		<script>
														/*script para verificar si input esta chequeado si hay seleccionado.*/
														$(document).ready(function(){
															urlParaderos = '<?=site_url('rutas/listarParaderos')?>';
																	$('#listparada').click(function(e){
																		event.preventDefault(e);
																		if (!$("input[name='selectedF']:checked").val()){
																					alert('No ha seleccionado ruta.');
																						return false;
																		}
																		else {
																			sel = $("input[name='selectedF']:checked").val();
																								window.location.href= urlParaderos+'/'+sel;
																		}
																});				
															});
													</script>
    <!-- Content Header (Page header) -->
						<section class="content-header">
								<h1>Rutas<br>
										<small>Listado de Rutas en Amazóniko</small>
								</h1>
								<ol class="breadcrumb">
										<li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
										<li ><a href="#">Rutas</a></li>
										<li class="active"><a href="#">Listado de Rutas</a></li>
								</ol>
						</section>
    <!-- Main content -->
						<section class="content">
										<div class="box box-default">
												<div class="box-header with-border">
														<h3 class="box-title"><b>Listado de rutas</b></h3>
												</div>
												<div class="box-body">
														<div class="col-md-12" style="margin:3px 0px 10px 0px">
																		<div class="col-sm-2"><a href="<?=site_url('rutas/vcRuta');?>"><button type="button" id="crearRuta" class="btn btn-block btn-success">Crear Ruta</button></div></a>
																		<div class="col-sm-2"><button type="button" id="listparada" class="btn btn-block btn-success">Listar Paraderos</button></div>
																		<?php if(isset($message)):?>
																			<div class="col-sm-10">
																			 <div class="alert alert-info alert-dismissible">
																				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																				<strong>Información!</strong>
																				<?php echo $message;?>
																			 </div>
																			</div>
																			<?php endif;?>     
																		<?php //var_dump($rutas)?>
														</div>
																		<table id="rutas" class="display hover responsive cell-border">
																						<thead>
																										<tr>
																														<th>Id</th>
																														<th>Nombre de ruta</th>
																														<th>Paradas / Usuarios Registrados</th>
																														<th>Option</th>
																										</tr>
																						</thead>
																						<tbody>
																									
																						</tbody>
																		</table>
																		<?php ?>
												</div>
												<!-- /.box-body -->
										</div>
						</section>
					<!-- /.content -->
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper 
	<footer class="main-footer"><div class="pull-right hidden-xs"><b>Version</b> 1.0</div><strong>Copyright &copy; Amazoniko 2019 </strong> All rights reserved.</footer>
-->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>

<script src="<?= base_url('resources/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('resources/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
        $(document).ready(function(){
            var es = {"decimal":"","emptyTable":"No hay datos disponibles...","info":"Mostrando _START_ a _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 a 0 de 0 entradas","infoFiltered":"(filtrado de _MAX_ total de entradas)","infoPostFix":"","thousands":",","lengthMenu":"Mostrar _MENU_ entradas","loadingRecords": "Cargando...","processing":"Procesando datos...","search":"Busqueda:","zeroRecords":"No se encontraron coincidencias.","paginate": {"first": "Primer","last":"Ultimo","next":"Próximo","previous":"Anterior"}};
            $('#rutas').DataTable( {
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "<?=site_url('ajax_request/pag_rutas')?>",
                "language": es
                });
            });
    </script>
</body>
</html>
