 <?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
       <?php if(isset($message)):?>
																			<div class="col-sm-10">
																			 <div class="alert alert-info alert-dismissible">
																				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																				<strong>Información!</strong>
																				<?php echo $message;?>
																			 </div>
																			</div>
																			<?php endif;?>     
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
                  <div class="col-md-6 form-group">Activo  <input type="radio" name="estado" value="1" class="flat-red" <?php if($ruta[0]->activo==1){echo "checked";}?>></div>
                  <div class="col-md-6 form-group">Inactivo  <input type="radio" name="estado" value="0" class="flat-red" <?php if($ruta[0]->activo==0){echo "checked";}?>></div>
                </div>
                <div class="col-md-4 form-group"><?php //var_dump($rd);?>
                  <label>Fecha de inicial:</label>
                  <input type="text" class="form-control" id="fecha_inicial" name="fecha_inicial" autocomplete="off" value="">
                  <input type="hidden" name="programacion_id" value="<?php echo ((isset($rd['programacion']->id) and $rd['programacion']->id>0)?$rd['programacion']->id:0)?>">
                </div>
                <div class="col-md-4 form-group">
                  <label>Dias de Recolecci&oacute;n:</label>
                  <input type="text" class="form-control" id="dia_recoleccion" name="dia_recoleccion" value="<?php echo ((isset($rd['programacion']->dia) and strlen($rd['programacion']->dia)>1)?$rd['programacion']->dia:'');?>" autocomplete="off" readonly="readonly">
                </div>
                <div class="col-md-2 form-group">
                  <div class="checkbox" style="padding-top: 10px;">
                    <label><input type="checkbox" id="check_act" name="actualizar_programacion" value="1" <?php echo ((isset($recoleccion->repetir) and $recoleccion->repetir>0)?'checked':'');?>>&iquest;Actualizar Programacion?</label>
                  </div>
                </div>
                <!--<div class="col-md-2 form-group">
                  <i class="fa fa-toggle-on"></i>
                </div>-->
                <?php if(isset($rd['fechas']) and is_array($rd['fechas'])):?>
                <div class="col-md-12 form-group">
                 <label>Proximas Fechas</label>&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i><br>
                 <table id="data" width="100%" class="table">
                  <tbody>
                   <?php foreach($rd['fechas'] as $k => $v):?>
                   <tr><td><?php echo $v->nuevafecha;?></td></tr>
                   <?php endforeach;?>
                  </tbody>
                 </table>
                 </div>
                <?php endif;?>
                <!--<div class="col-md-2 form-group">
                  <div class="checkbox" style="padding-top: 10px;">
                    <label><input type="checkbox" name="repetir" id="repetir" value="1" <?php echo ((isset($recoleccion->repetir) and $recoleccion->repetir>0)?'checked':'');?>>&iquest;Repetir Recolecci&oacute;n?</label>
                  </div>
                </div>-->
                <script>
                 $(document).ready(()=>{
                   $("#check_act").change(()=>{
                      if($('input[name="actualizar_programacion"]').is(':checked')) {
                        r = confirm('Al actualizar perdera los datos actuales de programacion y fechas proximas y se calcularan segun la nueva fecha ingresada, Desea continuar?');
                        if(!r){
                         $('input[name="actualizar_programacion"]').prop("checked", false);
                        }
                      }
                    });
                  });
                </script>
                    <?php
                    $date = '2018-06-12';
                    $nameOfDay = date('l', strtotime($date));
                    $dia='';
                    switch($nameOfDay){
                      case 'Monday':  $dia = "Lunes"; break; case 'Tuesday':$dia = "Martes"; break;
                      case 'Wednesday':$dia= "Miercoles";break; case 'Thursday':$dia = "Jueves";break;
                      case 'Friday': $dia = "Viernes";break;case 'Saturday':$dia = "Sabado";break;
                      case 'Sunday':$dia = "Domingo";break;
                    } ?>
                
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

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-ui/jquery-ui.min.js"></script>
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
      });
  </script>
</body>
</html>
