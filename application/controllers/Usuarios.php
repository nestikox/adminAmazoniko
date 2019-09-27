<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		//$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		$this->load->model('usuariosModel');
		/* SI NO HA INICIADO SESION REDIRIGIR Y ENVIAR MENSAJE */
		if (!$this->ion_auth->logged_in()){
				$this->session->set_flashdata('message', 'Sesión Finalizada.');
				redirect('inicio', 'refresh');
			}
		/*else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}*/
	}
	
	public function index(){
		if(!$this->ion_auth->is_admin()){ redirect('sistema', 'refresh'); }/* Si no es administrador no permitir editar otros usuarios*/
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Usuarios - Amazoniko');
		/*HEADER*/
		$headerData = array('op_usuarios'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}		
		$this->load->view('sistema/usuarios/index', $head);
	}
	public function vCrearUsuario(){
		$this->load->model('rutasModel');	
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Usuarios - Amazoniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$head['grupos']=$this->usuariosModel->getGrupos();
		
		$this->load->view('sistema/usuarios/crearUsuarios', $head);
    }
    public function cUsuario(){
   
            $id = filter_input(INPUT_POST, 'ndoc');
			$email = strtolower(filter_input(INPUT_POST, 'correo'));
			$identity = $id;
			$password = filter_input(INPUT_POST, 'clave');
			$additional_data = array(
				'first_name' => filter_input(INPUT_POST, 'nombre'),
				'last_name' => filter_input(INPUT_POST, 'apellido'),
				'phone' => filter_input(INPUT_POST, 'celular'),
                'rut' =>filter_input(INPUT_POST, 'ndoc'),
				'co_empresa'=>filter_input(INPUT_POST, 'empresa')
			);
        $group = array(filter_input(INPUT_POST, 'tipousuario'));
		$id = $this->ion_auth->register($identity, $password, $email, $additional_data, $group);
		  
		if ($id!=false)
		{
			// check to see if we are creating the user // redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("usuarios", 'refresh');
		}else{
			$this->session->set_flashdata('message', 'No se pudo crear el usuario');
			redirect("usuarios", 'refresh');
		}
    }
    public function editarusuario($id){
		if (!$this->ion_auth->is_admin()){ redirect('sistema', 'refresh'); }/* Si no es administrador no permitir editar otros usuarios*/
		$this->load->model('rutasModel');
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Usuarios - Amazoniko');
		/*HEADER*/
		$headerData = array('op_usuarios'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$head['usuario']=$this->usuariosModel->getUsuariosSistema($id);
        $head['grupos']=$this->usuariosModel->getGrupos();
		$head['uid']=$head['usuario']->id;
		$this->load->view('sistema/usuarios/editarUsuarios', $head);
    }
    
	public function perfilUsuario(){
		$this->load->model('rutasModel');
		$this->load->model('programacionModel');
		$id = $this->session->userdata('user_id');
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Perfil - Amazoniko','titulo_perfil'=>'Perfil de Usuario');
		/*HEADER*/
		$headerData = array('op_perfilu'=> 'active');
		if(!$this->rutasModel->chequearParaderoExisteUsuario($id)){
				$headerData['valid']=0;
			}else{
				$headerData['valid']=1;
		}
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$head['usuario']=$this->usuariosModel->getUsuariosSistema($id);
		$head['grupos']=$this->usuariosModel->getGrupos();
		$paradero = $this->usuariosModel->getParaderoUsuario($id);
		$head['paradero']= $this->programacionModel->getParaderoUsuario($id);
		$head['map'] = $paradero['map'];
		if(!$this->rutasModel->chequearParaderoExisteUsuario($id)){
				$this->load->view('sistema/usuarios/perfilUsuariosN', $head);
			}else{
				$this->load->view('sistema/usuarios/perfilUsuarios', $head);
		}
		
    }
	
	public function ajax_actualizarDatos(){
		$this->load->model('rutasModel');
		$usuario = $_POST['userid'];
		$datosUsuario = array(
			'first_name'=>$_POST['nombre'],
			'last_name'=>$_POST['apellido'],
			'phone'=>$_POST['celular'],
			'rut'=>$_POST['ndoc'],
			'address'=>$_POST['direccion_paradero'],
			'address_detail'=>$_POST['informacion_adicional'],
			'habitantes'=>$_POST['no_habitantes'],
			'tipo_vivienda'=>$_POST['tipo_vivienda']
			);
		$datosParadero = array(
			'direccion'=>$_POST['direccion_paradero'],
			'lat'=>$_POST['lat'],
			'lon'=>$_POST['lng'],
			'activo'=>0,
			'ordenamiento'=>0,
			'nombre'=>$_POST['nombre_paradero'],
			'usuario_id'=>$usuario,
			'estado'=>1 );
		$validarExParadero = $this->rutasModel->checkParaderoUsuario($usuario);
		/* si no existe, que deberia ser asi, insertar paradero y hacer update en usuarios.*/
		$result = array();
		if(!$validarExParadero){
			if($this->rutasModel->guardarParaderoAjax($datosParadero)){
				$result['paradero']=1;
			}else{
				$result['paradero']=0;
			}
			if($this->rutasModel->actualizarDatosUsuario($usuario,$datosUsuario)){
				$result['usuario']=1;
			}else{
				$result['usuario']=0;
			}
			$result['code']=100;
			$result['userid']=$usuario;
			echo json_encode($result);
		}else{
			if($this->rutasModel->actualizarParaderoAjax($usuario, $datosParadero)){
				$result['paradero']=1;
			}else{
				$result['paradero']=0;
			}
			if($this->rutasModel->actualizarDatosUsuario($usuario,$datosUsuario)){
				$result['usuario']=1;
			}else{
				$result['usuario']=0;
			}
			$result['code']=100;
			$result['userid']=$usuario;
			echo json_encode($result);
		}
		/*echo json_encode(array('code'=>100, 'userid'=>$usuario));*/
	}
	
    public function eUsuario(){
        $id=filter_input(INPUT_POST, 'userid');
        $user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();
		$estadoA = filter_input(INPUT_POST, 'estado_actual');
		$estadoB = filter_input(INPUT_POST, 'activo');
		if($estadoA != $estadoB){
			$dat = array('active'=>$estadoB);
			$this->usuariosModel->actualizarEstado($id,$dat);
		}
	 	if(isset($_FILES['userfile']['size']) and $_FILES['userfile']['size']!=0){
		$this->load->helper('text');
				$config['upload_path']          = realpath(APPPATH.'../images/profiles/');
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
				/*nombre nuevo*/
				$filtereNewName = preg_replace('/\s+/', '_', $_FILES["userfile"]['name']);
				$new_name = time().(ascii_to_entities($filtereNewName));
				$config['file_name'] = $new_name;
				/*nombre nuevo*/
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile'))
                {
					$this->session->set_flashdata('message', $this->upload->display_errors());//redirect("usuarios", 'refresh');
                }else{
					$result = $this->upload->data(); /*resulatado de la carga datos*/
                    $imagen =$result['file_name']; /* ruta para el archivo */
                }
		}
        //var_dump($_POST, $_FILES['userfile'], $result,$image);die();
        $data = array( 
					'first_name' => filter_input(INPUT_POST, 'nombre'),
                    'last_name' => filter_input(INPUT_POST, 'apellido'),
                    'phone' => filter_input(INPUT_POST, 'celular'),
                    'rut' =>filter_input(INPUT_POST, 'ndoc'),
					'username'=>filter_input(INPUT_POST, 'ndoc')
				);
		if(isset($imagen) and strlen($imagen)>3){$data['imagen']=$imagen;}
        
                $pwr = isset($_POST['clave'])?filter_input(INPUT_POST, 'clave'):'';
				// update the password if it was posted
				if(strlen($pwr)>4){ $data['password'] = $pwr; }
				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin()){
					// Update the groups user belongs to
					$groupData = array(filter_input(INPUT_POST, 'tipousuario'));
					if (isset($groupData) && !empty($groupData))
					{
						$this->ion_auth->remove_from_group('', $id);
						foreach ($groupData as $grp)
						{
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}
				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data))
				{
						if($id == $_SESSION['user_id']){
							$datosUsuario = $this->usuariosModel->getSessionData($_SESSION['user_id'], 2);
							$sessionInfo = array(
										'username'  => $datosUsuario->first_name.' '.$datosUsuario->last_name,
										'email'     => $datosUsuario->email,
										'imagen'    => $datosUsuario->imagen,
										'logged_in' => TRUE
								);
								$this->session->set_userdata($sessionInfo);
							}
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->messages());
						if (!$this->ion_auth->is_admin()){
							redirect('sistema', 'refresh');
						}else{
							redirect("usuarios", 'refresh');
						}
				}   
    }
	public function ajax_comprobarRut(){
		$rut = filter_input(INPUT_POST, 'rut');
		$res = $this->usuariosModel->comprobarRut($rut);
		$result=array();
		if($res){
			$result['response']=1;/*existe*/
		}else{
			$result['response']=0;/*no existe*/
		}
		echo json_encode($result);
	}
	public function rutas(){
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Usuario Rutas - Amazoniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$this->load->view('sistema/usuarios/listarRutas', $head);
	}
	
	public function editarRutaUsuarios($id){
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Usuario Rutas - Amazoniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true)
					);
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$head['usuario']=$this->usuariosModel->getUsuariosSistema($id);
		$head['rutasOp']=$this->usuariosModel->getZonasOptions($id);
		$this->load->view('sistema/usuarios/editarRutaUsuarios', $head);
	}
	public function guardarUsuarioZona(){
		$this->usuariosModel->delUsuarioZonas($_POST['userid']);
		foreach($_POST['rutasUsuario'] as $k => $v){
			$this->usuariosModel->asignarZonas($_POST['userid'], $v);
		}
		$this->session->set_flashdata('message', 'Zonas actualizadas');
		redirect('usuarios/rutas');
	}
	/*	public function editarRutaUsuarios($id){
		
		$headData = array('titulo_pagina' => 'Usuario Rutas - Amazoniko');
		
		$headerData = array('rutas_main'=> 'active');
	
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true)
					);
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$head['usuario']=$this->usuariosModel->getUsuariosSistema($id);
		$head['rutasOp']=$this->usuariosModel->getZonasOptions($id);
		$this->load->view('sistema/usuarios/editarRutaUsuarios', $head);
	}*/
	
	public function guardarUsuarioRutas(){
		$this->usuariosModel->delUsuarioRutas($_POST['userid']);
		foreach($_POST['rutasUsuario'] as $k => $v){
			$this->usuariosModel->asignarRutas($_POST['userid'], $v);
		}
		$this->session->set_flashdata('message', 'Rutas actualizadas');
		redirect('usuarios/rutas');
	}
	
	
}