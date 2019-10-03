<?php echo $head;?>
<style>
	.login-page{
		background-image: url('<?php echo base_url('images/img/background2.jpg');?>');
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		height: 100vh;
		position: absolute;
		top: 0px;
		z-index: -1;
		width: 103vw;
		height: 103vh;
		margin: -2vh;
}
	
	/**/
</style>
<body class="hold-transition" style="height: 100vh, width:100vw; overflow: hidden;">
	<div class="login-page"></div>
<div class="login-box">
  <!--<div class="login-logo">
    <a href="<?php echo site_url('inicio')?>" style="text-shadow: 2px 4px 2px #000000;color:white;;"><b>Amazoniko</b>Admin</a>
  </div>-->
  <!-- /.login-logo -->
  <div class="login-box-body" style="border-radius: 5px;box-shadow: 0px 3px 15px black;background-color: rgba(255,255,255,0.5)!important">
    <p class="login-box-msg" style="color:black;"><?php if(isset($message)){echo $message;}else{echo "Introduce tus datos para ingresar al sistema";}?></p>

    <form action="<?php echo site_url('inicio/ingresoUsuario');?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="email@user.com" name="user">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="**********" name="pwr">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
				<div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Recordar
            </label>
          </div>
        </div>
				<div class="col-xs-8">
					<a href="#" class="pull-right" style="color:rgb(26,37,115);">Olvidé mi clave</a><br>
					<a href="<?php echo site_url('inicio/registro');?>" class="pull-right" style="color:rgb(26,37,115);">Registrarse</a>
        </div>
        <!-- /.col -->
      </div>
    </form>
<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->

    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('resources');?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources');?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('resources');?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
