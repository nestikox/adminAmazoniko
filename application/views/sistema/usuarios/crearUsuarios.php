<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?php echo $header;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
					<h1>
						Crear Usuario
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
						<li><a href="#"> Usuarios </a></li>
						<li class="active">Crear Usuario</li>
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
            <form role="form" enctype="multipart/form-data" method="POST" action="<?php echo site_url('usuarios/cUsuario');?>">
              <div class="box-body">
                <div class="col-md-4 form-group">
                  <label>Nombres</label>
                  <input type="text" class="form-control" placeholder="Nombres" name="nombre" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" placeholder="Apellidos" name="apellido" required>
                </div>
				<div class="col-md-4 form-group">
                <label>Perfil</label>
					<select class="form-control select2" style="width: 100%;" name="tipousuario" required>
						<option value="">Seleccione</option>
						<?php foreach($grupos as $k => $v):?>
					  <option value="<?php echo $v->id;?>"><?php echo $v->name;?></option> 
						<?php endforeach;?>
					</select>
				</div>
                <div class="col-md-4 form-group">
                  <label>RUT</label>
                  <input type="text" class="form-control" id="rut" placeholder="No. de documento" name="ndoc" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="correo">
                </div>
                <div class="col-md-4 form-group">
                  <label>Celular</label>
                  <input type="text" class="form-control" id="exampleInputadress" placeholder="Celular" name="celular">
                </div>
				<div class="col-md-4 form-group">
				<label for="exampleInputPassword1">Contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="clave">
				</div>
				<div class="col-md-4 form-group">
				<label for="exampleInputPassword1">Confirmar Contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
				</div>
              <div class="col-md-4 form-group">
                <label>Estado</label><br>
									<div class="col-md-6 form-group">Activo  <input type="radio" name="activo" value="true" class="flat-red" checked>
									</div>
									<div class="col-md-6 form-group">Inactivo  <input type="radio" name="activo" value="false" class="flat-red">
									</div>
								</div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
          <script>
            $(document).ready(function(){
                $("#rut").change(function(){
                  var rut = $(this).val();
                  target="<?=site_url('usuarios/ajax_comprobarRut')?>";
                  if(rut.length>2){
                    $.ajax({
                      url:target,
                      type: 'POST',
                      data: {'rut':rut}, 
                      beforeSend: function(){$("#loader").fadeIn();},
                      complete: function(){$("#loader").fadeOut();},
                      success: function (data){
                        r = JSON.parse(data);
                        if(r.response==0){
                          return true;
                        }else{
                          alert('Usuario rut:'+rut+' ya existe'); $("#rut").val(''); 
                        }
                      }
                    });/*fin ajax*/
                  }/* fin LENGTH > 2*/
            });/*fin rut change*/
          });/* fin document ready*/
          </script>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
     </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper 
  <footer class="main-footer"><div class="pull-right hidden-xs"><b>Version</b> 1.0</div><strong>Copyright &copy; Amazoniko 2019 </strong> All rights reserved.</footer>
-->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('resources/');?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/');?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('resources/');?>dist/js/demo.js"></script>
</body>
</html>
