<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url('images/img/tucan.png');?>" width="30px" style="object-fit: contain;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="opacity:0.5;"><b>Amazoniko</b>Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <?php $imagenPeril = base_url('images/profiles/'.$this->session->userdata('imagen'));?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
      <!--<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
             <li class="header">You have 10 notifications</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>-->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $imagenPeril; ?>" onerror="this.src='<?php echo base_url('images/img/avatar/1.png');?>'"  class="img-circle" width="20px" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('username'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $imagenPeril; ?>" onerror="this.src='<?php echo base_url('images/img/avatar/1.png');?>'" width="30px" class="img-circle" alt="User Image">
                <p><?php echo $this->session->userdata('username'); ?>
                  <!--<small>Member since Nov. 2012</small>-->
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url('usuarios/perfilUsuario')?>" class="btn btn-default btn-flat">Actualizar Datos</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('inicio/logout')?>" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button  <li> <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $imagenPeril; ?>" onerror="this.src='<?php echo base_url('images/img/avatar/1.png');?>'"  class="img-circle" width="30px" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
				<li class="<?php echo isset($op_dashboard)?$op_dashboard:'';?>">
          <a href="<?php echo site_url('sistema');?>">
            <i class="fa fa-dashboard"></i> <span>Tablero Principal</span>
          </a>
        </li>
        
        <?php /*  GRUPO MIEMBROS  */
        $group = 'members'; if($this->ion_auth->in_group($group)): /*OPCIONES DE RECOLECTORES*/?>
          <li class="<?php echo isset($op_tips)?$op_tips:'';?>">
          <a href="<?php echo site_url('tips');?>">
            <i class="fa fa-user"></i> <span>&iquest; Como Reciclar ?</span>
          </a>
        </li>
        <li class="<?php echo isset($op_maloka)?$op_maloka:'';?>">
          <a href="<?php echo site_url('sistema/maloka');?>">
            <i class="fa fa-paper-plane"></i> <span>Maloka</span>
          </a>
        </li>
        <li class="<?php echo isset($op_redimibles)?$op_redimibles:'';?>">
          <a href="http://190.146.247.240/amazoniko/site/shop/">
            <i class="fa fa-shopping-cart"></i> <span> Redimibles</span>
          </a>
        </li>
        <li class="<?php echo isset($prog_sel)?$prog_sel:'';?>">
          <a href="<?=site_url('programaciones')?>">
            <i class="fa fa-clock-o"></i> <span> Programar Recolección</span>
          </a>
        </li>
        <!--
        <li class="treeview <?php echo (isset($prog_sel)?$prog_sel:'');?>">
					<a href="#">
						<i class="fa fa-clock-o " aria-hidden="true"></i> <span>Recolecciones</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
            <li><a href=""><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Recoleccion</a></li>
					</ul>
        </li>
        -->
				<li class="<?php echo isset($op_historialUsuario)?$op_historialUsuario:'';?>">
          <a href="<?php echo site_url('sistema/historialUsuario');?>">
            <i class="fa fa-book"></i> <span>Historial</span>
          </a>
        </li>
        <?php endif;?>
        <?php  $group = 'recolectores'; if($this->ion_auth->in_group($group)): /*OPCIONES DE RECOLECTORES*/?>
        <li class="treeview <?php echo (isset($rutas_main)?$rutas_main:'');?>">
					<a href="#">
						<i class="fa fa-map" aria-hidden="true"></i> <span>Rutas</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="<?=site_url('rutaUsuarios/')?>"><i class="fa fa-map-o" aria-hidden="true"></i> Ver mis Rutas</a></li>
						<li><a href="<?=site_url('rutaUsuarios/misZonas')?>"><i class="fa fa-map-o" aria-hidden="true"></i> Ver Mis zonas</a></li>
					</ul>
        </li>
				<li class="<?php echo isset($op_historialUsuario)?$op_historialUsuario:'';?>">
          <a href="<?php echo site_url('sistema/historialUsuario');?>">
            <i class="fa fa-book"></i> <span>Historial</span>
          </a>
        </li>
        <li class="<?php echo isset($prog_sel)?$prog_sel:'';?>">
          <a href="<?=site_url('programaciones/recolectores')?>">
            <i class="fa fa-clock-o"></i> <span>Recolecciones</span>
          </a>
        </li>
        <?php endif;?>
        <?php  $group = 'admin'; if($this->ion_auth->in_group($group)): /*OPCIONES DE ADMINISTRADORES*/?>
        <li class="<?php echo isset($op_usuarios)?$op_usuarios:'';?>">
          <a href="<?php echo site_url('usuarios')?>">
            <i class="fa fa-user "></i> <span>Usuarios</span>
            <!--<span class="pull-right-container"> <small class="label pull-right bg-green">new</small> </span>-->
          </a>
        </li>
				<li class="treeview <?php echo (isset($rutas_main)?$rutas_main:'');?>">
					<a href="#">
						<i class="fa fa-map" aria-hidden="true"></i> <span>Rutas</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
            <li><a href="<?=site_url('usuarios/rutas')?>"><i class="fa fa-cogs" aria-hidden="true"></i> Usuario -> Rutas</a></li>
						<li><a href="<?=site_url('rutas')?>"><i class="fa fa-map-o" aria-hidden="true"></i> Listado de Rutas</a></li>
						<li><a href="<?=site_url('rutas/zonasAdm')?>"><i class="fa fa-map-o" aria-hidden="true"></i> Listado de Zonas</a></li>
					</ul>
        </li>
        <li class="treeview <?php echo (isset($prog_sel)?$prog_sel:'');?>">
					<a href="#">
						<i class="fa fa-clock-o " aria-hidden="true"></i> <span>Programaciones</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
            <li><a href="<?=site_url('programaciones/listarFechas')?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Listar Fechas</a></li>
            <li><a href="<?=site_url('programaciones/listarRecolecciones')?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Listar Recolecciones</a></li>
					</ul>
        </li>
        <!--<li class="treeview <?php echo (isset($op_conf)?$op_conf:'');?>">
					<a href="#">
						<i class="fa fa-cogs" aria-hidden="true"></i> <span>Configuraciones</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
            <li><a href="<?=site_url('sistema/unidades')?>"><i class="fa fa-cog" aria-hidden="true"></i> Unidades - Recoleccion</a></li>
					</ul>
        </li>-->
        <?php endif;?>
        <li><a href="<?php echo site_url('inicio/logout')?>"><i class="fa fa-circle-o text-red"></i> <span>Cerrar Sesión</span></a></li>
        <!--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
      </ul>
    </section>
   
  </aside>

	   <?php /*
			  *  <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
	  
	   <!-- /.sidebar <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
	 <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>-->
			<li class="dropdown tasks-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <i class="fa fa-flag-o"></i>
				  <span class="label label-danger">9</span>
				</a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
			 *
			 *<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
			 *
			 *<li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
			 *
			 * <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>*/ ?>