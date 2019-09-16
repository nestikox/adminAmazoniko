<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
						 <section class="content-header">
					<h1>Fechas de programacion
						<small>Información de fechas y postulaciones.</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li class="active">Programaciones</li>
					</ol>
				</section>
    <!-- Main content -->
						<section class="content">
         <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
         <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
             <h4> Datos de Programaciones </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="rutas" class="display hover responsive cell-border">
				<thead>
					<tr>
            <th>Id</th>
						<th>Ruta</th>
						<th>Dia</th>
						<th>Fecha</th>
            <th>Estatus</th>
            <th>Usuarios Registrados</th>
            <th>Opciones / Estado</th>
					</tr>
				</thead>
			<tbody></tbody>
			</table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
            </div>
          </div>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
      </div>
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
<?php if(isset($message)):?>
<!-- Modal -->
  <div class="modal fade" id="infoModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;Información</h4>
        </div>
        <div class="modal-body">
          <p><?php echo $message;?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
	<?php endif;?>
  <!-- Modal -->
  <div class="modal fade" id="cRecolecc" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;Confirmar Recolección</h4>
        </div>
        <div class="modal-body">
          <form role="form" enctype="multipart/form-data" id="recoleccion_form">
            <div class="row">
              <div class="col-md-4 form-group" style="display: inline-block;">
                <input type="hidden" class="form-control" id="fechaId" name="fechaid">
                <input type="hidden" class="form-control" id="programacionId" name="programacionid">
                <label for="fechaId">Fecha de Recoleccion:</label>
                <input type="text" class="form-control" id="fecha_show" name="fecha_show" readonly>
              </div>
              <div class="col-md-4 form-group" style="display: inline-block;">
                <label for="dia_recoleccion">Dia de Recoleccion:</label>
                <input type="text" class="form-control" id="dia_recoleccion" name="dia_recoleccion" readonly>
              </div>
              <div class="col-md-4 form-group" style="display: inline-block;">
                <label for="ruta">Ruta:</label>
                <input type="text" class="form-control" id="ruta" name="ruta_nombre" readonly>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="col-md-6">
            <button type="button" class="btn btn-default" style="float: left;" data-dismiss="modal">volver</button>
          </div>
          <div class="col-md-6">
            <button type="button" id="crearRecoleccionButton" class="btn btn-success pull-right">Crear Recoleccion &nbsp;<i id="loader_recoleccion" style="display:none;" class="fa fa-circle-o-notch fa-spin fa-fw"></i>
<span class="sr-only">Loading...</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- jQuery 3 
<script src="<?php echo base_url('resources/');?>bower_components/jquery/dist/jquery.min.js"></script>
  -->
<!-- jQuery UI 1.11.4 
<script src="<?php echo base_url('resources/');?>bower_components/jquery-ui/jquery-ui.min.js"></script>-->
<!-- Bootstrap 3.3.7-->
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<?php if(isset($message)):?>
		<script> setTimeout(function(){ $("#infoModal").modal(); },500);</script>
	<?php endif;?>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>
<!-- <script src="<?= base_url('resources/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('resources/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>-->
<script>
        $(document).ready(function(){
          $("#infoModal").modal();
            var es = {"decimal":"","emptyTable":"No hay datos disponibles...","info":"Mostrando _START_ a _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 a 0 de 0 entradas","infoFiltered":"(filtrado de _MAX_ total de entradas)","infoPostFix":"","thousands":",","lengthMenu":"Mostrar _MENU_ entradas","loadingRecords": "Cargando...","processing":"Procesando datos...","search":"Busqueda:","zeroRecords":"No se encontraron coincidencias.","paginate": {"first": "Primer","last":"Ultimo","next":"Próximo","previous":"Anterior"}};
            var datat = $('#rutas').DataTable( {
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "<?=site_url('ajax_request/get_fechas_programacion')?>",
                "language": es
                });
            setInterval( function () {datat.ajax.reload( null, false ); }, 15000 );
            
                $("#crearRecoleccionButton").on('click', function(){
                  var data = $('#recoleccion_form').serialize();
                  $("#loader_recoleccion").fadeIn();
                  $.ajax({
                    method: "POST",
                    url: "<?=site_url('ajax_request/crearNuevaRecoleccion')?>",
                    beforeSend: function(){	$("#cargador_holder").fadeIn();},
                    data: data, 
                    }).done(function(msg){
                      setTimeout(function(){$("#loader_recoleccion").fadeOut();},500);
                      r = JSON.parse(msg);
                      alert(r.m);
                      if(r.estado==1){
                        location.reload();
                      }else{
                        $("#cRecolecc").modal('hide');
                      }
                    });/*fin de ajax*/
                });
            });
        
        function crearRecoleccion(id){
          $.ajax({
            method: "POST",
            url: "<?=site_url('ajax_request/getRecoleccionFc')?>",
            beforeSend: function(){	$("#cargador_holder").fadeIn();},
            data: { programacion_fecha:id } 
            }).done(function(msg){
              console.log(msg);
              r = JSON.parse(msg);
              $("#programacionId").val(r.programacion_id);
              $("#ruta").val(r.nombre);
              $("#dia_recoleccion").val(r.dia);
              $("#fechaId").val(r.id);
              $("#fecha_show").val(r.nuevafecha);
              $("#cRecolecc").modal();
            });
        }
    </script>
</body>
</html>
