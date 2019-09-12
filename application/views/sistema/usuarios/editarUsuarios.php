<?php echo $head;?>
<body class="hold-transition skin-green sidebar-mini">
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
            <form role="form" enctype="multipart/form-data" method="POST" action="<?php echo site_url('usuarios/eUsuario');?>">
              <div class="box-body">
                <div class="col-md-4 form-group">
                  <label>Nombres</label>
									<input type="hidden" name="userid" value="<?php echo $usuario->id;?>">
                  <input type="text" class="form-control" placeholder="Nombres" value="<?php echo $usuario->first_name;?>" name="nombre" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" placeholder="Apellidos" name="apellido" value="<?php echo $usuario->last_name;?>" required>
                </div>
								<div class="col-md-4 form-group">
                  <label>Identificación</label>
                  <input type="text" class="form-control" placeholder="Identificación" value="<?php echo $usuario->rut;?>" name="ndoc"  required readonly>
                </div>
				<div class="col-md-4 form-group">
                <label>Perfil</label>
						<select class="form-control select2" style="width: 100%;" name="tipousuario"  <?php if(!$this->ion_auth->is_admin()){ echo "disabled";}?>>
						<option value="">Seleccione</option>
						<?php foreach($grupos as $k => $v):?>
					  <option value="<?php echo $v->id;?>" <?php if($usuario->group_id ==$v->id){echo "selected";}?>><?php echo $v->name;?></option> 
						<?php endforeach;?>
					</select>
				</div>
                <div class="col-md-4 form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $usuario->email ?>" name="correo" <?php if(!$this->ion_auth->is_admin()){ echo "disabled";}?>>
                </div>
                <div class="col-md-4 form-group">
                  <label>Celular</label>
                  <input type="text" class="form-control" id="exampleInputadress" placeholder="Celular" value="<?php echo $usuario->phone;?>" name="celular">
                </div>
				<div class="col-md-4 form-group">
				<label for="exampleInputPassword1">Contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="clave">
				</div>
				<div class="col-md-4 form-group">
				<label for="exampleInputPassword1">Confirmar Contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
				</div>
						<?php if($this->ion_auth->is_admin()){ ?>
              <div class="col-md-4 form-group">
                <label>Estado</label><br>
								<div class="col-md-6 form-group">Activo  <input type="radio" name="activo" value="1" class="flat-red" <?php if($usuario->active ==1){echo "checked";}?>>
                </div>
                <div class="col-md-6 form-group">Inactivo  <input type="radio" name="activo" value="0" class="flat-red" <?php if($usuario->active ==0){echo "checked";}?>>
                <input type="hidden" name="estado_actual" value="<?php echo $usuario->active;?>">
                </div>
              </div>
							<?php }?>
							<style>
								.perfilimg{width:40%;min-height:100px; object-fit:contain;margin:2px 25%;  background-color:lightgrey; }
								.bar { height: 18px;background: green; }
							</style>
							<div class="col-md-4" >
								 <label>Imagen de perfil </label><br>  
								<?php if(isset($usuario->imagen) and strlen($usuario->imagen)>3):?>
									<img src="<?php echo base_url('images/profiles/'.$usuario->imagen);?>" class="perfilimg">
								<?php else:?>
									<img src="<?php echo base_url('images/img/avatar/1.png');?>"  class="perfilimg">
								<?php endif;?>
							</div>
							<div class="col-md-4" style="padding-top: 50px;">
								<input id="fileupload" type="file" name="userfile" data-url="<?php echo site_url('usuarios/uploadPerfil');?>">
								<div id="progress">
									<div class="bar" style="width: 0%;"></div>
								</div>
							</div>
              <div class="col-md-4 form-group" style="padding-top: 50px;">
                <label>Puntos</label>
                  <input type="text" class="form-control" value="<?php echo number_format(intval($usuario->puntos),0,',','.');?>" readonly>
							</div>
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
								<a class="pull-right btn btn-warning volver"  href="<?php echo site_url('usuarios');?>">Volver</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-head">
              <h5 style="margin-left: 5px;"><b>Historial</b></h5>
            </div>
              <div class="box-body">
                <table class="table" id="historial">
                  <thead><tr><th>Bolsas A</th><th>Bolsas B</th><th>Peso A</th><th>Peso B</th><th>Calificación</th><th>Puntos</th><th>Fecha</th></tr></thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
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
<script src="<?= base_url('resources/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('resources/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
        $(document).ready(function(){
            var es = {"decimal":"","emptyTable":"No hay datos disponibles...","info":"Mostrando _START_ a _END_ de _TOTAL_ entradas","infoEmpty":"Mostrando 0 a 0 de 0 entradas","infoFiltered":"(filtrado de _MAX_ total de entradas)","infoPostFix":"","thousands":",","lengthMenu":"Mostrar _MENU_ entradas","loadingRecords": "Cargando...","processing":"Procesando datos...","search":"Busqueda:","zeroRecords":"No se encontraron coincidencias.","paginate": {"first": "Primer","last":"Ultimo","next":"Próximo","previous":"Anterior"}};
            $('#historial').DataTable( {
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "<?=site_url('ajax_request/getHistorial/'.$uid)?>",
                "language": es
                });
            });
    </script>
</body>
</html>
