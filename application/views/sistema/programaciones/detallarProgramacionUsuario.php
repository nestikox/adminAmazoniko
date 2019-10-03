<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
						 <section class="content-header">
					<h1>Recolecciones
						<small>Detallar mi recolecci&oacute;n</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li class="active">Programaciones</li>
					</ol>
				</section>
    <!-- Main content -->
		<section class="content">
      <style>
        #map {height: 250px;  /* The height is 400 pixels */width: 90%;margin: 0px auto;/* The width is the width of the web page */}
        .small{ font-size: 10px!important;}
      </style>
      <div class="row">
        <!-- left column -->
          <div class="col-md-12">
          <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header">
                <h5>Detalles de Zona </h5>
              </div>
            <style>
              .sprite{ z-index: 10;margin-left: 5%;background: url('<?php echo base_url('images/buttonsOnOff2.png')?>') no-repeat;float: left;cursor: pointer;}
              .fa-info-circle{font-size: 25px;line-height: 50px;float: left;margin-right: 5%;margin-left: 5%;}
              .on{width: 80px;height: 50px;display: inline-block;background-position: 0 0;}
              .off{width: 80px;height: 50px;display: inline-block; /* Display icon as inline block */background-position: 0 -68px;}
            </style>
              <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6 form-group" > Tu zona es: <label style="color:<?php echo isset($programacion->color)?$programacion->color:'red';?>!important;"><?php echo isset($programacion->nombre)?$programacion->nombre:'No tiene zona asignada.';?></label></div>
                  <div class="col-md-6 form-group"> Dias de recolección: <label><?php echo isset($programacion->dia)?$programacion->dia:'-';?></label></div>
                  <div class="col-md-6 form-group">
                        <label>Fechas de Recoleccion</label><br>
                        <select class="form-control" name="fechaProxima" id="fechaProxima" <?php if($fecha['r2']>0){echo 'title="Ya ha programado una fecha de recolección"';}?> required <?php if($fecha['r2']>0){echo 'disabled';}?>>
                            <option value=""> Seleccione </option>
                            <?php foreach($fecha['proximas'] as $k=>$v):?>
                              <!-- si existe recoleccion sobre la fecha finalizadas no mostrar -->
                              <?php if($v->recoleccionEstado!=4 and $v->recoleccionEstado!=5 and $v->recoleccionEstado!=3):?>
                                <option value="<?php echo $v->id;?>"><?php echo $v->nuevafecha;?> </option>
                              <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <?php if($fecha['r1']<1):?>
                      <div class="col-md-6 form-group">
                        <?php if($paraderoExiste==0):?>
                         <h4>Nota: El usuario no ha configurado la informacion de paradero por favor <a href="<?php echo site_url('usuarios/perfilUsuario');?>">actualice sus datos</a>.</h4>
                        <?php else:?>
                        <h4>Nota: No existen fechas proximas para mostrar.</h4>
                        <?php endif;?>
                      </div>
                    <?php endif;?>
                    <?php if($fecha['r2']>0):?>
                    <div class="col-md-12 form-group">
                        <label>Recolecciones solicitadas:</label><br>
                        <table class="table">
                          <tbody>
                            <?php foreach($fecha['programadas'] as $k=>$v):?>
                              <tr>
                                <td>Próxima fecha de recolección: <b><?php echo $v->nuevafecha;?></b></td>
                                <td>
                                  <a href="#" onclick="confirmarBorrado('<?php echo site_url('programaciones/borrarFechaUsuario?pf='.$v->id.'&u='.$v->usuario_id);?>')" ><i class="fa fa-trash"></i> Cancelar Recolección</a>
                                </td>
                              </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>
                    <?php endif;?>
                     <?php if($fecha['r3']>0):?>
                     <div class="col-md-12 form-group">
                        <label>Ultimas recolecciónes:</label><br>
                        <table class="table">
                          <thead><tr><th class="small">Recolección:</th><th class="small">Estado:</th></tr></thead>
                          <tbody>
                            <?php foreach($fecha['pasadas'] as $k3=>$v3):?>
                              <tr>
                                <td>Fecha de recolección: <b><?php echo $v3->nuevafecha;?></b> </td>
                                <td><b>Finalizada</b></td>
                              </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>
                    <?php endif;?>
                </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="col-sm-4">
                  <button id ="guardarProg" type="submit" class="btn btn-success" <?php if($paraderoExiste==0){echo "disabled";}?>>Programar Recolecci&oacute;n&nbsp;&nbsp;<i class="fa fa-clock-o"></i></button>
                </div>
                <div class="col-sm-8">
                      <div id="alert_message" class="alert alert-warning alert-dismissible" style="display: none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <div id="mensaje_text"><strong>Success!</strong> Indicates a successful or positive action.</div>
                    </div>
                </div>
                
              </div>
              <script>
                $(document).ready(()=>{
                  /*boton RECOLECCION */
                    $("#recoleccion_act").on('click', ()=>{
                      $.ajax({
														type: "POST",
														url: "<?=site_url('programaciones/pro_recoleccionUsuario')?>",
														data: {},
														success: function(data){
                              console.log(data);
															r = JSON.parse(data);
														}
												});
                        /*if($("#recoleccion_act").hasClass('on')){
                          $("#recoleccion_act").removeClass('on').addClass('off');  
                        }else{
                          $("#recoleccion_act").removeClass('off').addClass('on');  
                        }*/
                      });
                  /*boton RECOLECCION AUTOMATICA */
                    $("#recoleccion_act_auto").on('click', ()=>{
                      $.ajax({
														type: "POST",
														url: "<?=site_url('programaciones/recAutoUsuario')?>",
														data: {},
														success: function(data){
                              console.log(data);
															r = JSON.parse(data);
														}
												});
                        /*if($("#recoleccion_act_auto").hasClass('on')){
                          $("#recoleccion_act_auto").removeClass('on').addClass('off');  
                        }else{
                          $("#recoleccion_act_auto").removeClass('off').addClass('on');  
                        }*/
                      });
                  });
              </script>
            </div>
          </div>
        </div>
	      <div class="row">
        <!-- left column -->
        <form id="recoleccion_form" enctype="multipart/form-data" method="POST" action="<?php echo site_url('programaciones/guardarParaderoUsuario');?>">
          <div class="col-md-12">
          <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header">
                <h4>Informacion de recolecci&oacute;n</h4>
              </div>
              <div class="box-body">
              <div class="col-md-6">
                  <div class="col-md-12 form-group">
                      <label>Direcci&oacute;n</label>
                      <input type="text" class="form-control" placeholder="Calle 100 # 12-45" id="direccion_paradero" name="direccion_paradero" value="<?php echo isset($paradero->address)?$paradero->address:''?>">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Tipo de vivienda</label><br>
                      <input type="radio" name="tipo_vivienda" value="Casa" <?php echo (isset($paradero->tipo_vivienda) and $paradero->tipo_vivienda=='Casa')?'checked':'';?>> Casa
                      <span class="checkmark"></span>
                      <input type="radio" name="tipo_vivienda" value="Apartamento" <?php echo (isset($paradero->tipo_vivienda) and $paradero->tipo_vivienda=='Apartamento')?'checked':'';?>> Apartamento
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Nombre conjunto / edificio</label>
                      <input type="text" class="form-control" placeholder="Edificio monaco" id="nombre_paradero" name="nombre_paradero" value="<?php echo isset($paradero->nombre)?$paradero->nombre:''?>">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Informaci&oacute;n adicional</label>
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
      <form id="recoleccion_form" enctype="multipart/form-data" method="POST" action="<?php echo site_url('programaciones/guardarProgramacionUsuario');?>">	
    </div>
      </form><!-- fin del formulario de programacion -->
      
    </section>
					<!-- /.content -->
  </div>
  <!-- /.content-wrapper  <footer class="main-footer"><div class="pull-right hidden-xs"><b>Version</b> 1.0</div><strong>Copyright &copy; Amazoniko 2019 </strong> All rights reserved.</footer> -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
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

<script>
  function confirmarBorrado(url){
    c = confirm('Desea eliminar la programacion de la fecha seleccionada?');
    if(c){
      window.location.href = url;
    }else{
      return false;
    }
  }
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('resources/');?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>

<script>
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
              function handleLocationError(browserHasGeolocation, infoWindow, pos){ infoWindow.setPosition(pos);
                       infoWindow.setContent(browserHasGeolocation ?
                                       'Error: The Geolocation service failed.' :
                                       'Error: Your browser doesn\'t support geolocation.');
                 //infoWindow.open(map);
               }
              
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
	$("#guardad_info_paradero").click(function(e){
	e.preventDefault();
  $("#alert_message").fadeOut();
	var nomruta = $("#nombre_ruta");
	var coempresa = $("#co_empresa");
	var nomparad = $("#nombre_paradero");
	var dirparad = $("#direccion_paradero");
	var lat =$("#lat");
	var lon =$("#lon");
  var tipov = $('input[name=tipo_vivienda]:checked', '#recoleccion_form').val();
	/* validadores */
  if(dirparad.val().length<5){
	$("#mensaje_text").html("Por favor proporcione la direccion y descripcion detallada del lugar de recoleccion.");$("#alert_message").fadeIn();
	dirparad.focus(); return 0;}
  if(typeof tipov =='undefined'){
  $("#mensaje_text").html("Por favor indique el tipo de vivienda");$("#alert_message").fadeIn();
	return 0;}
  if(nomparad.val().length<2){
    $("#mensaje_text").html("Por favor indique el nombre de su paradero");$("#alert_message").fadeIn();
		nomparad.focus(); return 0;}
  if(lat.val().length<2 && lon.val().length<2){
    $("#mensaje_text").html("<strong>Precaucion!</strong> Haciendo uso del mapa, Haga click para determinar la direccion especificada para continuar.");$("#alert_message").fadeIn();
    return 0;}
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
  $("#guardarProg").click(function(e){
    e.preventDefault();
    var programacionFc = $("#fechaProxima").val();
    var usuario = <?=$usuario?>;
     if(programacionFc.length<1){
      alert('Debe seleccionar una fecha para agendar la programacion.');
      return;
     }
    $.ajax({
        type: "POST",
        url: "<?=site_url('ajax_request/postularRecoleccion')?>",
        data: {fechaId:programacionFc, usuario},
        success: function(data){
          r = JSON.parse(data);
          if(r.result==1){
            alert(r.m);
            setTimeout(function(){location.reload();},1000);
          }
          if(r.result==0){
              alert(r.m);
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
