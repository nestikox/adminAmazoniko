<style type="text/css">
        #right-panel {font-family: 'Roboto', 'sans-serif';line-height: 30px;padding-left: 10px;
            width: 50%;height: 300px;float: right;}
        #right-panel {overflow: auto;}
        #map {float: left;width: 50%;height: 300px;}
        .adp-directions {width: 100%;}
        .adp-summary {background-color: #669a35;color: #fff;}
        .adp-legal {opacity: 0;}
        .adp-marker2 {opacity: 0;}
        @media (min-width: 280px) and (max-width: 1204px) {
            body {background-color: black;}
            #right-panel {width: 100%;float: none;clear: both;}
            #map {width: 100%;float: none;clear: both;}
        }
        .zonas {background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            background: -webkit-linear-gradient(to right, #232526, #414345);background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            border-radius: 20px;border: 1px dashed rgba(255, 255, 255, 0.5);
        }
    </style>

    <div class="content-wrapper col-white">
        <input id="site_url" class="hide" value="<?= site_url() ?>">
        <input id="base_url" class="hide" value="<?= base_url() ?>">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear y asignar rutas</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">

                            <?php
                            foreach ($zonas_dias as $zona){
                                ?>

                                <div class="col-md-5 zonas col-white" style="margin-left:5px;margin-bottom: 8px;">
                                    <p>Nombre zona:
                                        <?= $zona['nombre'] ?>
                                    </p>
                                    <p>Desripción zona:
                                        <?= $zona['delimitacion'] ?>
                                    </p>
                                    <p>Código zona:
                                        <?= $zona['id_zona'] ?>
                                    </p>
                                    <p>Dia de ruta:
                                        <?= $zona['dia'] ?>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table  table-bordered col-white" cellspacing="0">

                                            <?php
                                            if(count($conteo_recoleccion) == 0 ){
                                                $conteo_recoleccion = array(
                                                    'id_zona' => 0,
                                                    'id_dia' => 0
                                                );
                                            }elseif(count($kit) == 0 ){
                                                $kit = array(
                                                    'id_zona' => 0,
                                                    'id_dia' => 0
                                                );
                                            }

                                            ?>

                                            <thead>
                                            <tr>
                                                <th>Cantidad de kits</th>
                                                <th>Cantidad de recolecciones</th>
                                                <th>Productos a entregar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $cantidad = 0;
                                            foreach ($conteo_recoleccion as $recoleccion) {
                                                foreach ($kit as $usuario_kit) {
                                                    foreach ($amazonikos as $amazoniko) {
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            /*Validar si hay kits*/
                                                            if (isset($kit) && count($kit) >= 1) {

                                                                if ($zona['id_zona'] ==  $usuario_kit['id_zona'] &&  $usuario_kit['dia_kit']  == $zona['id_dia']   ) {
                                                                    $cantidad++;
                                                                    if($usuario_kit['id_usuario'] ==  $amazoniko['id'] ){
                                                                        if($cantidad == 1 && $usuario_kit['id_usuario'] ==  $amazoniko['id']){
                                                                            //break;
                                                                        }else{
                                                                            //continue;
                                                                        }
                                                                        ?>
                                                                        <td>
                                                                            <ul class="list-group col-black">
                                                                                <li class="list-group-item">
                                                                                    Nombre:
                                                                                    <br>
                                                                                    <?= $amazoniko['nombre']; ?>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                        <?php
                                                                        if($conteo_recoleccion[0]['id_zona'] == 0 && isset($conteo_recoleccion)){
                                                                            ?>
                                                                            <td>0</td>
                                                                        <?php  }
                                                                    } } ?>
                                                            <?php   } ?>

                                                            <?php if(count($kit) == 0 && count($conteo_recoleccion) == 0){ ?>
                                                                <td>0</td>
                                                                <td>0</td>
                                                            <?php  } ?>

                                                            <?php
                                                            $contador_recoleccion = 0;
                                                            if ( $recoleccion['id_usuario'] ==  $amazoniko['id'] && $zona['id_zona'] ==  $amazoniko['id_zona'] &&  $recoleccion['id_dia']  == $zona['id_dia']  &&    $contador_recoleccion == 1) {
                                                                $contador_recoleccion++;
                                                                ?>
                                                                <td>
                                                                    <ul class="list-group col-black">
                                                                        <li class="list-group-item">
                                                                            Nombre:
                                                                            <br>
                                                                            <?= $amazoniko['nombre']; ?>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            <?php }   ?>

                                                            <?php

                                                            foreach($productos_solic as $producto){
                                                                if($recoleccion['id_usuario'] == $producto['id_usuario'] && $recoleccion['id_zona'] == $zona['id_zona'] &&  $recoleccion['id_dia'] == $zona['id_dia']){ ?>
                                                                    <?php
                                                                    $cantidad++;
                                                                    if( $cantidad == count($productos_solic)){ ?>
                                                                        <?php if(count($conteo_recoleccion) <= 1){ ?>
                                                                            <td></td>
                                                                            <td></td>
                                                                        <?php } ?>
                                                                        <td>
                                                                            <ul class="list-group col-black">
                                                                                <li class="list-group-item">
                                                                                    <label>Producto: </label> <?= $producto['nombre'] ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <label>Usuario: </label>   <?= $amazoniko['nombre'] ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <label>Dirección: </label>   <?= $amazoniko['direccion'] ?>
                                                                                    <br>
                                                                                    <label>Nombre edificio: </label>   <?= $amazoniko['nombre_edificio'] ?>
                                                                                    <br>
                                                                                    <label>Apto: </label>   <?= $amazoniko['apto'] ?>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                    <?php      } ?>

                                                                    <?php
                                                                }
                                                            }

                                                            ?>

                                                        </tr>
                                                    <?php } } } ?>
                                            </tbody>



                                        </table>
                                    </div>



                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Amazóniko
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2018 .</strong> Desarrollado con
        <i style="color:#E53935;" class="fa fa-heart" aria-hidden="true"></i> por
        <a href="http://www.ideco.com.co" target="_blank">www.ideco.com.co</a>.
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
<script src="<?=base_url()?>public/dist/js/scripts/rutas.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=geometry,places&language=es">
</script>
<script async defer src="https://www.amazoniko.com/public/plugins/overlappingmarkerspiderfier/oms.min.js?spiderfier_callback=mapLibReadyHandler"></script>
<script src="<?= base_url('public/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
</script>
<script>
    $('.sidebar-toggle').click(function () {
        $('.ico').toggle('show');
    });
</script>
</body>
</html>