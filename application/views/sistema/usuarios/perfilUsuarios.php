<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<style>
.perfilimg{width:40%;min-height:20px;object-fit:contain;margin:2px 25%; background-color:lightgrey;}
.bar {height: 18px;background: green;}
/* Set the size of the div element that contains the map */
#map {height: 250px;  /* The height is 400 pixels */width: 90%;margin: 0px auto;/* The width is the width of the web page */}
.form-control2, .select {
    display: block; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none;
    border: 1px solid #ccc; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075); box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
.no-paddin-on-sides{
  padding-left:0px!important;
  padding-right:0px!important;
}
.no-padding-right{
  padding-right:0px!important;
}
.no-padding-left{
  padding-left:0px!important;
}
</style>
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
					<h1><?php if(isset($titulo_perfil)){ echo $titulo_perfil;}else{ echo "Editar Usuario";};?>
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li class="active"><?php if(isset($titulo_perfil)){ echo $titulo_perfil;}else{ echo "Editar Usuario";};?></li>
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
      <form role="form" enctype="multipart/form-data" id="actualizar_usuario_form" method="POST" action="<?php echo site_url('usuarios/eUsuario');?>">
        <div class="box-body">
          <div class="row">
                <div class="col-md-3 form-group">
                  <label>Nombres</label>
									<input type="hidden" name="userid" value="<?php echo $usuario->id;?>">
                  <input type="text" class="form-control" placeholder="Nombres" value="<?php echo $usuario->first_name;?>" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-3 form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" placeholder="Apellidos" id="apellido" name="apellido" value="<?php echo $usuario->last_name;?>" required>
                </div>
								<div class="col-md-3 form-group">
                  <label>No. de identificación</label>
                  <input type="text" class="form-control" placeholder="No. de identificación" id="ident" value="<?php echo $usuario->rut;?>" name="ndoc"  required>
                </div>
            <!--<div class="col-md-3 form-group">
                    <label>Perfil</label>
                <select class="form-control select2" style="width: 100%;" <?php if(!$this->ion_auth->is_admin()){ echo "disabled";}?>>
                <option value="">Seleccione</option>
                <?php foreach($grupos as $k => $v):?>
                <option value="<?php echo $v->id;?>" <?php if($usuario->group_id ==$v->id){echo "selected";}?>><?php echo $v->name;?></option> 
                <?php endforeach;?>
              </select>
            </div>-->
			<div class="col-md-3 form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="Email" placeholder="Email" disabled="disabled" value="<?php echo $usuario->email ?>" name="correo" <?php if(!$this->ion_auth->is_admin()){ echo "disabled";}?>>
                </div>
        </div>
		<div class="row">
          <div class="col-md-3 form-group">
            <label for="exampleInputPassword1">Contraseña</label>
              <input type="password" class="form-control" id="InputPassword1" placeholder="Contraseña" name="clave">
          </div>
          <div class="col-md-3 form-group">
            <label for="exampleInputPassword1">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="InputPassword2" placeholder="Contraseña">
          </div>
		  <div class="col-md-3 form-group">
             <label>Celular</label>
             <input type="text" class="form-control" id="celular" placeholder="Celular" value="<?php echo $usuario->phone;?>" name="celular">
          </div>
      <div class="col-md-3 form-group" >
                <label style="">Mis Puntos</label>
								<input type="text" value="<?php echo number_format(intval($usuario->puntos),0,',','.');?>" class="form-control" readonly>
              </div>
        </div>
        <div class="row">
			<?php if($this->ion_auth->is_admin()){ ?>
              <div class="col-md-4 form-group">
                <label>Estado</label><br>
								<div class="col-md-6 form-group">Activo  <input type="radio" name="activo" value="true" class="flat-red" <?php if($usuario->active ==1){echo "checked";}?>>
                </div>
                <div class="col-md-6 form-group">Inactivo  <input type="radio" name="activo" value="false" class="flat-red" <?php if($usuario->active ==0){echo "checked";}?>>
                </div>
              </div>
			<?php }?>
                <div class="col-md-3 form-group" >
								 <label>Imagen de perfil </label><br>  
								<?php if(isset($usuario->imagen) and strlen($usuario->imagen)>3):?>
									<img src="<?php echo base_url('images/profiles/'.$usuario->imagen);?>" class="perfilimg">
								<?php else:?>
									<img src="<?php echo base_url('images/img/avatar/1.png');?>"  class="perfilimg">
								<?php endif;?>
							</div>
              <div class="col-md-3 form-group" >
                <label style="padding-bottom: 30px;">Subir Imagen Nueva</label>
								<input id="fileupload" type="file" name="userfile" data-url="<?php echo site_url('usuarios/uploadPerfil');?>">
              </div>
              
        </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button id="submit_actualizacion" class="btn btn-primary">Guardar</button>
								<a class="pull-right btn btn-warning volver"  href="<?php echo site_url('usuarios');?>">Volver</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      	<script>
$(document).ready(function(){
    $("#submit_actualizacion").on('click', function(e){
      e.preventDefault();
      var nombre = $("#nombre").val();
      var apelli = $("#apellido").val();
      var ident = $("#ident").val();
      var pwr = $("#InputPassword1").val();
      var pwr2 = $("#InputPassword2").val();
      var cel = $("#celular").val();
      
      if(nombre.length<2){ alert('Debe especificar su nombre para continuar');$("#nombre").focus();return;}
      if(apelli.length<2){alert('Debe especificar su apellido para continuar');$("#apellido").focus();return;}
      if(ident.length<2){alert('numero de identidad es requerido');$("#ident").focus();return;}
      if(cel.length<2){alert('Por favor proporcione un n&uacute;mero de contacto');$("#cel").focus();return;}
      if(pwr.length>2){
        if(pwr.length<7){alert('La clave debe contener 8 caracteres m&iacute;nimo.');$("#InputPassword1").focus();return;}  
        if(pwr != pwr2){alert('Las claves no coinciden.');$("#InputPassword1").focus();return;}  
      }
      $("#actualizar_usuario_form").submit();
    });
});
</script>
      <!-- /.row -->
      <?php if($this->ion_auth->in_group('members')){ ?>
      <div class="row">
        <!-- left column -->
        <form id="recoleccion_form" enctype="multipart/form-data" method="POST" action="<?php echo site_url('programacion/guardarParaderoUsuario');?>">
          <div class="col-md-12">
          <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header">
                <h4>Informaci&oacute;n de recolecci&oacute;n</h4>
              </div>
              <div class="box-body">
              <div class="col-md-6">
              <label>Direcci&oacute;n</label>
              <div class="row">
                <div class="col-md-3 form-group no-padding-right">
                  <select class="form-control" id="1" name="1">
                    <option value="">Seleccione</option>
                    <option value="Avenida">Avenida</option>
                    <option value="Calle">Av. Calle</option>
                    <option value="Carrera">Av. carrera</option>
                    <option value="Calle">Calle</option>
                    <option value="kr">Carrera</option>
                    <option value="Circular">Circular</option>
                    <option value="Diagonal">Diagonal</option>
                    <option value="Transversal">Transversal</option>
                  </select>
                </div>
                <div class="col-md-3 form-group no-paddin-on-sides">
                  <input type="text" class="form-control no-paddin-on-sides" id="2" name="2" value="">
                </div>
               <div class="col-md-1 form-group">#</div>
               <div class="col-md-2 no-paddin-on-sides">
                <input type="text" class="form-control no-paddin-on-sides" id="3" name="3" value="">
               </div>
                <div class="col-md-1 form-group">-</div>
                <div class="col-md-2 no-padding-left">
                  <input type="text" class="form-control no-paddin-on-sides" id="4" name="4" value="">
                </div>
						</div>
              <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" placeholder="Calle 100 # 12-45" id="direccion_paradero" name="direccion_paradero" value="<?php echo isset($paradero->address)?$paradero->address:''?>">
                  </div>
              </div>
              <div class="col-md-6 form-group">
                <label>Tipo de vivienda</label><br>
                  <input type="radio" name="tipo_vivienda" value="Casa" <?php echo (isset($paradero->tipo_vivienda) and $paradero->tipo_vivienda=='Casa')?'checked':'';?>>&nbsp;<i class="fa fa-home"></i> Casa
                  <span class="checkmark"></span>
                  <br>
                  <input type="radio" name="tipo_vivienda" value="Apartamento" <?php echo (isset($paradero->tipo_vivienda) and $paradero->tipo_vivienda=='Apartamento')?'checked':'';?>>&nbsp;<i class="fa fa-building"></i> Apartamento
                  <span class="checkmark"></span>
              </div>
                  <div class="col-md-6 form-group">
                      <label>Nombre conjunto / edificio</label>
                      <input type="text" class="form-control" placeholder="Edificio monaco" id="nombre_paradero" name="nombre_paradero" value="<?php echo isset($paradero->nombre)?$paradero->nombre:''?>">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Información adicional</label>
                      <input type="text" class="form-control" placeholder="Int 4 / casa 5 / apto 606" id="informacion_adicional" name="informacion_adicional" value="<?php echo isset($paradero->address_detail)?$paradero->address_detail:''?>">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Número de habitantes</label>
                      <input type="text" class="form-control" placeholder="" id="no_habitantes" name="no_habitantes" value="<?php echo isset($paradero->habitantes)?$paradero->habitantes:''?>">
                  </div>
                  <div class="col-md-6 form-group">
                      <input type="hidden" class="form-control" id="lat" name="lat" placeholder="Latitud" title="Seleccione desde el mapa" value="<?php echo isset($paradero->lat)?$paradero->lat:''?>" readonly>
                  </div>
                  <div class="col-md-6 form-group">
                      <input type="hidden" class="form-control" id="lon" name="lon" placeholder="Longitud" title="Seleccione desde el mapa" value="<?php echo isset($paradero->lon)?$paradero->lon:''?>" readonly>
                  </div>
				  <div class="col-md-12">
					<button id ="guardad_info_paradero" type="submit" class="btn btn-success">Guardar datos de Recoleccion &nbsp;<i class="fa fa-floppy-o"></i></button>
                </div>
                </div>
              <div class="col-md-6">
                  <div id="map"></div>
              </div>				
              </div>
              <div class="box-footer">
              <div class="col-sm-8">
                    <div id="alert_message" class="alert alert-warning alert-dismissible" style="display: none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <div id="mensaje_text"><strong>Success!</strong> Indicates a successful or positive action.</div>
                  </div>
                </div>
  
                </div>
              </div>
            </div>
          </form><!-- fin del formulario de recoleccion -->
        </div>
      <?php } ?>
    </section>
    <!-- /.content -->
  </div>
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
  $("#1,#2,#3,#4").on('keyup', function(){armarDireccion()});
  $("#1,#2,#3,#4").on('change', function(){armarDireccion()});
  function armarDireccion(){
    var a1,a2,a3,a4,dir='';
    $("#direccion_paradero").val('');
    a1=$("#1").val();a2=$("#2").val();a3=$("#3").val();a4=$("#4").val();
    if(a1.length>0){ dir+=a1; }else{ return $("#1").focus();}
    if(a2.length>0){ dir+=' '+a2; }
    if(a3.length>0){ dir+=' # '+a3; }
    if(a4.length>0){ dir+=' - '+a4; }
    $("#direccion_paradero").val(dir);
    $("#direccion_paradero").trigger('change');
  }
	// Initialize and add the map 
  var map, map2,infoWindow;
  var input = document.getElementById('direccion_paradero');
  var marcadores = <?=isset($map)?$map:'""'?>;
  var markers = [];
					function initMap(){
						var myOptions = { zoom: 10, center: new google.maps.LatLng(4.677457387401735,-74.07734868150504), mapTypeId: google.maps.MapTypeId.ROADMAP };
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
							/* centrar en current location */
							// Try HTML5 geolocation. /* solo funciona si esta sobre ssl HTTPS */ 
							if (navigator.geolocation) {
														navigator.geolocation.getCurrentPosition(function(position) {
																var pos = {lat: position.coords.latitude,lng: position.coords.longitude};
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
                  $("#lon").val(loc.lng());
                  var address = '';
                  if (place.address_components) {
                    address = [
                      (place.address_components[0] && place.address_components[0].short_name || ''),
                      (place.address_components[1] && place.address_components[1].short_name || ''),
                      (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                  }
                });
							/* centrar en current location */
							google.maps.event.addListener(map, 'mousemove', function() { map.setOptions({draggableCursor:'pointer'}); });
							/* FIN de centrar en current location */
							/*latitud y longitud del click */
							google.maps.event.addListener(map, 'click', function( event ){
                clearMarkers();
                addMarker(event.latLng, map);
                $("#lat").val(event.latLng.lat());
                $("#lon").val(event.latLng.lng());
                });
          }
							// Sets the map on all markers in the array.
              function setMapOnAll(map) { for (var i = 0; i < markers.length; i++) {markers[i].setMap(map);} }
							// Adds a marker to the map and push to the array.
							function addMarker(location, map) { var marker = new google.maps.Marker({position: location,animation: google.maps.Animation.DROP,map: map});markers.push(marker);}
							// Removes the markers from the map, but keeps them in the array.
							function clearMarkers() {setMapOnAll(null);}
              // Deletes all markers in the array by removing references to them.
							function deleteMarkers() {clearMarkers();markers = [];}
              function handleLocationError(browserHasGeolocation, infoWindow, pos) { infoWindow.setPosition(pos);
                       infoWindow.setContent(browserHasGeolocation ?
                                       'Error: The Geolocation service failed.' :
                                       'Error: Your browser doesn\'t support geolocation.');
                 //infoWindow.open(map);
               }
                
							$(document).ready(function(){
											$("#guardad_info_paradero").click(function(e){
												e.preventDefault();
                        $("#alert_message").fadeOut();
												var nomruta = $("#nombre_ruta");
												var coempresa = $("#co_empresa");
												var nomparad = $("#nombre_paradero");
												var dirparad = $("#direccion_paradero");
												var lat =$("#lat");
												var lon =$("#lon");
                        var user_id = <?=$usuario->id?>;
                        var tipov = $('input[name=tipo_vivienda]:checked', '#recoleccion_form').val();
												/* validadores */
                        if(dirparad.val().length<5){
													$("#mensaje_text").html("Por favor proporcione la direccion y descripcion detallada del lugar de recoleccion.");$("#alert_message").fadeIn();
													dirparad.focus(); return 0;
												}
                        if(typeof tipov =='undefined'){
                          $("#mensaje_text").html("Por favor indique el tipo de vivienda");$("#alert_message").fadeIn();
													return 0;    
                        }
                        
												if(nomparad.val().length<2){
													$("#mensaje_text").html("Por favor indique el nombre de su paradero");$("#alert_message").fadeIn();
													nomparad.focus(); return 0;
												}
												if(lat.val().length<2 && lon.val().length<2){
													$("#mensaje_text").html("<strong>Precaucion!</strong> Haciendo uso del mapa, Haga click para determinar la direccion especificada para continuar.");$("#alert_message").fadeIn();
													return 0;
												}
                        var formulario = $('#recoleccion_form').serialize();
												$.ajax({
														type: "POST",
														url: "<?=site_url('rutas/ajax_guardarParadero_usuario')?>",
														data: formulario,
														success: function(data){
															r = JSON.parse(data);
															if(r.result==1){
																alert(r.mensaje);
																$("#rutasForm").find("input[type=text],input[type=number], textarea").val("");
																setTimeout(function(){location.reload();},1000);
															}
															if(r.result==0){
																	alert(r.mensaje);
                                  setTimeout(function(){location.reload();},1000);
															}
														}
												}); 
											});
											
										});
	</script>
	
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=places&callback=initMap"></script>

</body>
</html>
