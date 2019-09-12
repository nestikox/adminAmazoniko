 <?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
						 <section class="content-header">
					<h1>
						Editar Ruta
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li><a href="#"> Rutas </a></li>
						<li class="active">Editar Rutas</li>
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
            <form role="form" id="rutasForm" method="POST" action="<?php echo site_url('rutas/actualizarRuta');?>" enctype="multipart/form-data">
              <div class="box-body">
															<div class="col-md-2 form-group">
                  <label>Id</label>
                  <input type="text" class="form-control" value="<?php echo $ruta[0]->ida001_ruta;?>" readonly>
																		<input type="hidden" class="form-control" name="idRuta" value="<?php echo $ruta[0]->ida001_ruta;?>">
                </div>
															<?php //var_dump($ruta[0]->id);?>
                <div class="col-md-4 form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" id="nombre_ruta" name="nombre_ruta" value="<?php echo $ruta[0]->nombre;?>">
																		<input type="hidden" name="codigoRuta" value="<?php echo $ruta[0]->ida001_ruta;?>">
                </div>
																 <div class="col-md-6 form-group">
                            <label>Descripción</label>
                            <input type="text" class="form-control" placeholder="Descripción" id="direccion" name="direccion" value="<?php echo $ruta[0]->direccion;?>">
                        </div>
																	<div class="col-md-6 form-group">
																				<label>Zona</label>
																				<select class="form-control" name="zona">
																					<?php foreach($zonas as $k=>$v):?>
                      <option value="<?php echo $v->id?>" <?php if($v->id ==  $ruta[0]->id_zona){echo "selected";}?>><?php echo $v->nombre.(strlen($v->delimitacion)>4?' | '.$v->delimitacion:'')?></option>
                     <?php endforeach;?>
																				</select>
                </div>
                  <div class="col-md-4 form-group">
																				<label>Estado</label><br>
																				<div class="col-md-6 form-group">Activo  <input type="radio" name="estado" value="1" class="flat-red" <?php if($ruta[0]->activo==1){echo "checked";}?>>
																					</div>
																					<div class="col-md-6 form-group">Inactivo  <input type="radio" name="estado" value="0" class="flat-red" <?php if($ruta[0]->activo==0){echo "checked";}?>>
																					</div>
                </div>
              </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                 <a class="pull-right btn btn-warning volver"  href="<?php echo site_url('rutas');?>">Volver</a>
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
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({ autoclose: true })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({ 
      checkboxClass: 'icheckbox_minimal-blue', radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red', radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green', radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
