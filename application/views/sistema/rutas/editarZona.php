<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Zonas<br>
        <small>Listado de Zonas en Amazóniko</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li ><a href="#">Rutas</a></li>
        <li ><a href="#">Listado de Zonas</a></li>
		<li class="active"><a href="#">Editar Zona</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form role="form" id="rutasForm" method="POST" action="<?php echo site_url('rutas/actualizarZona');?>" enctype="multipart/form-data">
        <!-- /.row -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-default">
              <!-- form start -->
                <div class="box-body">
                      <div class="col-md-4 form-group">
						<?php //var_dump($poligonZona);?>
                        <label>Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre" value="<?php echo $zona->nombre;?>">
																								<input type="hidden" id="idZona" name="idZona" value="<?php echo $zona->id;?>">
																						</div>
                      <div class="col-md-8 form-group">
                            <label>Dirección</label>
                            <input type="text" class="form-control" placeholder="Dirección" id="direccion" name="direccion" value="<?php echo $zona->direccion;?>">
                        </div>
                      <div class="col-md-9 form-group">
                        <label>Delimitacion</label>
                        <input type="textarea" autocomplete='OFF' class="form-control" id="delimitacion" name="delimitacion" value="<?php echo $zona->delimitacion;?>" placeholder="Descripcion de la Zona">
                      </div>
																						<div class="col-md-3 form-group">
																									<label for="colorpoligono">Color</label><br>
																										<input type="color" id="colorpoligono" name="colorpoligono" value="<?php echo $zona->color;?>">
																						</div>
					
                      <div class="col-md-8 form-group">
                        <label>Descripcion</label>
                        <input type="textarea" autocomplete='OFF' class="form-control" id="descripcion" name="descripcion" value="<?php echo $zona->descripcion;?>" placeholder="Descripcion de la Zona">
                      </div>
																						<div class="col-md-4 form-group">
                        <label>Estado</label>
                        <select class="form-control" id="estado" name="estado">
																									<option >Seleccione...</option>
																									<option value="1" <?php if($zona->activo ==1){echo "selected";}?>> Activo</option>
																									<option value="0" <?php if($zona->activo ==0){echo "selected";}?>> Inactivo</option>
																								</select>
                      </div>
                      <div class="col-xs-3 form-group"><?php //var_dump($rd);?>
                       <label>Fecha de inicial:</label>
                        <input type="text" class="form-control" id="fecha_inicial" name="fecha_inicial" autocomplete="off" value="">
                        <input type="hidden" name="programacion_id" value="<?php echo ((isset($rd['programacion']->id) and $rd['programacion']->id>0)?$rd['programacion']->id:0)?>">
                      </div>
                      <div class="col-xs-3 form-group">
                        <label>Dias de Recolecci&oacute;n:</label>
                        <input type="text" class="form-control" id="dia_recoleccion" name="dia_recoleccion" value="<?php echo ((isset($rd['programacion']->dia) and strlen($rd['programacion']->dia)>1)?$rd['programacion']->dia:'');?>" autocomplete="off" readonly="readonly">
                      </div>
                      <div class="col-xs-3 form-group">
                        <button id="actualizarProg" class="btn btn-success">
                         Actualizar fechas <br> de Recoleccion</button>
                      </div>
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
                      <div class="col-md-12 form-group">
                        <label>Coordenadas (SISTEMA)</label>
                        <textarea autocomplete='OFF' class="form-control" id="coordenadas" name="coordenadas" placeholder="Descripcion de la Zona" readonly="true" required>
                        </textarea>
                      </div>
                      <div id="coordenadas_data">
                      </div>
                      <div id="color_data">
                      </div>
                      <div class="col-md-12">
                      <style>
                              /* Set the size of the div element that contains the map */
                            #map {height: 450px; width: 80%;margin: 0px 10%;}
                            #panel {width: 200px;margin: 0px 10%;font-family: Arial, sans-serif;font-size: 13px;float: right;}
                            #color-palette {clear: both;}
                            .color-button {width: 14px;height: 14px;font-size: 0;margin: 2px;float: left;cursor: pointer;}
                            #delete-button {margin-top: 5px;}
                        </style>
<?php //var_dump();?>																						
                      <div id="map"></div>
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
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>

<script src="<?= base_url('resources/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('resources/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?=base_url()?>resources/plugins/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('resources/');?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=drawing&callback=initMap"></script>
<script>
  $(document).ready(function(){
   $("#actualizarProg").on('click', function(e){
    e.preventDefault();
    var fecha_i = $("#fecha_inicial").val();
    var diaR = $("#dia_recoleccion").val();
    var act = $("input[name='actualizar_programacion']:checked").val();
    var zona = $("#idZona").val();
    if(fecha_i.length<2){ alert(' Debe proporcionar una fecha inicial para establecer los dias y fechas de recolección próximos, las fechas se actualizarán segun la selección.');return;}
    if(diaR.length<2){ alert(' No ha seleccionado fecha.');return;}
    c = confirm('Desea Actualizar los datos de recoleccion?');
    if(c){
     $.ajax({
        type: "POST",
            url: "<?=site_url('ajax_request/guardarProgramacionNueva/')?>"+this.id,
            data: {fecha:fecha_i, dia:diaR, act:1, zona:zona},
            success: function(data){
             r = JSON.parse(data);
             if(r.code>0){
               window.location.reload();
              }else{
               console.log(r.code);
              }
            }
      });
    }
    return;
   });
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
<script>
// Initialize and add the map
		$(document).ready(function(){
            $("#guardarRuta").click(function(e){
                e.preventDefault();$("#alert_message").fadeOut();
                var nomparad = $("#nombre");
                var dirparad = $("#direccion");
                var desc =$("#descripcion");
                var deli =$("#delimitacion");
                
                /* validadores */
                if(nomparad.val().length<2){
                    $("#mensaje_text").html("<strong>Excepcion!</strong> Debe indicar el nombre de la ruta.");$("#alert_message").fadeIn();
                    nomparad.focus(); return 0;
                }
                if(dirparad.val().length<2){
                    $("#mensaje_text").html("<strong>Excepcion!</strong> Por favor proporcione la direccion o descripcion de la parada inicial.");$("#alert_message").fadeIn();
                    dirparad.focus(); return 0;
                }
                if(deli.val().length<2){
                    $("#mensaje_text").html("<strong>Excepcion!</strong> Por favor ingrese la delimitacion de la zona.");$("#alert_message").fadeIn();
                    return 0;
                }
                if(desc.val().length<2){
                    $("#mensaje_text").html("<strong>Excepcion!</strong> Por favor agregue una breve descripcion.");$("#alert_message").fadeIn();
                    return 0;
                }
                $("#rutasForm").submit();
            });
        });
  
	</script>
 <script type="text/javascript">
					 	// Polygon Coordinates	
   var triangleCoords = [<?=$poligonZona?>];						
											//var myPolygon;
function initMap() {
  // Map Center
  var myLatLng = new google.maps.LatLng(triangleCoords[0].lat, triangleCoords[0].lng);
  // General Options
  var mapOptions = {
    zoom: 14,
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.RoadMap
  };
  var map = new google.maps.Map(document.getElementById('map'),mapOptions);
 
  
  // Styling & Controls
  myPolygon = new google.maps.Polygon({
    paths: triangleCoords,
    draggable: true, // turn off if it gets annoying
    editable: true,
    strokeColor: '<?=$zona->color?>',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '<?=$zona->color?>',
    fillOpacity: 0.35
  });

  myPolygon.setMap(map);
  //google.maps.event.addListener(myPolygon, "dragend", getPolygonCoords);
  google.maps.event.addListener(myPolygon.getPath(), "insert_at", getPolygonCoords);
  //google.maps.event.addListener(myPolygon.getPath(), "remove_at", getPolygonCoords);
  google.maps.event.addListener(myPolygon.getPath(), "set_at", getPolygonCoords);
}

//Display Coordinates below map
function getPolygonCoords() {
  var len = myPolygon.getPath().getLength();
  var htmlStr = ""; htmlData = "";coordenadasPoly = [];
                     var dataHolder = document.querySelector('#coordenadas');
                     var dataP = document.querySelector("#coordenadas_data");
                     dataP.innerHTML = '';
                     htmlStr += "[";
 for (var i = 0; i < len; i++) {
                        htmlData+= "<input name='coordenadaspoligono["+i+"]' type='hidden' value=\""+myPolygon.getPath().getAt(i).toUrlValue(6);
                        htmlData+= "\"/>";
                        if(i>0){htmlStr +=",";}
                        htmlStr += "{";
                        htmlStr += myPolygon.getPath().getAt(i).toUrlValue(6);
                        htmlStr += "}";
                      
                     }
                     htmlStr += "]";
                     dataHolder.innerHTML = htmlStr;
                     dataP.innerHTML = htmlData;																					
}
function copyToClipboard(text) {
  window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}
            
        </script>
</body>
</html>
