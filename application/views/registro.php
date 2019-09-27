<?php echo $head;?>
<style>
	.login-page{
		background-image: url('<?php echo base_url('images/img/background2.jpg');?>');
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
<body class="hold-transition login-page">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body" style="border-radius: 5px;box-shadow: 0px 3px 15px black;background-color: rgba(255,255,255,0.5)!important">
    <!--<p class="login-box-msg"><?php if(isset($message)){echo $message;}else{echo "Llena este formulario para procesar tu registro.";}?></p>-->

    <form action="<?php echo site_url('inicio/registrarUsuario?i=1');?>" method="post" id="registroForm">
        <div class="form-group has-feedback">
            <input type="email" class="form-control" id="email" name="correo" aria-describedby="correohelp" placeholder="Email" required>
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <small id="correohelp" class="form-text text-muted"></small>
        </div>
        <!--<div class="form-group has-feedback">
            <input type="email" class="form-control" id="emailc" onpaste="return false;" autocomplete="off" name="correoc" aria-describedby="correohelpc" placeholder="Confirma tu email" required>
				 <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <small id="correohelpc" class="form-text text-muted">Nunca compartiremos tu direccion de correo con nadie.</small>
        </div>-->
        <div class="form-group has-feedback">
            <input type="text" class="form-control" id="nombre" name="username" aria-describedby="usernamehelp" placeholder="Nombre" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
            <small id="usernamehelp" class="form-text text-muted"></small>
        </div>
        <!--<div class="form-group has-feedback">
            <input type="text" class="form-control" id="dir" name="direccion" aria-describedby="direccionhelp" placeholder="Dirección" required>
				<span class="glyphicon glyphicon-home form-control-feedback"></span>
            <small id="direccionhelp" class="form-text text-muted"></small>
        </div>-->
        <div class="form-group has-feedback">
            <input type="password" class="form-control" id="clave" name="clave" aria-describedby="direccionhelp" placeholder="contraseña" required>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <small id="clavehelp" class="form-text text-muted"></small>
        </div>
				<div class="form-group">
             <div class="g-recaptcha" data-sitekey="6Ldf23oUAAAAAFiGOZE6gBPOx8CXaq7vKjq8UDqu"></div>
             <small id="captchahelp" class="form-text text-muted"></small>
        </div>
				<div class="form-group has-feedback">
            <input type="checkbox" id="terminos" name="terminos" > Acepto los <a href="<?php echo base_url('images/09-Terminos-y-Condiciones.pdf')?>"  target="_blank">términos y condiciones</a><br>
						<small id="teminoshelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <button type="submit" id="subbutton" class="btn btn-primary btn-block btn-flat" >Registrarme</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="<?php echo base_url('resources');?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources');?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU1DFhBkdGMc4OfpW90wIEQmlVnWZ6mCo&libraries=places"></script>
<script>
    $(document).ready(function(){
			var b = document.getElementById('subbutton');
        b.addEventListener("click", function(e){
             validateForm(e);
            });
        $('#togglePassword').on('ifClicked',showOrHidePassword);
        });
    
    const showOrHidePassword = () => {
        const password = document.getElementById('clave');
        if (password.type === 'password') {
          password.type = 'text';
        } else {
          password.type = 'password';
        }
    };
    
    function validateForm(e){
        e.preventDefault();
        var name = document.getElementById('nombre');
        var clave = document.getElementById('clave');
        var correo = document.getElementById('email');
				var evalido = 0;
        /*var correoc= document.getElementById('emailc');*/
				
				var h;
        
				if(correo.value.length < 2){
            h = document.getElementById('correohelp');
            $(h).addClass('incorrectval');
            $(h).html("Ingresa tu correo.");
            setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
            return 0;
        }
				if(name.value.length < 2){
            h = document.getElementById('usernamehelp');
            $(h).addClass('incorrectval');
            $(h).html("Ingrese nombre.");
            setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
            return 0;
        }
        /*if(addr.value.length < 2){
            h = document.getElementById('direccionhelp');
            $(h).addClass('incorrectval');
            $(h).html("Ingresa tu direccion.");
            setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
            return 0;
        }if(correoc.value.length < 2){
            h = document.getElementById('correohelpc');
            $(h).addClass('incorrectval');
            $(h).html("Confirma tu correo.");
            setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
            return 0;
        }
        if(correo.value != correoc.value){
            h = document.getElementById('correohelp');
            $(h).addClass('incorrectval');
            $(h).html("Los correos ingresados no coinciden.");
            setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
            return 0;
        }*/
        if(clave.value.length < 8){
            h = document.getElementById('clavehelp');
            $(h).addClass('incorrectval');
            $(h).html("clave no cumple el minimo de caracteres.");
            setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
            return 0;
        }
        var recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            event.preventDefault();
            h = document.getElementById('captchahelp');
            $(h).addClass('incorrectval');
            $(h).html("Por favor verifica el captcha.");
            setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
            return 0;
        }
				var terminos = document.getElementById("terminos");
				if(terminos.checked == false){
						h = document.getElementById('teminoshelp');
            $(h).addClass('incorrectval');
            $(h).html("Debe aceptar los terminos y condiciones.");
            setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
            return 0;
				}
				$.ajax({
					type: "POST",
					url: "<?=site_url('ajax_request/validarCorreoE')?>",
					data: {correo:correo.value},
					success: function(val) {
							r = JSON.parse(val);
							if(r.valido==1){
								$("#registroForm").submit();
							}else{
								h = document.getElementById('correohelp');
								$(h).addClass('incorrectval');
								$(h).html("Correo invalido o duplicado.");
								correo.value = '';
								setTimeout(function(){$(h).html('');$(h).removeClass('incorrectval');},5000);
								return 0;
							}
					}
				});
        
    }
var autocomplete = new google.maps.places.Autocomplete(document.getElementById('dir'));  
</script>

<style>
    .incorrectval{color:red;}
</style>
</body>
</html>
