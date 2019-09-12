<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Crear Zona<br>
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
        <form role="form" id="rutasForm" method="POST" action="<?php echo site_url('rutas/crearZona');?>" enctype="multipart/form-data">
        <!-- /.row -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-default">
              <!-- form start -->
                <div class="box-body">
                      <div class="col-md-4 form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre">
                      </div>
                      <div class="col-md-8 form-group">
                            <label>Dirección</label>
                            <input type="text" class="form-control" placeholder="Dirección" id="direccion" name="direccion">
                        </div>
                      <div class="col-md-12 form-group">
                        <label>Delimitacion</label>
                        <input type="textarea" autocomplete='OFF' class="form-control" id="delimitacion" name="delimitacion" placeholder="Descripcion de la Zona">
                      </div>  
                      <div class="col-md-12 form-group">
                        <label>Descripcion</label>
                        <input type="textarea" autocomplete='OFF' class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion de la Zona">
                      </div>
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
                      <div id="map"></div>
                       <div id="panel">
                          <div id="color-palette"></div>
                          <div>
                              <button id="delete-button" class="btn btn-default"> Borrar Zona</button>
                          </div>
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
<script src="<?=base_url()?>resources/plugins/jquery/dist/jquery.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=drawing&callback=initMap"></script>
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
  

/* MAPA CON TRAZO DE LINEAS */
/*
 var poly;
 var map;
 var markers = [];
function initMap(){
var mapDiv = document.getElementById('map');
   map = new google.maps.Map(mapDiv, { center: new google.maps.LatLng(4.677457387401735,-74.07734868150504),zoom: 13,mapTypeId: google.maps.MapTypeId.ROADMAP});
   google.maps.event.addListener(map, 'mousemove', function() {
    map.setOptions({draggableCursor:'pointer'});
      });
  
   poly = new google.maps.Polyline({
    strokeColor: '#000000',
    strokeOpacity: 1.0,
    strokeWeight: 3
  });
  poly.setMap(map);
  map.addListener('click', addLatLng);
  }
  function addLatLng(event) {
  var path = poly.getPath();
  // Because path is an MVCArray, we can simply append a new coordinate
  // and it will automatically appear.
  path.push(event.latLng);
  // Add a new marker at the new plotted point on the polyline.
  var marker = new google.maps.Marker({
    position: event.latLng,
    title: '#' + path.getLength(),
    map: map
  });
}
 var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: {lat: 4.677457387401735, lng: -74.07734868150504},
    mapTypeId: 'roadmap'
  });
      var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.MARKER,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [ 'polygon', 'rectangle']
          },
          markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
          circleOptions: {
            fillColor: '##00e600',
            fillOpacity: 0.5,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1
          }
        });
        drawingManager.setMap(map);
    }
  // Add a new marker at the new plotted point on the polyline.
// Construct a draggable red triangle with geodesic set to true.
*/
	</script>
 <script type="text/javascript">
            var drawingManager;
            var selectedShape;
            var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
            var selectedColor;
            var colorButtons = {};
            var coordenadasPoly = [];
            function clearSelection () {
                if (selectedShape) {
                    selectedShape.setEditable(true);
                    selectedShape = null;
                }
            }
            function setSelection (shape) {
                clearSelection();
                // getting shape coordinates
                var v = shape.getPath();
                for (var i=0; i < v.getLength(); i++) {
                  var xy = v.getAt(i);
                  console.log('Cordinate lat: ' + xy.lat() + ' and lng: ' + xy.lng());
                }
                selectedShape = shape;
                shape.setEditable(true);
                selectColor(shape.get('fillColor') || shape.get('strokeColor'));
            }
            function deleteSelectedShape (e) {
             e.preventDefault();
                if (selectedShape) {
                    selectedShape.setMap(null);
                }
            }
            function selectColor (color) {
                var htmlcolor = '';
                selectedColor = color;
                for (var i = 0; i < colors.length; ++i) {
                    var currColor = colors[i];
                    colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
                }
                // Retrieves the current options from the drawing manager and replaces the
                // stroke or fill color as appropriate.
                /*var polylineOptions = drawingManager.get('polylineOptions');
                polylineOptions.strokeColor = color;
                drawingManager.set('polylineOptions', polylineOptions);
                var rectangleOptions = drawingManager.get('rectangleOptions');
                rectangleOptions.fillColor = color;
                drawingManager.set('rectangleOptions', rectangleOptions);
                var circleOptions = drawingManager.get('circleOptions');
                circleOptions.fillColor = color;
                drawingManager.set('circleOptions', circleOptions);*/
                var polygonOptions = drawingManager.get('polygonOptions');
                polygonOptions.fillColor = color;
                var dataColor = document.querySelector("#color_data");
                htmlcolor+= "<input name='colorpoligono' type='hidden' value=\""+color;
                htmlcolor+= "\"/>";
                dataColor.innerHTML=htmlcolor;
                drawingManager.set('polygonOptions', polygonOptions);
            }
            
            function setSelectedShapeColor (color) {
                console.log('fn setSelectedShapeColor()');
                console.log(selectedShape);
                if (selectedShape) {
                    if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
                        selectedShape.set('strokeColor', color);
                    } else {
                        selectedShape.set('fillColor', color);
                    }
                }
            }
            function makeColorButton (color) {
                var button = document.createElement('span');
                button.className = 'color-button';
                button.style.backgroundColor = color;
                google.maps.event.addDomListener(button, 'click', function () {
                    selectColor(color);
                    setSelectedShapeColor(color);
                });
                return button;
            }
            function buildColorPalette () {
                var colorPalette = document.getElementById('color-palette');
                for (var i = 0; i < colors.length; ++i) {
                    var currColor = colors[i];
                    var colorButton = makeColorButton(currColor);
                    colorPalette.appendChild(colorButton);
                    colorButtons[currColor] = colorButton;
                }
                selectColor(colors[0]);
            }
            function initMap () {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: new google.maps.LatLng(4.677457387401735,-74.07734868150504),
                    disableDefaultUI: true,
                    zoomControl: true
                });
                var polyOptions = {
                    strokeWeight: 0,
                    fillOpacity: 0.45,
                    draggable: true
                };
                // Creates a drawing manager attached to the map that allows the user to draw
                // markers, lines, and shapes.
                drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    drawingControlOptions: {
                       position: google.maps.ControlPosition.TOP_CENTER,
                       drawingModes: ['polygon']
                     },
                    polygonOptions: polyOptions,
                    map: map
                });
                
                google.maps.event.addListener(drawingManager, 'overlaycomplete', function (e) {
                    if (e.type !== google.maps.drawing.OverlayType.MARKER) {
                        // Switch back to non-drawing mode after drawing a shape.
                        drawingManager.setDrawingMode(null);
                        // Add an event listener that selects the newly-drawn shape when the user
                        // mouses down on it.
                        var newShape = e.overlay;
                        newShape.type = e.type;
                        google.maps.event.addListener(newShape, 'click', function (e) {
                            if (e.vertex !== undefined) {
                                if (newShape.type === google.maps.drawing.OverlayType.POLYGON) {
                                    var path = newShape.getPaths().getAt(e.path);
                                    path.removeAt(e.vertex);
                                    if (path.length < 3) {
                                        //newShape.setEditable(false);
                                        newShape.setMap(null);
                                    }
                                }
                                if (newShape.type === google.maps.drawing.OverlayType.POLYLINE) {
                                    var path = newShape.getPath();
                                    path.removeAt(e.vertex);
                                    if (path.length < 2) {
                                        newShape.setMap(null);
                                    }
                                }
                            }
                            setSelection(newShape);
                        });   
                        setSelection(newShape);
                        getPolygonCoords();
                    }
                     google.maps.event.addListener(selectedShape, "dragend", getPolygonCoords);
                     google.maps.event.addListener(selectedShape.getPath(), "insert_at", getPolygonCoords);
                     google.maps.event.addListener(selectedShape.getPath(), "set_at", getPolygonCoords);
                     /*google.maps.event.addListener(selectedShape.getPath(), 'remove_at', getPolygonCoords());*/
                     /*console.log(selectedShape);*/
                });
                
                var getPolygonCoords = function(){
                     console.log('VECTOR ACTUALIZADO');
                     var len = selectedShape.getPath().getLength();
                     var htmlStr = ""; htmlData = "";coordenadasPoly = [];
                     var dataHolder = document.querySelector('#coordenadas');
                     var dataP = document.querySelector("#coordenadas_data");
                     dataP.innerHTML = '';
                     htmlStr += "[";
                     for (var i = 0; i < len; i++) {
                        htmlData+= "<input name='coordenadaspoligono["+i+"]' type='hidden' value=\""+selectedShape.getPath().getAt(i).toUrlValue(6);
                        htmlData+= "\"/>";
                        if(i>0){htmlStr +=",";}
                        htmlStr += "{";
                        htmlStr += selectedShape.getPath().getAt(i).toUrlValue(6);
                        htmlStr += "}";
                        //htmlStr += selectedShape.getPath().getAt(i).toUrlValue(6);
                        //htmlStr +="}";
                        //coordenadasPoly.push(htmlStr);
                     }
                     htmlStr += "]";
                     dataHolder.innerHTML = htmlStr;
                     dataP.innerHTML = htmlData;
                     };
                
                // Clear the current selection when the drawing mode is changed, or when the
                // map is clicked.
                google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
                google.maps.event.addListener(map, 'click', clearSelection);
                
                var botonBorrar = document.getElementById('delete-button');
                google.maps.event.addDomListener(botonBorrar, 'click', deleteSelectedShape);
                buildColorPalette();
            }
            
        </script>
</body>
</html>
