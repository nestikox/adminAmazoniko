<?php echo $head;?>

<body class="hold-transition skin-green sidebar-mini">
	<style>
		.perfilimg {
			width: 40%;
			min-height: 20px;
			object-fit: contain;
			margin: 2px 25%;
			background-color: lightgrey;
		}

		.bar {
			height: 18px;
			background: green;
		}

		/* Set the size of the div element that contains the map */
		#map {
			height: 250px;
			width: 90%;
			margin: 0px auto;
		}

		.form-control2,
		.select {
			display: block;
			height: 34px;
			padding: 6px 12px;
			font-size: 14px;
			line-height: 1.42857143;
			color: #555;
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
			-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
			transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		}

		.no-paddin-on-sides {
			padding-left: 0px !important;
			padding-right: 0px !important;
		}

		.no-padding-right {
			padding-right: 0px !important;
		}

		.no-padding-left {
			padding-left: 0px !important;
		}

		.req {
			color: red !important;
		}
		.alerta{color:red!important; font-weight:bold!important;}
	</style>
	<div class="wrapper">
		<?php echo $header;?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>Actualización de datos<small></small></h1>
			</section>
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- form start -->
							<form role="form" enctype="multipart/form-data" id="actualizar_usuario_form" method="POST" action="<?php echo site_url('usuarios/eUsuario');?>">
								<div class="box-body">
									<div class="row">
										<div class="col-md-3 form-group">
											<label>Nombre:<span class="req">*</span></label>
											<input type="hidden" id="userid" name="userid" value="<?php echo $usuario->id;?>">
											<input type="text" class="form-control" placeholder="Nombre" value="<?php echo $usuario->first_name;?>" id="nombre" name="nombre" required>
										</div>
										<div class="col-md-3 form-group">
											<label>Apellido:<span class="req">*</span></label>
											<input type="text" class="form-control" placeholder="Apellido" id="apellido" name="apellido" value="<?php echo $usuario->last_name;?>" required>
										</div>
										<div class="col-md-3 form-group">
											<label>No. identificación <span class="req">*</span></label>
											<input type="text" class="form-control" placeholder="00000000" id="ident" value="<?php echo $usuario->rut;?>" name="ndoc" required>
										</div>
										<div class="col-md-3 form-group">
											<label>Celular <span class="req">*</span></label>
											<input type="text" class="form-control" id="celular" placeholder="Celular" value="<?php echo $usuario->phone;?>" name="celular">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<label>Dirección Específica <span class="req">*</span></label>
											<div class="row">
												<div class="col-xs-3 form-group no-padding-right">
													<select class="form-control" id="1" name="1">
														<option value="">Seleccione</option>
														<option value="avenida">Avenida</option>
														<option value="calle">Calle</option>
														<option value="carrera">Carrera</option>
														<option value="circular">Circular</option>
														<option value="diagonal">Diagonal</option>
														<option value="transversal">Transversal</option>
													</select>
												</div>
												<div class="col-xs-3 form-group no-paddin-on-sides">
													<input type="text" class="form-control no-paddin-on-sides" id="2" name="2" value="">
												</div>
												<div class="col-xs-1 form-group">#</div>
												<div class="col-xs-2 no-paddin-on-sides">
													<input type="text" class="form-control no-paddin-on-sides" id="3" name="3" value="">
												</div>
												<div class="col-xs-1 form-group">-</div>
												<div class="col-xs-2 no-padding-left">
													<input type="text" class="form-control no-paddin-on-sides" id="4" name="4" value="">
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 form-group">
													<input type="text" class="form-control" placeholder="Calle 100 # 12-45" id="direccion_paradero" name="direccion_paradero" value="<?php echo (isset($paradero->direccion)?$paradero->direccion:'');?>">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label>Tipo de vivienda <span class="req">*</span></label><br>
													<input type="radio" name="tipo_vivienda" value="Casa" <?php echo (isset($paradero->tipo_vivienda) and $paradero->tipo_vivienda=='Casa')?'checked':'';?>>&nbsp;<i class="fa fa-home"></i> Casa
													<span class="checkmark"></span>
													<input type="radio" name="tipo_vivienda" value="Apartamento" <?php echo (isset($paradero->tipo_vivienda) and $paradero->tipo_vivienda=='Apartamento')?'checked':'';?>>&nbsp;<i class="fa fa-building"></i> Apartamento
													<span class="checkmark"></span>
												</div>
												<div class="col-md-6 form-group">
													<label>Nombre conjunto / edificio <span class="req">*</span></label>
													<input type="text" class="form-control" placeholder="Edificio monaco" id="nombre_paradero" name="nombre_paradero" value="<?php echo isset($paradero->nombre)?$paradero->nombre:''?>">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<label>Información adicional</label>
													<input type="text" class="form-control" placeholder="Int 4 / casa 5 / apto 606" id="informacion_adicional" name="informacion_adicional" value="<?php echo isset($paradero->address_detail)?$paradero->address_detail:''?>">
												</div>
												<div class="col-md-6 form-group">
													<label>Número de habitantes <span class="req">*</span></label>
													<input type="number" class="form-control" placeholder="" id="no_habitantes" name="no_habitantes" value="<?php echo isset($paradero->habitantes)?$paradero->habitantes:''?>">
												</div>
											</div>
											<input type="hidden" id="lat" name="lat" value="<?php echo isset($paradero->lat)?$paradero->lat:''?>">
											<input type="hidden" id="lng" name="lng" value="<?php echo isset($paradero->lon)?$paradero->lon:''?>">
										</div>
										<div class="col-md-6">
											<div id="map"></div>
										</div>
									</div>
									<div class="box-footer">
										<button id="submit_actualizacion" class="btn btn-primary">Guardar</button>
										<a class="pull-right btn btn-warning volver" href="<?php echo site_url('usuarios');?>">Volver</a>
									</div>
							</form>
						</div>
						<!-- /.box -->
					</div>
					<!--/.col (left) -->
				</div>
				<style>
					.subtitle-process {
						width: 100%;
						min-height: 20px;
						display: inline-block;
						text-align: center;
					}

					.loading-perfil {
						width: 40%;
						margin: 0px 30%;
					}
				</style>
				<div class="modal fade" id="infoModal" role="dialog" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog modal-lg">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-body">
								<img id="tut1" class="loading-perfil" src="<?php echo base_url('images/leaf-loading.gif');?>">
								<img id="tut2" class="loading-perfil" style="display:none;" src="<?php echo base_url('images/exception.png');?>">
								<div class="subtitle-process" id="sub-proceso-text"> Procesando datos...</div>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						$("#submit_actualizacion").on('click', function(e) {
							e.preventDefault();
							var nombre = $("#nombre").val();
							var apelli = $("#apellido").val();
							var ident = $("#ident").val();
							var cel = $("#celular").val();
							var dir = $("#direccion_paradero").val();
							var tipvi = $('input[name="tipo_vivienda"]:checked').length;
							var nparadero = $("#nombre_paradero").val();
							var hab = $("#no_habitantes").val();
							var dir1 = $("#1").val();
							var lat = $("#lat").val();
							var lng = $("#lng").val();
							var usuarioid = $("#userid").val();
							
							if (nombre.length < 2) {
								alert('Debe especificar su nombre para continuar');
								$("#nombre").focus();
								return;
							}
							if (apelli.length < 2) {
								alert('Debe especificar su apellido para continuar');
								$("#apellido").focus();
								return;
							}
							if (ident.length < 2) {
								alert('numero de identidad es requerido');
								$("#ident").focus();
								return;
							}
							if (cel.length < 2) {
								alert('Por favor proporcione un número de contacto');
								$("#cel").focus();
								return;
							}
							if(dir.length < 3){
								if (dir1.length < 4) {
									alert('Por favor proporcione una direccion utilizando los elementos de la lista');
									$("#1").focus();
									return;
								}
							}
							if (dir.length < 4) {
								alert('Por favor proporcione la direccion específica');
								$("#direccion_paradero").focus();
								return;
							}
							if (tipvi < 1) {
								alert('Por favor proporcione un tipo de vivienda');
								return;
							}
							if (nparadero.length < 4) {
								alert('Por favor proporcione del edificio o lugar');
								$("#nombre_paradero").focus();
								return;
							}
							if (hab < 1) {
								alert('Por favor indique el numero de habitantes de su vivienda');
								$("#no_habitantes").focus();
								return;
							}
							if (lat.length < 2 || lng.length < 2) {
								alert('Por favor indique el lugar preciso de su direccion dando click en el MAPA');
								$("#map").focus();
								return;
							}
							var formulario = $('#actualizar_usuario_form').serialize();
							$('#infoModal').modal("show");
							/*setTimeout(function(){
								$("#sub-proceso-text").html('');$("#sub-proceso-text").html('buscando zona..');
								setTimeout(function(){$("#sub-proceso-text").html('');$("#sub-proceso-text").html('asignando zona..');
										   setTimeout(function(){$("#sub-proceso-text").html('');$("#sub-proceso-text").html('finalizando..');
													  },2000);
										   },2000);
								},1000);*/
							
							$.ajax({
								type: "POST",
								url: "<?=site_url('usuarios/ajax_actualizarDatos')?>",
								data: formulario,
								success: function(act) {
									r = JSON.parse(act);
									if (r.code == 100) {
										$("#sub-proceso-text").html('');
										$("#sub-proceso-text").html('buscando zona..');
										/* simular un segundo de carga*/
										setTimeout(function(){
										/* continuar proceso */
										$.ajax({
											type: "POST",
											url: "<?=site_url('Ajax_request/validateZona')?>",
											data: {
												lat,lng
											},
											success: function(val) {
												console.log(usuarioid);
												zon = JSON.parse(val);
												console.log(usuarioid);
												if (zon.c == 1) {
													$("#sub-proceso-text").html('');
													$("#sub-proceso-text").html('asignando zona..');
													$.ajax({
														type: "POST",
														url: "<?=site_url('Ajax_request/asignarZona')?>",
														data: {
															'usuario': usuarioid,
															'zona': zon.zona
														},
														success: function(asig) {
															console.log(usuarioid);
															a = JSON.parse(asig);
															if (a.c == 1) {
																$("#sub-proceso-text").html('');
																$("#sub-proceso-text").html('finalizando..');
																setTimeout(function() {
																	$('#infoModal').modal("hide");
																	setTimeout(function() {window.location.href = '<?php echo site_url('sistema?i=1')?>';}, 2000);
																},1500);
															} else {
																$("#tut1").hide();$("#tut2").fadeIn();
																$("#sub-proceso-text").html('');$("#sub-proceso-text").addClass('alerta');
																$("#sub-proceso-text").html(a.m);
																setTimeout(function(){
																	$('#infoModal').modal("hide");
																	$("#sub-proceso-text").removeClass('alerta');
																	setTimeout(function(){$("#tut2").hide();$("#tut1").show();},500);
																}, 5000);
															}
														}
													})
												} else {
													/* no se consiguió zona */
													$("#tut1").hide();
													$("#tut2").fadeIn();
													$("#sub-proceso-text").html('');$("#sub-proceso-text").addClass('alerta');
													$("#sub-proceso-text").html(zon.m);
													setTimeout(function(){
														$('#infoModal').modal("hide");
														$("#sub-proceso-text").removeClass('alerta');
														setTimeout(function(){$("#tut2").hide();$("#tut1").show();},500);
													}, 5000);
												}
											}
										});
									}, 1000);/* FIN SIMULACION DE CARGA*/
										//.modal("hide");
										//setTimeout(function() { window.location.href='<?php echo site_url('sistema?i=1')?>'}, 1000);
									} else {
										//setTimeout(function() { location.reload(); }, 1000);
									}
								}
							});
						});
					});
				</script>
		</div>
		</section>

		<!-- /.content-wrapper -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url('resources/');?>bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>

	<script>
		$(document).ready(function() {});
		$("#1,#2,#3,#4").on('keyup', function() {
			armarDireccion()
		});
		$("#1,#2,#3,#4").on('change', function() {
			armarDireccion()
		});

		function armarDireccion() {
			var a1, a2, a3, a4, dir = '';
			$("#direccion_paradero").val('');
			a1 = $("#1").val();
			a2 = $("#2").val();
			a3 = $("#3").val();
			a4 = $("#4").val();
			if (a1.length > 0) {
				dir += a1;
			} else {
				return $("#1").focus();
			}
			if (a2.length > 0) {
				dir += ' ' + a2;
			}
			if (a3.length > 0) {
				dir += ' #' + a3;
			}
			if (a4.length > 0) {
				dir += '-' + a4;
			}
			$("#direccion_paradero").val(dir);
			$("#direccion_paradero").trigger('change');
		}
		// Initialize and add the map 
		var map, map2, infoWindow;
		var input = document.getElementById('direccion_paradero');
		var marcadores = <?=isset($map)?$map:'""'?>;
		var markers = [];

		function initMap() {
			var myOptions = {
				zoom: 10,
				center: new google.maps.LatLng(4.660561, -74.0784707),
				/* BOGOTA */
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			infoWindow = new google.maps.InfoWindow;
			map = new google.maps.Map(document.getElementById("map"), myOptions);
			if(marcadores.length>0){
                  for (var i = 0; i < marcadores.length; i++) {
                      var beach = marcadores[i];
                      if(i==0){map.setCenter(new google.maps.LatLng(beach[1], beach[2]));}
                      addMarker(new google.maps.LatLng(beach[1], beach[2]), map);
                      map.setZoom(16);
                  }
                }
			// Try HTML5 geolocation. /* solo funciona si esta sobre ssl HTTPS */ 
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};
					infoWindow.setPosition(pos);
					if(marcadores.length<1){
						map.setCenter(pos);
					}
				}, function() {
					handleLocationError(true, infoWindow, map.getCenter());
				});
			} else {
				// Browser doesn't support Geolocation
				handleLocationError(false, infoWindow, map.getCenter());
			}
			/* centrar en current location */
			google.maps.event.addListener(map, 'mousemove', function() {
				map.setOptions({
					draggableCursor: 'pointer'
				});
			});
			/* FIN de centrar en current location */
			
              var autocomplete = new google.maps.places.Autocomplete(document.getElementById('direccion_paradero'));
              autocomplete.bindTo('bounds', map);
              
              // Set the data fields to return when the user selects a place.
              autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);
              
              autocomplete.addListener('place_changed', function() {
                
                  var place = autocomplete.getPlace();
                  if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No existen detalles de localizacion para la direccion: '" + place.name + "', por favor utilce el mapa para especificar el punto de recoleccion.");
                    return;
                  }
                  
                  // If the place has a geometry, then present it on a map.
                  if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                  } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(16);  // Why 17? Because it looks good. 
                  }
                  
                  clearMarkers();
                  var loc = place.geometry.location;
                  console.log(loc.lat(), loc.lng());
                  addMarker(place.geometry.location, map);
                  $("#lat").val(loc.lat());
                  $("#lng").val(loc.lng());
                  var address = '';
                  if (place.address_components) {
                    address = [
                      (place.address_components[0] && place.address_components[0].short_name || ''),
                      (place.address_components[1] && place.address_components[1].short_name || ''),
                      (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                  }
                });
			/*latitud y longitud del click */
			google.maps.event.addListener(map, 'click', function(event) {
				clearMarkers();
				addMarker(event.latLng, map);
				$("#lat").val(event.latLng.lat());
				$("#lng").val(event.latLng.lng());
			});
		}

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

		function handleLocationError(browserHasGeolocation, infoWindow, pos) {
			if(marcadores.length<1){
                infoWindow.setPosition(pos);
            }
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=places&callback=initMap"></script>
</body>

</html>