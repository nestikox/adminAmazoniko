<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<link href='<?php echo base_url('resources/mod.calendar');?>/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url('resources/mod.calendar');?>/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<style>
	body {padding: 0;font-family: 'Oxygen', Arial, Helvetica, 'Nimbus Sans L', sans-serif;font-size: 14px;}
	#calendar {max-width: 900px;margin: 0 auto;}
	#cargador{position: absolute;height: 100px;width: 100px;top: 50%;left: 50%;margin-left: -50px;margin-top: -50px;}
	#cargador_holder{width: 100%;min-height: 100vh;position: absolute;background-color: rgba(136, 131, 131, 0.4196078431372549);z-index: 1000;}
</style>
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<img src="images/black-and-white.jpg" width="100%">
   <!-- Content Header (Page header) -->
						 <section class="content-header">
					<h1>Dashboard
						<small>Tablero Principal</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li class="active">Tablero Principal</li>
					</ol>
				</section>
    <!-- Main content -->
    <style>
      .calendarHolder{padding: 30px;}
      #calendar2, #calendar{border: 1px solid #25502559;}
    </style>
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua-gradient">
            <div class="inner">
              <h3><?php echo (isset($dashboard->reciclado)?$dashboard->reciclado:'0');?></h3>
              <p>Papel/cart&oacute;n/metal reciclado</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green-gradient">
            <div class="inner">
              <h3><?php echo (isset($dashboard->plastico)?$dashboard->plastico:'0');?><sup style="font-size: 20px"></sup></h3>
              <p>Pl&aacute;stico reciclado</p>
            </div>
            <div class="icon">
              <i class="ion ion-leaf"></i>
            </div>
          </div>
        </div>
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow-gradient">
            <div class="inner">
              <h3><?php echo (isset($dashboard->puntos)?$dashboard->puntos:'0');?><sup style="font-size: 20px"></sup></h3>
              <p>Puntos Ganados</p>
            </div>
            <div class="icon">
              <i class="ion ion-star"></i>
            </div>
            
          </div>
        </div>
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="http://190.146.247.240/amazoniko/amazonikoAA/programaciones"><div class="small-box bg-blue-gradient">
            <div class="inner">
              <h3><sup style="font-size: 20px">&nbsp;</sup></h3>
              <p>Programar recolección</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
          </div></a>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tus Estadísticas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Total reciclado anual</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Tu huella</strong>
                  </p>
                  <div class="progress-group">
                    <span class="progress-text">Reducción en Carbono</span>
                    <span class="progress-number"><b>11,8</b> kgCO2e</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 20%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Ahorro de energía</span>
                    <span class="progress-number"><b>9</b> kwh</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 10%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Televisores sin utilizar</span>
                    <span class="progress-number"><b>2</b> / mes</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 25%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Arboles dejados de talar</span>
                    <span class="progress-number"><b>1</b> Arbol</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 10%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>

            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
          <p id="message_modal"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
	<script></script>
	<?php endif;?>
<!-- jQuery 3 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script> $.widget.bridge('uibutton', $.ui.button); </script>
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
<script src='<?php echo base_url('resources/mod.calendar');?>/lib/moment.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src='<?php echo base_url('resources/mod.calendar');?>/fullcalendar.min.js'></script>
<script src='<?php echo base_url('resources/mod.calendar');?>/locale-all.js'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>
<script>
	<?php if(isset($message)):?>
	setTimeout(function(){
		var m = '<?=$message?>';
		$("#message_modal").html('');
		$("#message_modal").html(m);
		$("#infoModal").modal(); },500);
	<?php endif;?>
	$(document).ready(function() {
    var initialLocaleCode = 'es';
    /*$('#calendar2').fullCalendar({
      header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
      height: 400,
      locale: initialLocaleCode
    });*/
		
		$.ajax({
		method: "POST",
		url: "<?=site_url('ajax_request/getProgramacionesUsuario')?>",
		beforeSend: function(){	$("#cargador_holder").fadeIn();},
		data: { usuario:<?=$this->session->userdata('user_id')?> }
		})
		.done(function( msg ) {
			console.log(msg);
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
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				events: array
			});
		});
	});

</script>
</body>
</html>
