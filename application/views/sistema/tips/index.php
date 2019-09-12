<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<link href='<?php echo base_url('resources/mod.calendar');?>/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url('resources/mod.calendar');?>/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<style>
	body {padding: 0;font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;font-size: 14px;}
	#calendar {max-width: 900px;margin: 0 auto;}
	#cargador{position: absolute;height: 100px;width: 100px;top: 50%;left: 50%;margin-left: -50px;margin-top: -50px;}
	#cargador_holder{width: 100%;min-height: 100vh;position: absolute;background-color: rgba(136, 131, 131, 0.4196078431372549);z-index: 1000;}
</style>
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
						 <section class="content-header">
					<h1>
						Tips de reciclaje
						<small>Reciclaje eficiente</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li class="active">Tips</li>
					</ol>
				</section>
    <!-- Main content -->
    <style>
      .calendarHolder{padding: 30px;}
      #calendar2, #calendar{border: 1px solid #25502559;}
    </style>
    <section class="content">
      <!-- Small boxes (Stat box) -->
    
        <!-- ./col -->
       
        <!-- ./col -->
        
        <!-- ./col -->
        
        <!-- ./col -->
      
      <!-- /.row -->
         <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
         <!-- TO DO List -->
          <div class="box box-primary">

            <!-- /.box-header -->
            <div class="box-body calendarHolder">
                  <div class="col-lg-4 col-md-4 col-sm-12" id="como-reciclar">
                    <a id="btn-1" data-featherlight="#video_1" class="btn btn-link f1" data-step="2" data-intro="Aprende que es reciclar">
                      <img src="images/banner1.jpg" width="90%"></a>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12" id="como-reciclar">
                    <a id="btn-2" data-featherlight="#video_2" class="btn btn-link f1" data-step="3" data-intro="Aprende como reciclar pl�stico">
                      <img src="images/banner2.jpg" width="90%"></a>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12" id="como-reciclar">
                    <a id="btn-3" data-featherlight="#video_3" class="btn btn-link f1" data-step="4" data-intro="Aprende como reciclar papel / cart�n / metales">
                      <img src="images/banner3.jpg" width="90%"></a>
                  </div>
                    <div class="hidden" >
                    <video width="100%" controls id="video_1" controlsList="nodownload">
                        <source src="<?= base_url('resources/video/VIDEO-1-RECICLAJE-AMAZÓNIKO.mp4') ?>" type="video/mp4">
                    </video>
                    </div>
                    <div class="hidden">
                        <video width="100%" controls id="video_2" controlsList="nodownload">
                            <source src="<?= base_url('resources/video/VIDEO-II-PLÁSTICO-AMAZÓNIKO.mp4') ?>" type="video/mp4">
                        </video>
                    </div>
                    <div class="hidden">
                    <video width="100%" controls id="video_3" controlsList="nodownload">
                        <source src="<?= base_url('resources/video/VIDEO-III-Papel,-Carón-y-Metales-Amazóniko.mp4') ?>" type="video/mp4">
                    </video>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>
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
<link rel="stylesheet" href="<?= base_url('resources/plugins/featherlight/featherlight.min.css') ?>">
<script src="<?=base_url('resources/plugins/featherlight/featherlight.min.js')?>"></script>
<script>
	<?php if(isset($message)):?>
	setTimeout(function(){$("#infoModal").modal(); },500);
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
