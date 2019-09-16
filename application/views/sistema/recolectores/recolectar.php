<?php echo $head;?>

<body class="hold-transition skin-green sidebar-mini">
  <link rel="stylesheet" href="<?php echo base_url('resources/');?>bower_components/jquery-ui/themes/south-street/jquery-ui.min.css">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
		<script>
            function cargarParaderos(idr){
              $.ajax({
                type: "POST",
                url: "<?=site_url('ajax_request/getParaderosRecoleccion/'.$idRecoleccion)?>",
                data: {idruta:idr},
                success: function(data){
                  r = JSON.parse(data);
                    if(r.code>0){
                      $("#recolectarParadero").fadeIn();
                      $("#finalizarRecoleccion").hide();
                      $("#paraderos").html(r.d);
                      if(r.code==2){
                        $("#recolectarParadero").hide();
                        $("#finalizarRecoleccion").fadeIn();
                      }
                    }else{
                      alert(r.m);
                    }    
                }
                });
            }
        </script>
    <!-- Content Header (Page header) -->
						<section class="content-header">
								<h1>Recoleccion #<?php echo $idRecoleccion;?></h1>
								<ol class="breadcrumb">
										<li><a href="<?php echo site_url('sistema');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
										<li><a href="#">Recolectar</a></li>
                    <li class="active"><a href="#">Recolecciones</a></li>
								</ol>
						</section>
    <!-- Main content -->
<section class="content">
        <div class="box box-default">
                <div class="box-header with-border">
                    <h4 class="box-title"><b>Datos de recoleccion</b></h4><br>
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
            <div class="box-body">
              <style>
                /*  * Rating styles*/
                .rating {    width: 100%;margin: 0 auto 1em;font-size: 15px;overflow: hidden;}
                .rating input {float: right;opacity: 0;position: absolute;}
                .rating a,.rating label {float:right;color: #aaa;text-decoration: none;-webkit-transition: color .4s;-moz-transition: color .4s;-o-transition: color .4s;transition: color .4s;}
                .rating label:hover ~ label,.rating input:focus ~ label,.rating label:hover,.rating a:hover,.rating a:hover ~ a,
                .rating a:focus,.rating a:focus ~ a		{color: orange;cursor: pointer;}
                .rating2 {direction: rtl;}.rating2 a {float:none}
                /**/
                label{font-size:10px;}
                input.form-control{padding: 4px 6px!important;height: 20px!important;font-size: 12px!important;font-weight: bolder!important;}
                select{padding: 0px 15px 0px 0px!important;height: 20px!important;font-size: 10px!important;font-weight: bolder!important;}
                .mid{ margin: 25px 0px; }
                br{font-size: 4px;}
                .btn-success{font-size:10px;}
                .btn-warning{font-size:10px;}
                button.btn.btn-success{margin: 17px 0px 0px 0px;}
                button.btn.btn-warning{margin: 17px 0px 0px 0px;}
                small{font-size: 60%;}
                table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;border-bottom: 2px solid #111!important;}
                label.star{font-size: 99%!important;}
              </style>
              <form id="recoleccion_data">
                <div class="row">
                    <div class="col-md-4" style="margin:3px 0px 10px 0px">
                      <div class="col-md-6 form-group">
                        <input type="hidden" id="recolector" name="recolector" value="<?php echo $usuarioRecolector;?>">
                        <label>Bolsa-A <small>(Plasticos)</small></label>
                        <input type="number" id="bolsaa" name="bolsaa" value="0" class="form-control">
                        <label>Bolsa-B <small>(carton, papel,otros)</small></label>
                        <input type="number" id="bolsab" name="bolsab" value="0" class="form-control">
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Peso-A </label>
                        <input type="number" id="pesoa" name="pesoa" step="0.1" min="0" max="100" value="0" class="form-control">
                        <label>Peso-B </label>
                        <input type="number" id="pesob" name="pesob" step="0.1" min="0" max="100" value="0" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-8" style="margin:3px 0px 10px 0px">
                      <div class="col-md-5 mid">
                        <label>Paradero</label>
                        <select id="paraderos" name="paradero" class="form-control">
                          <option value="">Seleccione...</option>
                        </select>
                      </div>
                      <div class="col-md-2 mid">
                        <label>Puntos</label>
                        <input type="number" id="puntos" name="puntos" value="0" class="form-control">
                      </div>
                       <div class="col-md-2 mid">
                        <label>Calificacion</label>
                        <div class="rating"><!--
                        --><input name="stars" id="e5" class="star" value="5" type="radio"></a><label class="star" for="e5">☆</label><!--
                        --><input name="stars" id="e4" class="star" value="4" type="radio"></a><label class="star" for="e4">☆</label><!--
                        --><input name="stars" id="e3" class="star" value="3" type="radio"></a><label class="star" for="e3">☆</label><!--
                        --><input name="stars" id="e2" class="star" value="2" type="radio"></a><label class="star" for="e2">☆</label><!--
                        --><input name="stars" id="e1" class="star" value="1" type="radio"></a><label class="star" for="e1">☆</label>
                        </div>
                      </div>
                      <div class="col-md-3 mid">
                        <button id="recolectarParadero" class="btn btn-success"><i class="fa fa-plus-circle"></i> Procesar Recoleccion</button>
                        <button id="finalizarRecoleccion" style="display:none;" class="btn btn-warning"><i class="fa fa-check-square-o" style="color:green;"></i> Finalizar Recoleccion</button>
                      </div>
                    </div>
                </div>
              </form>
            
            <div class="col-md-12" style="margin:3px 0px 10px 0px">
            </div>
                <table id="rutas" class="display hover responsive cell-border">
                                <thead>
                                    <tr>
                                        <th>B-A</th>
                                        <th>B-B</th>
                                        <th>P-A</th>
                                        <th>P-B</th>
                                        <th>Calificacion</th>
                                        <th>Puntos</th>
                                        <th>Ubicación - Paradero</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                            
                                </tbody>
                        </table>
                    <?php ?>
                </div>
            <!-- /.box-body -->
            </div>
        </section>
	<!-- /.content -->
    <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <div class="control-sidebar-bg"></div>
</div>

<script src="<?php echo base_url('resources/');?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('resources/');?>bower_components/jquery-ui/jquery_migrate.js"></script>
<script src="<?php echo base_url('resources/');?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>
<script src="<?= base_url('resources/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('resources/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
        $(document).ready(function(){
            var es = {"decimal":"","emptyTable":"No hay datos disponibles...","info":"Mostrando _START_ a _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 a 0 de 0 entradas","infoFiltered":"(filtrado de _MAX_ total de entradas)","infoPostFix":"","thousands":",","lengthMenu":"Mostrar _MENU_ entradas","loadingRecords": "Cargando...","processing":"Procesando datos...","search":"Busqueda:","zeroRecords":"No se encontraron coincidencias.","paginate": {"first": "Primer","last":"Ultimo","next":"Próximo","previous":"Anterior"}};
            var datat = $('#rutas').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "<?=site_url('ajax_request/pagRecoleccionLive/'.$idRecoleccion)?>",
                "language": es
                });
            cargarParaderos('<?php echo $idRecoleccion;?>');
            setTimeout( function () { datat.ajax.reload( null, false ); },30000);
            var brecolectar = document.getElementById('recolectarParadero');
            var finRec = document.getElementById('finalizarRecoleccion');
            brecolectar.addEventListener('click', function(e){recolectar(e);});
            finRec.addEventListener('click', function(e){finalizarRecoleccion(e);});
            function finalizarRecoleccion(e){
              e.preventDefault();
              c = confirm('¿Desea finalizar la recoleccion?');
              if(c){
                $.ajax({
                 type: "POST",
                 url: "<?=site_url('ajax_request/finalizarRecoleccion/'.$idRecoleccion)?>",
                 data: {},
                 success: function(data){
                  r = JSON.parse(data);
                  if(r.c>0){
                   alert('Recoleccion finalizada correctamente!');
                   window.location.href= r.url;
                  }else{
                   alert(r.m);
                  }
                 }
               });
              }
            }
            
            function recolectar(e){
                  e.preventDefault();
                  var b1,b2,p1,p2,cal,pun,rid,uid,bandera=0;
                  /* asignar valores a cada variable */
                  b1 = $("#bolsaa").val();b2 = $("#bolsab").val();cal = $("#calificacion").val();rid = $("#recolector").val();
                  p1 = $("#pesoa").val();p2 = $("#pesob").val();pun = $("#puntos").val();uid = $("#paraderos").val();
                  /* validar datos */
                  if(b1<0){ alert('Valor incorrecto para bolsa A');return;}
                  if(b2<0){ alert('Valor incorrecto para bolsa B');return;}
                  if(p1<0){ alert('Valor incorrecto para peso A');return;}
                  if(p2<0){ alert('Valor incorrecto para peso B');return;}
                  if(pun<0){ alert('Valor incorrecto para peso B');return;}
                  if(uid=='' || uid<=0){ alert('Por favor seleccione el paradero de la recoleccion.');return;}
                  var radioValue = $("input[name='stars']:checked");
                  if(radioValue.length<1){alert('Por favor seleccione Calificacion');return;}
                  if(b1==0 || b2==0 || p1==0 || p2==0 || pun==0){ bandera = 1;}
                  if(bandera==1){
                    c = confirm('Existen valores en 0 desear continuar?');
                  }else{
                    c = true;
                  }
                  if(c){
                    var form = $("#recoleccion_data");
                    $.ajax({
                      type: "POST",
                      url: "<?=site_url('ajax_request/guardarRecoleccion/'.$idRecoleccion)?>",
                      data: form.serialize(),
                      success: function(data){
                       r = JSON.parse(data);
                       if(r.c>0){
                        datat.ajax.reload( null, false );
                        form.reset();
                        cargarParaderos('<?php echo $idRecoleccion;?>');
                       }else{
                        alert(r.m);
                       }
                      }
                    });
                   }
                }
        });
    </script>
</body>
</html>