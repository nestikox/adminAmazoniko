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
																		if (!$("input[name='selectedF']:checked").val()) {
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
								<h1>Listado de Rutas de usuarios<br>
										<small></small>
								</h1>
								<ol class="breadcrumb">
										<li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
										<li><a href="#">Rutas</a></li>
										<li class="active"><a href="#">Usuario - Rutas</a></li>
								</ol>
						</section>
    <!-- Main content -->
						<section class="content">
										<div class="box box-default">
												<div class="box-header with-border">
														<h3 class="box-title"><b>Usuario - Rutas</b></h3>
												</div>
												<div class="box-body">
														<div class="col-md-12" style="margin:3px 0px 10px 0px">
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
																														<th>Nombre de Usuario</th>
                                                            <th>Correo</th>
																														<th>Rutas Asociadas</th>
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
<!-- ./wrapper -->

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
<!-- Morris.js charts -->
<script src="<?php echo base_url('resources/');?>bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url('resources/');?>bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('resources/');?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url('resources/');?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('resources/');?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('resources/');?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('resources/');?>bower_components/fastclick/lib/fastclick.js"></script>
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
                "ajax": "<?=site_url('ajax_request/pag_rutas_usuarios')?>",
                "language": es
                });
            });
    </script>
</body>
</html>
