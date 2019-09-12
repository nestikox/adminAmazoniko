<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
<link href='<?php echo base_url('resources/mod.calendar');?>/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url('resources/mod.calendar');?>/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <?php echo $header;?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
						 <section class="content-header">
					<h1>
						Tablero Principal
						<small>Panel de Control</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li class="active">Tablero Principal</li>
					</ol>
				</section>
    <!-- Main content -->
		<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $dashboard->programaciones;?></h3>
              <p>Solicitudes de Recolección</p>
            </div>
            <div class="icon">
              <i class="ion ion-trash-b"></i>
            </div>
            <a href="<?php echo site_url('programaciones');?>" class="small-box-footer">Mas Información<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $dashboard->usuarios;?></h3>
              <p>Registros de usuarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo site_url('usuarios');?>" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $dashboard->rutas;?></h3>
              <p>Rutas</p>
            </div>
            <div class="icon">
              <i class="ion ion-compass"></i>
            </div>
            <a href="<?php echo site_url('rutas');?>" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
      <section class="col-lg-12 connectedSortable">
         <!-- Chat box -->
          <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Calendario de recolecciones.</h3>
            </div>
            <div class="box-body chat" id="chat-box">
            <div id='calendar2'></div>
            </div>
            <!-- /.chat -->
            <div class="box-footer">
              
            </div>
          </div>
          <!-- /.box (chat box) -->
        </section>
      </div>
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
	<script></script>
	<?php endif;?>
  <!-- Modal -->
  <div class="modal fade" id="eventModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Detallar Evento</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3 form-group">
              <input type="text" name="idEvento" id="idEvento" disabled>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<?php if(isset($message)):?>
		<script> setTimeout(function(){  $("#infoModal").modal(); },500);</script>
	<?php endif;?>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
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
<script src='<?php echo base_url('resources/mod.calendar');?>/lib/moment.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src='<?php echo base_url('resources/mod.calendar');?>/fullcalendar.min.js'></script>
<script src='<?php echo base_url('resources/mod.calendar');?>/locale-all.js'></script>
<script>
	<?php if(isset($message)):?>
	setTimeout(function(){$("#infoModal").modal(); },500);
	<?php endif;?>
	$(document).ready(function() {
    var initialLocaleCode = 'es';
    
		$.ajax({
		method: "POST",
		url: "<?=site_url('ajax_request/getProgramacionesAdmin')?>",
		beforeSend: function(){	$("#cargador_holder").fadeIn();},
		data: { usuario:<?=$this->session->userdata('user_id')?> }
		})
		.done(function( msg ) {
			$("#cargador_holder").fadeOut("slow");
			msg = msg.substring(0, msg.length - 1);
			msg = "["+msg+"]";
			array = JSON.parse(msg);
			
			
			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();
			today = yyyy + '-' + mm + '-' + dd ;
			
			$('#calendar2').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				locale: initialLocaleCode,
				defaultDate: today,
				navLinks: true, // can click day/week names to navigate views
				editable: false,
				eventLimit: true, // allow "more" link when too many events
				events: array,
        eventClick: function(info) {
          $("#idEvento").val(info.id);
          console.log(info);
          $("#eventModal").modal();
          //info.jsEvent.preventDefault(); // don't let the browser navigate
        }
			});
		});
		
	/*	$.ajax({
		method: "POST",
		url: "<?=site_url('ajax_request/getProgramacionesUsuario')?>",
		beforeSend: function(){	$("#cargador_holder").fadeIn();},
		data: { metodo: "obtenerProgramaciones" }
		})
		.done(function( msg ) {
			$("#cargador_holder").fadeOut("slow");
			msg = msg.substring(0, msg.length - 1);
			msg = "["+msg+"]";
			array = JSON.parse(msg);
			

			console.log(array);
			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();
			today = yyyy + '-' + mm + '-' + dd ;
			
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				locale: initialLocaleCode,
				defaultDate: today,
				navLinks: true, // can click day/week names to navigate views
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				events: array
			});
		});*/
	});

</script>
</body>
</html>
