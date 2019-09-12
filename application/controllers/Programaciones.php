<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Programaciones extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->lang->load('auth');
		if (!$this->ion_auth->logged_in()){ redirect('inicio', 'refresh'); }
		/*else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{return show_error('You must be an administrator to view this page.');}*/
		$this->load->model('rutasModel');
		$this->load->model('programacionModel');
	}
	
	public function index(){
		/*$programacion = $this->programacionModel->getProgramacionUsuario($id);
		if($programacion['code']=1){$this->session->set_flashdata('message', $programacion['codeText']);}*/
		$this->load->model('usuariosModel');
		$id = $this->session->userdata('user_id');
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Recolecciones - Amazoniko');
		/*HEADER*/
		$headerData = array('prog_sel'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		if($this->ion_auth->in_group('members')){
			/* si es usuario comun, mostrar la informacion de paradero y si tiene o no la recoleccion activa */
			$paradero = $this->usuariosModel->getParaderoUsuario($id);
			$head['paradero']= $this->programacionModel->getParaderoUsuario($id);
			$head['map'] = $paradero['map'];
			$head['fecha'] = $this->programacionModel->getProximasFechas($id);
			$head['usuario'] = $this->session->userdata('user_id');
			$head['paraderoExiste'] = $this->programacionModel->comprobarParadero($id);
			$this->load->view('sistema/programaciones/detallarProgramacionUsuario', $head);/* index para no administradores*/
		}

		if($this->ion_auth->in_group('recolectores')){
			/* Si es recolector Mostrar recoleccion activa asignada */
			$this->load->view('sistema/programaciones/listarProgramaciones', $head);
		}

		if($this->ion_auth->is_admin()){
			/* Si es administrador listar las programaciones */
			$this->load->view('sistema/programaciones/listarProgramaciones', $head);
		}
	}
	
	public function recolectores(){
		$this->load->model('usuariosModel');
		$id = $this->session->userdata('user_id');
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Recolecciones - Amazoniko');
		/*HEADER*/
		$headerData = array('prog_sel'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true), 'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$head['idUsuario'] = $this->session->userdata('user_id');
		/* Si es administrador listar las programaciones */
		$this->load->view('sistema/recolectores/recolecciones', $head);
	}
	
	public function listarFechas(){
		$this->load->model('usuariosModel');
		$id = $this->session->userdata('user_id');
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Fechas de recoleccion - Amazoniko');
		/*HEADER*/
		$headerData = array('prog_sel'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}	
			/* Si es administrador listar las programaciones */
			$this->load->view('sistema/programaciones/listarFechas', $head);
	}
	
	public function listarRecolecciones(){
		
		$this->load->model('usuariosModel');
		$id = $this->session->userdata('user_id');
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Recolecciones - Amazoniko');
		/*HEADER*/
		$headerData = array('prog_sel'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}	
		/* Si es administrador listar las programaciones */
		$this->load->view('sistema/programaciones/listarRecolecciones', $head);
	}
	
	public function borrarFechaUsuario(){
		$this->programacionModel->borrarFechaUsuario($_GET['pf'], $_GET['u']);
		$this->session->set_flashdata('message', 'La programacion ha sido actualizada.');
		redirect('programaciones');
	}
	
	public function crearProgramacion(){
		
		/* comprobar si es administrador para la funcion especifica */
		if (!$this->ion_auth->is_admin()){$this->session->set_flashdata('message', 'Acceso no permitido.');redirect('sistema');}
		else{
			/*HEAD*/
			$headData = array('titulo_pagina' => 'Crear programacion - Amazoniko');
			/*HEADER*/
			$headerData = array('prog_sel'=> 'active');
			/* CONTENIDO ESTATICO */
			$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
						'header'=>$this->load->view('sistema/static/header',$headerData,true));
			$head['zonas'] = $this->rutasModel->getZonas();
			if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
			$this->load->view('sistema/programaciones/crearProgramacion', $head);/* index para no administradores*/
		}
	}
	
	public function guardarProgramacionUsuario(){
		$idu = $this->session->userdata('user_id');
		$idFecha=$_POST['fechaProxima'];
		$data = array('programacion_fecha'=>$idFecha,'usuario_id'=>$idu,'estado'=>1);
		if($this->programacionModel->registrarUsuarioProgramacion($data)){
				$this->session->set_flashdata('message', 'Se ha registrado la progamacion satisfactoriamente.');
				redirect('programaciones');		
			}else{
				$this->session->set_flashdata('message', 'No se pudo registrar la recoleccion');
				redirect('programaciones');		
			}
	}

	public function guardarProgramacionNueva(){
		/* DATOS DE RECOLECCION */
		$datos_recoleccion = array('ruta_id'=>filter_input(INPUT_POST, 'ruta'),'recolector'=>filter_input(INPUT_POST, 'recolector'),'fecha'=>filter_input(INPUT_POST, 'fecha_inicial'),'estado'=>1);
		$recol = $this->programacionModel->guardarRecoleccion($datos_recoleccion);
		/* activa programacion si selecciona repetir */
		if(isset($_POST['repetir']) and $_POST['repetir']==1){
			$fecha = filter_input(INPUT_POST, 'fecha_inicial');
			$proxima_fecha = date("Y-m-d",strtotime($fecha."+ 1 week")); /* + una semana */
			$dataProgramacion = array('user_id'=>$this->session->userdata('user_id'),
								  'estado'=>1,
								  'zona'=>filter_input(INPUT_POST, 'zona'),
								  'ruta'=>filter_input(INPUT_POST, 'ruta'),
								  'recolector'=>filter_input(INPUT_POST, 'recolector'),
								  'repetir'=>1
								);
		/* Declaramos el arreglo de la nueva fecha faltaria el id de la programacion que se va a crear */
			$dataFecha = array('nuevafecha'=>$proxima_fecha,'estado'=>1);
			$prog = $this->programacionModel->guardarProgramacion($dataProgramacion);
			if($prog > 0){
				$dataFecha['programacion_id'] = $prog;
				if($this->programacionModel->guardarNuevaFecha($dataFecha)){
					$this->session->set_flashdata('message', 'La programacion fue creada existosamente.');
					redirect('programaciones');	
				}else{
					$this->session->set_flashdata('message', 'La programacion fue creada, no se pudo asignar Fecha Nueva.');
					redirect('programaciones');	
				}
			}else{
				$this->session->set_flashdata('message', 'No se pudo crear la programacion solicitada.');
				redirect('programaciones');		
			}
		}else{
			if($recol>0){
				$this->session->set_flashdata('message', 'Fecha de recoleccion Creada.');
				redirect('programaciones');		
			}else{
				$this->session->set_flashdata('message', 'No se pudo crear la recoleccion solicitada.');
				redirect('programaciones');		
			}
		}
		/* DATOS DE PROGRAMACION */
	}
	
	/*activar desactivar recoleccion automatica  NO SE HABILITO DE ESA FORMA*/
	public function recAutoUsuario(){
		echo json_encode(array('responsse'=>true));
	}
	/*activar desactiva recoleccion de usuario  NO SE HABILITO DE ESA FORMA*/
	public function pro_recoleccionUsuario(){
		echo json_encode(array('responsse'=>true));
	}
}