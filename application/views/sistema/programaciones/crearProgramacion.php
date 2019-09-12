<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Crear Programacion<br>
        <small>Ingrese los datos para programar recoleccion.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Programaciones</a></li>
        <li class="active">Crear Programacion</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form role="form" id="rutasForm" method="POST" action="<?php echo site_url('programaciones/guardarProgramacionNueva');?>" enctype="multipart/form-data">
        <!-- /.row -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-default">
              <!-- form start -->
                <div class="box-body">                      
                      <div class="col-md-12 form-group">
                        <label>Tipo de programacion:</label>
                          <input type="text" class="form-control" id="nombre_programa" value="Recoleccion" name="nombre_programa" readonly>
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Zona:</label>&nbsp;<i id="zonaLoader" class="fa fa-circle-o-notch" aria-hidden="true" style="display:none;"></i>
                        <select class="form-control" id="zonaselect" name="zona">
                          <option value="0">Seleccione...</option>
                          <?php foreach($zonas as $k => $v):?> 
                            <option value="<?php echo $v->id;?>"><?php echo $v->nombre."( ".$v->delimitacion." )";?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Ruta:</label>&nbsp;<i id="rutaLoader" class="fa fa-circle-o-notch" aria-hidden="true" style="display:none;"></i>
                        <select class="form-control" id="ruta" name="ruta">
                          <option value="0">Seleccione...</option>
                        </select>
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Recolector:</label>&nbsp;<i id="recolectorLoader" class="fa fa-circle-o-notch" aria-hidden="true" style="display:none;"></i>
                        <select type="text" class="form-control" id="recolector" name="recolector">
                          <option value="0">Seleccione...</option>
                        </select>
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Fecha de recolecci&oacute;n:</label>
                        <input type="text" class="form-control" id="fecha_inicial" name="fecha_inicial" autocomplete="off">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Dia de recolecci&oacute;n:</label>
                        <input type="text" class="form-control" id="dia_recoleccion" name="dia_recoleccion" autocomplete="off" readonly="readonly">
                        <input type="hidden" class="form-control" id="dia_recoleccion_num" name="dia_recoleccion_num" autocomplete="off" readonly="readonly">
                      </div>
                      <div class="col-md-3 form-group">
                        <div class="checkbox" style="padding-top: 10px;">
                          <label><input type="checkbox" name="repetir" id="repetir" value="1">&iquest;Repetir Recolecci&oacute;n?</label>
                        </div>
                      </div>
                  </div>
            <!-- /.box-body -->
              <div class="box-footer">
                    <div class="col-sm-2 pull-right">
                        <button type="submit" id="guardarRuta" class="btn btn-primary" style="margin: 15px 20%;width: 80%;">Guardar</button>
                    </div>
                    <div class="col-sm-10">
                        <div id="alert_message" class="alert alert-warning alert-dismissible" style="display: none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <div id="mensaje_text"><strong>Success!</strong></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->
          </div>
          <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </form>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('resources/');?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('resources/');?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>
<script>
  $(document).ready(function(){
    var weekday=new Array(7);
      weekday[0]="Domingo";
      weekday[1]="Lunes";
      weekday[2]="Martes";
      weekday[3]="Miercoles";
      weekday[4]="Jueves";
      weekday[5]="Viernes";
      weekday[6]="Sabado";
    $("#fecha_inicial").datepicker({
        dateFormat: 'yy-mm-dd',
        maxDate:'+1m +10d',
        minDate: 0,
        onSelect: function(dateText, inst) {
          var date = $(this).datepicker('getDate');
          var dayOfWeek = weekday[date.getUTCDay()];
          $("#dia_recoleccion").val(dayOfWeek);
          $("#dia_recoleccion_num").val(date.getUTCDay());
          // dayOfWeek is then a string containing the day of the week
        }}
        );
    $("#zonaselect").change(()=>{
      var zonaselect = $("#zonaselect").val();
      if(zonaselect>0){
      $.ajax({
        type: "POST",
        url: "<?=site_url('ajax_request/getRutasPorZona')?>",
        data: {'zona':$("#zonaselect").val()},
        beforeSend: ()=>{$("#zonaLoader").fadeIn();$("#rutaLoader").fadeIn();},
        success: function(data){
          $("#zonaLoader").fadeOut(); $("#rutaLoader").fadeOut();
          r = JSON.parse(data);
          $("#ruta").html(r.result);
          }
        });
      }
    });
    $("#ruta").change(()=>{
      var ruta = $("#ruta").val();
      if(ruta>0){
        $.ajax({
          type: "POST",
          url: "<?=site_url('ajax_request/getRecolectoresPorRuta')?>",
          data: {'ruta':$("#ruta").val()},
          beforeSend: ()=>{$("#recolectorLoader").fadeIn();},
          success: function(data){
            console.log(data);
            $("#recolectorLoader").fadeOut();
            r = JSON.parse(data);
            $("#recolector").html(r.result);
            if(r.resultCode!=1){ alert('La ruta seleccionada no tiene Recolectores asignados');}
          }
        });
      }
    });
    $("#guardarRuta").on('click', (e)=>{
      e.preventDefault();
      var zona=$("#zonaselect").val();
      var ruta=$("#ruta").val();
      var fi  =$("#fecha_inicial").val();
      var rec =$("#recolector").val();

      if(zona<1){alert('Seleccione una zona.');$("#zonaselect").focus(); return 0;}
      if(ruta<1){alert('Seleccione una ruta.');$("#ruta").focus(); return 0;}
      if(fi.length<2){alert('Seleccione Fecha de Inicio.');$("#fecha_inicial").focus(); return 0;}
      if(rec<1){alert('Seleccione un recolector.');$("#recolector").focus(); return 0;}
      if(calcularProgramacion()){
        $("#rutasForm").submit();
      }else{
        return 0;
      }
     });
  });

function calcularProgramacion(){
  var dia = $("#dia_recoleccion").val();
  var fcinicio = $("#fecha_inicial").val();
  
  
  if($("#repetir").is(":checked")){
      var r = confirm("\u00BF Desea repetir esta recoleccion todos los "+dia+" ?");
      if (r == true) {return true;} else {return false;} 
  }else{
      
    var r = confirm("\u00BF Desea guardar esta recoleccion para el dia "+dia+" ?");
    if (r == true) {return true;} else {return false;} 
  }

}
</script>
</body>
</html>
