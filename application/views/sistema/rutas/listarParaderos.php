<?php echo $head;?>

<body class="hold-transition skin-green sidebar-mini">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de paraderos<br>
        <small>Ingrese los datos de la Ruta</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Rutas</a></li>
        <li class="active">Listar Paraderos</li>
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
              <div class="box-body">
                <div class="col-md-4 form-group">
                  <label>Nombre</label>
																		<?php //var_dump();?>
                  <input type="text" class="form-control" placeholder="Nombre" id="nombre_ruta" value="<?php echo $rutas[0]->nombre;?>" readonly>
																		<input type="hidden" id="rutacodigo" value="<?php echo $rutas[0]->ida001_ruta;?>">
                </div>
                <div class="col-md-4 form-group">
                  <label>Numero</label>
                  <input type="text" class="form-control" placeholder="Numero" id="numero_ruta" name="numero_ruta" value="<?php echo $rutas[0]->ida001_ruta;?>" readonly>
                </div>
              </div>
              <!-- /.box-body --> 
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
						<!-- /.row -->
      <div class="row">
							 <form role="form" id="rutasForm" method="POST" action="<?php echo site_url('rutas/guardarRuta');?>" enctype="multipart/form-data">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
												 <div class="box-head">
														<h4 style="margin:5px 10px; width:80%;"><b>  Creacion de paraderos.</b></h4>
													</div>
										<div class="box-body">
																							<div class="col-md-6">
																								<div class="col-md-8 form-group">
																										<label>Nombre</label>
																										<input type="text" class="form-control" placeholder="Nombre" id="nombre_paradero" name="nombre_paradero">
																								</div>
																								<div class="col-md-4 form-group">
																										<label>Numero de Parada</label>
																										<input type="number" class="form-control" placeholder="00" id="numero_parada" name="numero_parada">
																								</div>
																								<div class="col-md-6 form-group">
																										<label>Latitud</label>
																										<input type="text" class="form-control" id="lat" name="lat" placeholder="Latitud" title="Seleccione desde el mapa" readonly>
																								</div>
																								<div class="col-md-6 form-group">
																										<label>Longitud</label>
																										<input type="text" class="form-control" id="lon" name="lon" placeholder="Longitud" title="Seleccione desde el mapa" readonly>
																								</div>
																								<div class="col-md-12 form-group">
																										<label>Dirección</label>
																									<input type="text" class="form-control" placeholder="Dirección" id="direccion_paradero" name="direccion_paradero">
																								</div>
																							</div>
																		<div class="col-md-6">
																					<div id="map"></div>
																			</div>
															
															<style>/* Set the size of the div element that contains the map */
																					#map {height: 200px;  /* The height is 400 pixels */width: 90%;margin: 0px auto;/* The width is the width of the web page */}
																					#map2{height: 200px;  /* The height is 400 pixels */width: 90%;margin: 0px auto;/* The width is the width of the web page */}
																			</style>
														
										</div>
              <!-- /.box-body -->
              <div class="box-footer">
																<div class="col-sm-10">
																		<div id="alert_message" class="alert alert-warning alert-dismissible" style="display: none;">
																			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																			<div id="mensaje_text"><strong>Success!</strong> Indicates a successful or positive action.</div>
																	</div>
																</div>
																<div class="col-sm-2">
																	<button type="submit" id="guardarRuta" class="btn btn-primary" style="margin: 15px 5%;width: 90%;">Agregar Parada &nbsp;<i class="fa fa-plus"></i>&nbsp;</button>
																</div>
														</div>
          <!-- /.box -->
									</div>
									<!--/.col (left) -->
											
									</div>
								</form>
								<!-- /.row -->
						</div>
      
					 <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
             <div class="box-head">
               <h4 style="margin:5px 2%; width:45%; float:left;"><b>  Listado de paraderos.  </b></h4>
															<h4 style="margin:5px 2%; width:45%; float:left;"><b>  Posición de las paradas.  </b></h4>
              </div>
              <div class="box-body">
															<div class="col-md-6">
																			<table id="example1" class="table table-bordered table-striped">
																			<thead>
																				<tr>
																						<th>Id</th>
																						<th>Nombre</th>
																						<th>Direccion</th>
																						<th>Opciones / Estado</th>
																				</tr>
																			</thead>
																			<tbody>
																			<?php foreach($paraderosData as $k => $v):?>
																		<tr>
																			<td><?php echo $v->ida002_paraderos;?></td>
																			<td><?php echo $v->nombre;?></td>
																			<td><?php echo $v->direccion;?></td>
																			<td>
																					<a href="<?php echo site_url('rutas/editarParadero/'.$v->ida002_paraderos);?>"><i class="fa fa-fw fa-edit"></i></a>&nbsp;
																					<i class="fa fa-circle" style="<?php echo ($v->activo==0?'color:green':'color:red');?>"></i>
																			</td>
																		</tr>
																		<?php endforeach; ?>
																			</tbody>
																	</table>
															</div>
																<div class="col-md-6">
																	<ul id="sortable">
																		<?php foreach($paraderosData as $k => $v):?>
																			<li class="ui-state-default" id="idp-<?php echo $v->ida002_paraderos;?>"><?php echo $v->nombre;?></li>
																		<?php endforeach; ?>
																</ul>
 
																</div>
              </div>
              <!-- /.box-body --> 
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
						<style>
							#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
							#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
							html>body #sortable li { height: 1.5em; line-height: 1.2em; }
							.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
							</style>
						 <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
										   <div class="box-head">
               <h4 style="margin:5px 10px; width:80%;"><b>  Ubicacion de paraderos.  </b></h4>
              </div>
              <div class="box-body">
                <div id="map2"></div>
              </div>
              <!-- /.box-body --> 
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
    </section>
        <!-- right col -->
     
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('resources/');?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('resources/');?>dist/js/demo.js"></script>
<!-- jquery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?= base_url('resources/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('resources/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
						// Initialize and add the map 
						var map, map2;
						var marcadores = <?=$paraderosMap?>;
						var markers = [];
						function initMap(){
							var myOptions = {
														zoom: 10,
														center: new google.maps.LatLng(4.677457387401735,-74.07734868150504),
														mapTypeId: google.maps.MapTypeId.ROADMAP
										};
										
								map = new google.maps.Map(document.getElementById("map"), myOptions);
								map2 = new google.maps.Map(document.getElementById("map2"), myOptions);
								for (var i = 0; i < marcadores.length; i++) {
										var beach = marcadores[i];
										if(i==0){map2.setCenter(new google.maps.LatLng(beach[1], beach[2]));}
										var marker = new google.maps.Marker({
												position: {lat: beach[1], lng: beach[2]},
												map: map2,
												title: beach[0],
												zIndex: beach[3]
										});
								}
							/* centrar en current location */
							// Try HTML5 geolocation. /* solo funciona si esta sobre ssl HTTPS */ 
							if (navigator.geolocation) {
														navigator.geolocation.getCurrentPosition(function(position) {
																var pos = {lat: position.coords.latitude,lng: position.coords.longitude};
																infoWindow.setPosition(pos);
																infoWindow.setContent('Location found.');
																infoWindow.open(map);
																map.setCenter(pos);
														}, function() {
																handleLocationError(true, infoWindow, map.getCenter());
														});
												} else {
														// Browser doesn't support Geolocation
														handleLocationError(false, infoWindow, map.getCenter());
												}
							/* centrar en current location */		
							google.maps.event.addListener(map, 'mousemove', function() { map.setOptions({draggableCursor:'pointer'}); });
							/* FIN de centrar en current location */
							/*latitud y longitud del click */
							google.maps.event.addListener(map, 'click', function( event ){
							clearMarkers(); addMarker(event.latLng, map);
							$("#lat").val(event.latLng.lat()); $("#lon").val(event.latLng.lng());
							});
							
						}
							// Sets the map on all markers in the array.
												function setMapOnAll(map) {
														for (var i = 0; i < markers.length; i++) {
																markers[i].setMap(map);
														}
												}
							// Adds a marker to the map and push to the array.
												function addMarker(location, map) {
														var marker = new google.maps.Marker({
																position: location,
																animation: google.maps.Animation.DROP,
																map: map
														});
														markers.push(marker);
												}
															// Removes the markers from the map, but keeps them in the array.
												function clearMarkers() {
														setMapOnAll(null);
												}
												// Deletes all markers in the array by removing references to them.
												function deleteMarkers() {
														clearMarkers();
														markers = [];
												}
									$(document).ready(function(){
											$("#guardarRuta").click(function(e){
												e.preventDefault();$("#alert_message").fadeOut();
												var nomruta = $("#nombre_ruta");
												var codigoruta = $("#rutacodigo").val();
												var coempresa = $("#co_empresa");
												var nomparad = $("#nombre_paradero");
												var dirparad = $("#direccion_paradero");
												var numparada = $("#numero_parada");
												var lat =$("#lat");
												var lon =$("#lon");
												/* validadores */
										
												if(nomparad.val().length<2){
													$("#mensaje_text").html("<strong>Excepcion!</strong> Debe indicar el nombre de la parada inicial.");$("#alert_message").fadeIn();
													nomparad.focus(); return 0;
												}
												if(dirparad.val().length<2){
													$("#mensaje_text").html("<strong>Excepcion!</strong> Por favor proporcione la direccion o descripcion de la parada inicial.");$("#alert_message").fadeIn();
													dirparad.focus(); return 0;
												}
												if(numparada.val().length<1){
													$("#mensaje_text").html("<strong>Excepcion!</strong> Por favor proporcione el numero de parada.");$("#alert_message").fadeIn();
													numparada.focus(); return 0;
												}
												if(lat.val().length<2 && lon.val().length<2){
													$("#mensaje_text").html("<strong>Excepcion!</strong> Por favor haga click en el mapa para determinar el lugar de inicio de la ruta.");$("#alert_message").fadeIn();
													return 0;
												}
												nombre = nomparad.val();ordenamiento = numparada.val();direccion=dirparad.val();latitud=lat.val();longitud=lon.val();
												$.ajax({
														type: "POST",
														url: "<?=site_url('rutas/ajax_guardarParadero')?>",
														data: {'rutacodigo':codigoruta, 'nombre':nombre, 'ordenamiento':ordenamiento, 'direccion': direccion, 'lat':latitud, 'lon':longitud},
														success: function(data){
															r = JSON.parse(data);
															if(r.result==1){
																alert(r.mensaje);
																$("#rutasForm").find("input[type=text],input[type=number], textarea").val("");
																setTimeout(function(){location.reload();},1000);
															}
															if(r.result==0){
																	alert(r.mensaje);
															}
														}
												}); 
											});
													$('#example1').DataTable();
													$( "#sortable" ).sortable({
															axis: 'y',
															update: function (event, ui) {
															var data = $(this).sortable('serialize');
															// POST to server using $.post or $.ajax
															$.ajax({
																			data: data,
																			type: 'POST',
																			url: '<?=site_url('rutas/sortParadero/'.$rutas[0]->ida001_ruta)?>'
															});
														},
													placeholder: "ui-state-highlight"});
													/*$( "#sortable" ).disableSelection();*/
													
										});
	</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&callback=initMap"></script>

</body>
</html>

