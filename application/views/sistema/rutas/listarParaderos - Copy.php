<!-- <body class="hold-transition skin-blue sidebar-mini">
	<link rel="stylesheet" href="<?php echo base_url('js/')?>jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="<?php echo base_url('js/')?>jquery-ui/jquery-ui.theme.min.css">
	<script src="<?php echo base_url('js/')?>jquery-ui/jquery-ui.min.js"></script>
	<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
	<script src="<?php echo base_url('resources/')?>bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?php echo base_url('resources/')?>bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
	<script src="<?php echo base_url('resources/')?>plugins/icheck/icheck.min.js"></script>
	<script src="<?php echo base_url('resources/')?>bower_components/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url('resources/')?>bower_components/select2/dist/js/select2.min.js"></script>
	<script src="<?php echo base_url('resources/')?>bower_components/inputmask/dist/jquery.inputmask.bundle.js"></script>
<div class="wrapper">-->
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
														<h4 style="margin:5px 10px; width:80%;"><b>  Ubicacion de paraderos.  </b></h4>
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
																		<?php /*foreach($paraderos as $k => $v):?>
																			<li class="ui-state-default" id="idp-<?php echo $v->id;?>"><?php echo $v->nombre;?></li>
																		<?php endforeach;*/ ?>
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
    <!-- /.content -->
  </div>
		<div class="control-sidebar-bg"></div>
 </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Amazóniko
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2018 .</strong> Desarrollado con <i style="color:#E53935;" class="fa fa-heart" aria-hidden="true"></i> por <a href="http://www.ideco.com.co" target="_blank">www.ideco.com.co</a>.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="<?=base_url()?>public/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>public/dist/js/adminlte.min.js"></script>
<link href="<?=base_url()?>public/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
<script src="<?=base_url()?>public/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?=base_url()?>public/plugins/chartjs/Chart.min.js"></script>
<!--<script src="<?=base_url()?>public/dist/js/scripts/rutas.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=geometry,places&language=es">
</script>-->
<script async defer src="https://www.amazoniko.com/public/plugins/overlappingmarkerspiderfier/oms.min.js?spiderfier_callback=mapLibReadyHandler"></script>
<script src="<?= base_url('public/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
        /*$(document).ready(function(){
            var es = {"decimal":"","emptyTable":"No hay datos disponibles...","info":"Mostrando _START_ a _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 a 0 de 0 entradas","infoFiltered":"(filtrado de _MAX_ total de entradas)","infoPostFix":"","thousands":",","lengthMenu":"Mostrar _MENU_ entradas","loadingRecords": "Cargando...","processing":"Procesando datos...","search":"Busqueda:","zeroRecords":"No se encontraron coincidencias.","paginate": {"first": "Primer","last":"Ultimo","next":"Próximo","previous":"Anterior"}};
            
            $('#rutas').DataTable( {
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "<?=site_url('ajax_request/pag_rutas')?>",
                "language": es
                });
            });*/
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
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
																			url: '<?=site_url('rutas/sortParadero/'.$rutas[0]->id)?>'
															});
														},
													placeholder: "ui-state-highlight"});
													/*$( "#sortable" ).disableSelection();*/
													
										});
	</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&callback=initMap"></script>
</body>
</html>


