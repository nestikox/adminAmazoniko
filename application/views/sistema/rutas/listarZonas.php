<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
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
        <li class="active"><a href="#">Listado de Zonas</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Listado de Zonas</b></h3>
          </div>
          <div class="box-body">
            <div class="col-md-12" style="margin:3px 0px 10px 0px">
                <div class="col-sm-2"><a href="<?=site_url('rutas/vcZona');?>"><button type="button" id="crearRuta" class="btn btn-block btn-success">Crear Zona</button></a></div>
                	<?php if(isset($message)):?>
                 <div class="col-sm-10">
                  <div class="alert alert-info alert-dismissible">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Información!</strong>
                   <?php echo $message;?>
                  </div>
                 </div>
                 <?php endif;?>     
            </div>
                <table id="zonas" class="display hover responsive cell-border">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Delimitación</th>
                            <th>Dirección</th>
														<th>Color</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                <tbody>
                  
                </tbody>
                </table>
          </div>
          <!-- /.box-body -->
        </div>
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><b> Mapa de Zonas</b></h3>
          </div>
          <div class="box-body">
            <div id="map" style="width:100%; min-height:400px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
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

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('resources/');?>dist/js/demo.js"></script>
<script src="<?= base_url('resources/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('resources/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
        $(document).ready(function(){
            var es = {"decimal":"","emptyTable":"No hay datos disponibles...","info":"Mostrando _START_ a _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 a 0 de 0 entradas","infoFiltered":"(filtrado de _MAX_ total de entradas)","infoPostFix":"","thousands":",","lengthMenu":"Mostrar _MENU_ entradas","loadingRecords": "Cargando...","processing":"Procesando datos...","search":"Busqueda:","zeroRecords":"No se encontraron coincidencias.","paginate": {"first": "Primer","last":"Ultimo","next":"Próximo","previous":"Anterior"}};
            
            $('#zonas').DataTable( {
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "<?=site_url('ajax_request/pag_zonas')?>",
                "language": es
                });
            });
    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=drawing&callback=initMap"></script>

 <script type="text/javascript">
  var map, zonas=[];
function initMap() {
  // Map Center
  var myLatLng = new google.maps.LatLng(4.695163, -74.057524);
  // General Options
  var mapOptions = {
    zoom: 12,
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.RoadMap
  };
  
    map = new google.maps.Map(document.getElementById('map'),mapOptions);
   $.ajax({
      type: "POST",
      url: "<?=site_url('ajax_request/getZonasCoords')?>",
      data: {},
      success: function(data){
       r = JSON.parse(data);
       i=0;
       $.each(r, function(){
        var color, coords,zonanombre;
        color = this.color;
        zonanombre = this.nombre;
        $.ajax({
            type: "POST",
            url: "<?=site_url('ajax_request/getZonaCoordinates/')?>"+this.id,
            data: {zoid:this.id},
            success: function(cozo){
            coords = JSON.parse(cozo);
            new google.maps.Polygon({
              map: map,
              paths: coords,
              strokeColor: "#878787",
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: color,
              fillOpacity: 0.35,
              content: zonanombre
          });
          }
          });
          //zonas[r.id]
          i++;
        });
      }
    });
    /* Definir las coordenadas del polygono
          var zona1 = */
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
