<?php
/**
 * Created by PhpStorm.
 * User:  Angel Leon
 * Date: 20/11/17
 * Time: 03:20 PM
 * Author: ideco.com.co
 */
$apodo      = $this->session->userdata('apodo');
$nombre     = $this->session->userdata('nombre');
$id_rol     = $this->session->userdata('id_rol');
$id_usuario = $this->session->userdata('id_usuario');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amazóniko</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?=base_url()?>public/plugins/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>public/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url()?>public/plugins/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>public/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter page. However, you can choose any other skin. Make sure you apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="<?=base_url()?>public/dist/css/skins/skin-green-light.min.css">
    <!-- Style Amazoniko-->
    <link rel="stylesheet" href="<?=base_url('public/css/style-amazoniko.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/plugins/datatables/dataTables.bootstrap.css')?>">
    <style type="text/css">
        #right-panel {
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
            width: 50%;height: 300px;
            float: right;
        }
        #right-panel {
            overflow: auto;
        }
        #map{
            float: left;
            width: 50%;height: 300px;
        }

        .adp-directions{
            width: 100%;
        }
        .adp-summary{
            background-color:#669a35;
            color: #fff;
        }
        .adp-legal{
            opacity: 0;
        }

        .adp-marker2{
            opacity: 0;
        }

        @media (min-width: 280px) and (max-width: 1204px){
            body{
                background-color: black;
            }
            #right-panel{
                width: 100%;
                float: none;
                clear:both;
            }
            #map{
                width: 100%;
                float: none;
                clear:both;
            }
        }

    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- ico -->
    <link rel="shortcut icon" href="<?=base_url('public/img/tucan.png')?>">

    <!-- Google Font -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119191261-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-119191261-1');
    </script>

</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="<?=site_url('Administrador')?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img class="img-fluid" src="<?=base_url('public/img/tucan.png');?>" width="40px" height="40px"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
          <div class="login-logo-lg">

          </div>
        </span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Cambiar navegación</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <?php if ($id_rol == 4) {?>
                        <a href="#" >
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span> <i class="fa fa-circle" aria-hidden="true" style="color: #FFD949;"></i> <?=($coins['puntos'] == '') ? 0 : $coins['puntos']?></span>
                        </a>
                    </li>
                    <?php }
                    ?>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="<?=base_url('public/img/avatar/' . $id_rol . '.png')?>" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?=$apodo?></span>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="<?=base_url('public/img/avatar/' . $id_rol . '.png')?>" class="img-fluid" alt="User Image" style="">
                                <p>
                                    <?=$apodo?>
                                    <br>
                                    <small>
                                        <?php
                                        if ($nombre != null) {?>
                                            <?=$nombre?>
                                        <?php }?>
                                    </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?=site_url('Usuario/perfil/') . $id_usuario?>" class="btn btn-default btn-flat col-blue ">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?=site_url('Login/cerrar_sesion')?>" class="btn btn-default btn-flat col-blue ">Cerrar sesión</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <!-- /.search form -->
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Menú</li>
                <!-- Optionally, you can add icons to the links -->
                <?php switch ($id_rol) {
                    case 1: ?>
                        <li><a href="<?=site_url('Super_administrador')?>"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>Indicadores</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/productos')?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span>Productos</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/aliados')?>"><i class="fa fa-users" aria-hidden="true"></i><span>Aliados</span></a></li>
                        <li><a href="<?=site_url('Administrador')?>"><i class="fa fa-map" aria-hidden="true"></i><span>Rutas</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/amazonikos')?>"><i class="fa fa-users" aria-hidden="true"></i><span>Usuarios</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/sistema')?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Sistema</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/banner')?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Banners</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/historial_recolecciones')?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Historial recolecciones</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/historial_productos')?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Historial productos</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/notificacion')?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Crear Notificación</span></a></li>
                        <li><a href="<?=site_url('Super_administrador/categorias')?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Categorías</span></a></li>
                        <?php
                        break;
                    case 4: ?>
                        <li><a href="<?=site_url('Administrador')?>"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>Indicadores</span></a></li>
                        <li><a href="<?=site_url('Usuario/programar_recoleccion')?>"><i class="fa fa-recycle" aria-hidden="true"></i><span>Programar Recolección</span></a></li>
                        <li><a href="<?=site_url('Usuario/video_reciclaje')?>"><i class="fa fa-play" aria-hidden="true"></i><span>¿Comó reciclar?</span></a></li>
                        <li><a href="<?=site_url('Usuario/catalogo')?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span>Redimibles</span></a></li>
                        <?php
                        break;
                    case 3:
                        ?>
                        <li><a href="<?=site_url('Recolector/solicitudes_kit')?>"><i class="fa fa-check-circle ico"></i><span class="label  f-y label-primary"><?=$cont_kit['cantidad_kit'];?></span> <span>Solicitudes de kit</span></a></li>
                        <li><a href="<?=site_url('Recolector/solicitudes_rec')?>"><i class="fa fa-check-circle ico"></i><span class="label  f-y label-primary"><?=$cont_rec['id'];?></span> <span>Solicitudes de recolección</span></a></li>
                        <?php
                        break;
                }?>

            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
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
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <form id="crear_ruta" action="<?=site_url('Administrador/crearRuta')?>" method="post">
                            <div class="form-group  col-md-6">
                                <label class="col-white">Selecciona la zona de recolección</label>
                                <select id="zonas" name="zona" class="form-control">
                                    <?php $czona=0;
                                    foreach ($zonas as $zona) {
                                        $czona++;
                                        if($czona == 1){ ?>
                                            <option value="<?=$zona['id']?>" selected><?=$zona['delimitacion']?></option>
                                        <?php	}else{ ?>
                                            <option value="<?=$zona['id']?>"><?=$zona['delimitacion']?></option>
                                        <?php } }?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-white">Selecciona el dia de recolección</label>
                                <select id="dias" name="dia" class="form-control"  required>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="control-label col-white">Escribe dirección inicial</label>
                                <div class="input-group">
                                    <input type="text" id="direccionInicial"  oninput="this.setCustomValidity('');" oninvalid="this.setCustomValidity('Dirección incorrecta');" class="form-control" placeholder="Dirección" required>
                                    <input id="latdirinicial" type="hidden" value="">
                                    <input id="lngdirinicial" type="hidden" value="">
                                    <!--
                                    <select id="dI" name="dia" class="form-control direcciones"  required>
                                    </select> -->
                                    <div class="input-group-btn">
                                        <button id="addDi" type="button" class="btn bg-blue r-ml">
                                            <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group col-md-4">
                                <label class="control-label col-white">Selecciona direcciónes de parada</label>
                                <div class="input-group">
                                    <select id="dP" name="dia" class="form-control direcciones"  required>
                                    </select>
                                    <div class="input-group-btn">
                                        <button id="addDp" type="button" class="btn bg-blue r-ml">
                                            <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="control-label col-white">Selecciona dirección final</label>
                                <div class="input-group">
                                    <input type="text" id="direccionFin"  oninput="this.setCustomValidity('');" oninvalid="this.setCustomValidity('Dirección incorrecta');" class="form-control" placeholder="Dirección" required>
                                    <input id="latdirfin" type="hidden" value="">
                                    <input id="lngdirfin" type="hidden" value="">
                                    <!--
                                    <select  id="dF" name="dia" class="form-control direcciones"  required>
                                    </select> -->
                                    <div class="input-group-btn">
                                        <button  id="addDf" type="button" class="btn bg-blue r-ml">
                                            <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <table class="tabla table  table-bordered col-white" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Dirección inicial</th>
                                    <th>Direcciónes de parada</th>
                                    <th>Dirección final</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="dirI">

                                    </td>
                                    <td>
                                        <ul id="dirP">

                                        </ul>
                                    </td>
                                    <td class="dirF">

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- /.box -->
                            <div class="form-group col-md-12">
                                <button id="trazarRuta" type="button" class="btn bg-blue">Trazar ruta</button>
                            </div>
                            <div class="col-md-12">
                                <div id="directions-panel"></div>
                            </div>

                            <div class="col-md-12">
                                <div id="map" style="color:#000"></div>
                                <div id="right-panel"></div>
                            </div>
                            <div class="col-md-12">
                                <h1 class="col-white">Asignar ruta</h1>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-white">Selecciona recolector</label>
                                <select id="recolector" name="recolector" class="form-control" required="">
                                    <?php  foreach ($recolectores as $recolector) { ?>
                                        <option value="<?=$recolector['id']?>"><?=$recolector['nombre']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success pull-right">Asignar ruta</button>
                            </div>
                        </form>
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
<script src="<?=base_url()?>public/dist/js/scripts/rutas.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=geometry,places&language=es">
</script>
<script async defer src="https://www.amazoniko.com/public/plugins/overlappingmarkerspiderfier/oms.min.js?spiderfier_callback=mapLibReadyHandler"></script>
<script src="<?= base_url('public/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
    $('.tabla').DataTable({
        scrollX: true,
        "language": {
            "sEmptyTable": "No existen datos",
            "sInfo": "_START_ a _END_ von _TOTAL_ registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "search": "Buscar:",
            "infoEmpty": "No existen datos.",
            "sInfo": "Mostrando _START_ al _END_ de _TOTAL_ registros",
            "sZeroRecords": "No hay información disponible",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

</script>

<script>
    $('.sidebar-toggle').click(function(){
        $('.ico').toggle('show');
    });


</script>



</body>
</html>

