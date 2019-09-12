<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Crear Ruta<br>
        <small>Ingrese el nombre de la ruta y la parada Inicial.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Rutas</a></li>
        <li class="active">Crear Rutas</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form role="form" id="rutasForm" method="POST" action="<?php echo site_url('rutas/crearRuta');?>" enctype="multipart/form-data">
        <!-- /.row -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-default">
              <!-- form start -->
                <div class="box-body">
                      <div class="col-md-3 form-group">
                        <label>Nombre de Ruta</label>
                        <input type="text" class="form-control" placeholder="Nombre de Ruta" id="nombre_ruta" name="nombre_ruta">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Nombre de Paradero Inicial</label>
                        <input type="text" class="form-control" placeholder="Nombre de paradero" id="nombre_paradero" name="nombre_paradero">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Latitud</label>
                        <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitud" title="Seleccione desde el mapa" readonly>
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Longitud</label>
                        <input type="text" class="form-control" id="lon" name="lon" placeholder="Longitud" title="Seleccione desde el mapa" readonly>
                      </div>
                        <div class="col-md-6 form-group">
                         <?php //var_dump($zonas);?>
                            <label>Zona</label>
                            <select class="form-control" id="zona" name="zona">
                                <option> Seleccione...</option>
                                <?php foreach($zonas as $k=>$v):?>
                                <option value="<?php echo $v->id?>"><?php echo $v->nombre.(strlen($v->delimitacion)>4?'/'.$v->delimitacion:'')?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Dirección</label>
                            <input type="text" class="form-control" placeholder="Dirección" id="direccion_paradero" name="direccion_paradero">
                        </div>
                          <style>
                              /* Set the size of the div element that contains the map */
                              #map {height: 300px;  /* The height is 400 pixels */
                                  width: 80%;margin: 0px 10%;/* The width is the width of the web page */
                              }
                          </style>
                      <div id="map"></div>
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('resources/');?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('resources/');?>dist/js/demo.js"></script>
<!-- jQuery 3 -->
<script src="<?=base_url()?>resources/plugins/jquery/dist/jquery.min.js"></script>
<script>
    $("#lat,#lon").click(function(){
            alert('Latitud y Longitud deben ser seleccionados en el mapa.');
        });
// Initialize and add the map
 var map;
 var markers = [];
function initMap() {
var mapDiv = document.getElementById('map');
  map = new google.maps.Map(mapDiv, { center: new google.maps.LatLng(4.677457387401735,-74.07734868150504),zoom: 13,mapTypeId: google.maps.MapTypeId.ROADMAP});
  google.maps.event.addListener(map, 'mousemove', function() { map.setOptions({draggableCursor:'pointer'});});
  /*latitud y longitud del click */
  google.maps.event.addListener(map, 'click', function( event ){
		clearMarkers();
		addMarker(event.latLng);
		$("#lat").val(event.latLng.lat());
		$("#lon").val(event.latLng.lng());
	});
  }
 // Sets the map on all markers in the array.
    function setMapOnAll(map) { for (var i = 0; i < markers.length; i++) { markers[i].setMap(map); } }
 // Adds a marker to the map and push to the array.
    function addMarker(location) {
        var marker = new google.maps.Marker({ position: location,animation: google.maps.Animation.DROP,map: map});
        markers.push(marker);
      }
	  // Removes the markers from the map, but keeps them in the array.
      function clearMarkers(){setMapOnAll(null);}
      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }
		$(document).ready(function(){
            $("#guardarRuta").click(function(e){
                e.preventDefault();$("#alert_message").fadeOut();
                var nomparad = $("#nombre_paradero");
                var dirparad = $("#direccion_paradero");
                var lat =$("#lat");
                var lon =$("#lon");
                /* validadores */
                if(nomparad.val().length<2){
                    $("#mensaje_text").html("<strong>Excepcion!</strong> Debe indicar el nombre de la ruta.");$("#alert_message").fadeIn();
                    nomparad.focus(); return 0;
                }
                if(dirparad.val().length<2){
                    $("#mensaje_text").html("<strong>Excepcion!</strong> Por favor proporcione la direccion o descripcion de la parada inicial.");$("#alert_message").fadeIn();
                    dirparad.focus(); return 0;
                }
                if(lat.val().length<2 && lon.val().length<2){
                    $("#mensaje_text").html("<strong>Excepcion!</strong> Por favor haga click en el mapa para determinar el lugar de inicio de la ruta.");$("#alert_message").fadeIn();
                    return 0;
                }
                $("#rutasForm").submit();
            });
        });
	</script>
				<!--     -->
						<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&callback=initMap"></script>
    
</body>
</html>
