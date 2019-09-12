<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
			//$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		if (!$this->ion_auth->logged_in()){ redirect('inicio', 'refresh'); }
		$this->load->model('rutasModel');
		$this->load->model('sistemaModel');
		/*else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}*/
	}
	
	public function index(){
		$id = $this->session->userdata('user_id');
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Tablero Principal - Amazoniko');
		/*HEADER*/
		$headerData = array('op_dashboard'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if($this->ion_auth->in_group('members')){
			if(!$this->rutasModel->chequearParaderoExisteUsuario($id)){
				if(isset($_SESSION['message'])){
					$_SESSION['message']='';
					$this->session->set_flashdata('message', $_SESSION['message'].'  Por favor Actualice Sus Datos de recoleccion en la seccion de  <a href="'.site_url('usuarios/perfilUsuario').'">Mi perfil</a>');//redirect("usuarios", 'refresh');
				}else{
					$_SESSION['message']='';
					$this->session->set_flashdata('message', '  Por favor Actualice Sus Datos de recoleccion en la seccion de  <a href="'.site_url('usuarios/perfilUsuario').'">Mi perfil</a>');//redirect("usuarios", 'refresh');
				}
			}
			if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
			$head['dashboard']=$this->sistemaModel->getDashboard('members', $id);
			$this->load->view('sistema/index2', $head);
			/* index para no administradores*/
		}
		
		if($this->ion_auth->in_group('recolectores')){
			if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
			$this->load->view('sistema/index2', $head);
			/* index para no administradores*/
		}
		
		if($this->ion_auth->is_admin()){
			$head['dashboard']=$this->sistemaModel->getDashboard('admin', $id);
			if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
			$this->load->view('sistema/index', $head);
		}
	
	}
	
	public function historialUsuario(){
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Historial - Amazoniko');
		/*HEADER*/
		$headerData = array('op_historial'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$this->load->view('sistema/historial/historial', $head);
		/* index para no administradores*/
	}
	
	public function maloka(){
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Maloka - Amazoniko');
		/*HEADER*/
		$headerData = array('op_maloka'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$this->load->view('sistema/maloka/index', $head);/* index para no administradores*/
	}

	public function enviarMaloka(){
		$this->session->set_flashdata('message', 'No se puede procesar la solicitud en este momento.');
		redirect('sistema/maloka', 'refresh');
	}
	
	public function unidades(){
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Unidades - Amazoniko');
		/*HEADER*/
		$headerData = array('op_conf'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$this->load->view('sistema/configuracion/listarUnidades', $head);/* index para no administradores*/
	}
	
	public function crearUnidad(){
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Crear Unidad - Amazoniko');
		/*HEADER*/
		$headerData = array('op_conf'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$this->load->view('sistema/configuracion/crearUnidad', $head);/* index para no administradores*/
	}

	public function guardarUnidad(){	
		$data = array('nombre'=>filter_input(INPUT_POST, 'nombre'), 'activo'=>1 );
		if($this->sistemaModel->guardarUnidad($data)){
			$this->session->set_flashdata('message', 'Unidad Guardada con Exito');
			redirect('sistema/unidades', 'refresh');
		}else{
			$this->session->set_flashdata('message', 'No se pudo guardar la unidad');
			redirect('sistema/unidades', 'refresh');
		}
	}

	public function cambiarEstadoUnidad(){
		$nuevo_estado = ($_REQUEST['estado']==1?0:1);
		$data = array('activo'=>$nuevo_estado);
		$this->sistemaModel->cambiarEstadoUnidad($_REQUEST['id'],$data);
		$this->session->set_flashdata('message', 'Estado Actualizado');
		redirect('sistema/unidades', 'refresh');
	}
	
	public function editarUnidad($id){
			/*HEAD*/
			$headData = array('titulo_pagina' => 'Editar Unidad - Amazoniko');
			/*HEADER*/
			$headerData = array('op_conf'=> 'active');
			/* CONTENIDO ESTATICO */
			$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
						'header'=>$this->load->view('sistema/static/header',$headerData,true));
			$head['unidad'] = $this->sistemaModel->getUnidad($id);
			if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
			$this->load->view('sistema/configuracion/editarUnidad', $head);/* index para no administradores*/
	}

	public function actualizarUnidad(){
		$id = $_POST['unidad_id'];
		$data = array('nombre'=>filter_input(INPUT_POST, 'nombre'),'activo'=>1 );
		if($this->sistemaModel->actualizarUnidad($id,$data)){
			$this->session->set_flashdata('message', 'Unidad actualizada con Exito');
			redirect('sistema/unidades', 'refresh');
		}else{
			$this->session->set_flashdata('message', 'No se pudo guardar la unidad');
			redirect('sistema/unidades', 'refresh');
		}
	}
	
	public function pwr5md(){
		$clave = md5('password');
		echo $clave;
	}
	
	/* ACTUALIZACION DE DATOS VIEREJOS A NUEVOS
	public function asignarGrupo($idUser, $grupoAnterior){
		$this->load->model('sistemaModel');
		switch($grupoAnterior){
			case 1: $this->sistemaModel->asignarGrupo($idUser, 1); break;
			case 2: $this->sistemaModel->asignarGrupo($idUser, 1); break;
			case 3: $this->sistemaModel->asignarGrupo($idUser, 3); break;
			case 4: $this->sistemaModel->asignarGrupo($idUser, 2); break;
			default: return false; break;
		}
	}
	
	public function updateUsuarios(){
		$this->load->model('sistemaModel');
		$usuarios_viejos = $this->sistemaModel->getUsuarios();
		$q="";
		foreach($usuarios_viejos as $k=>$v){
			$data = array('ip_address'=>'127.0.0.1',
						  'password'=>'404', 
						  'created_on'=>'19700101', 
						  'active'=>1,
						  'username'=>intval($v->numero_identificacion), 
						  'password_old'=>$v->contraseña, 
						  'email'=>$v->correo, 
						  'first_name'=>$v->nombre, 
						  'phone'=>$v->celular, 
						  'rut'=>intval($v->numero_identificacion), 
						  'address'=>$v->direccion, 
						  'address_detail'=>$v->nombre_edificio." ".$v->apto);
			
			$usuarioIn = $this->sistemaModel->insertarUsuario($data);
			$res = "";
			if($usuarioIn>0){
				$grupo = $this->asignarGrupo($usuarioIn, $v->id_rol);
				$dataParadero= array('direccion'=>$v->direccion, 'lat'=>$v->lat, 'lon'=>$v->lon, 'id_ruta'=>0, 'activo'=>1, 'ordenamiento'=>0, 'nombre'=>$v->nombre_edificio, 'usuario_id'=>$usuarioIn, 'estado'=>1);
				$paradero = $this->sistemaModel->asignarParadero($dataParadero);
				$res.= "usuario = ".$usuarioIn." -- ";
				$res.= "grupo = ".$grupo." -- ";
				$res.= "paradero =".$paradero." <br>";
				echo $res;
			}
		}
	}
	*/
}