<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->library('passwordHash');
		$this->load->helper(array('url', 'language'));
		$this->load->model('usuariosModel');
		$this->load->model('integracionModel');
		//$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}
	
	public function index(){
		
		/* TITULO DE PAGINA */
		$h_data = array('titulo_pagina' => 'Login - Amazóniko');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('static/head',$h_data,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}		
		$this->load->view('login', $head);
	}
	
	public function registro(){
		/* TITULO DE PAGINA */
		$h_data = array('titulo_pagina' => 'Registro - Amazóniko');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('static/head',$h_data,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}		
		$this->load->view('registro', $head);
	}
	
	public function registrarUsuario(){
		$email = strtolower($_POST['correo']);
		$identity = $email;
		$password = $_POST['clave'];
			$additional_data = array(
				'first_name' => $_POST['username'],
			);
		if ($this->ion_auth->register($identity, $password, $email, $additional_data))
		{
			if($this->ion_auth->login($email,$password)){
				//if the login is successful
				/* ingresar datos en sesion */
				$datosUsuario = $this->usuariosModel->getSessionData($email);
				$sessionInfo = array(
					'username'  => $datosUsuario->first_name.' '.$datosUsuario->last_name,
					'email'     => $datosUsuario->email,
					'imagen'    => $datosUsuario->imagen,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sessionInfo);
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				return redirect('sistema?w=1', 'refresh');
			}
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("inicio", 'refresh');
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("inicio/registro", 'refresh');
	      // do something
		}
	}
		
	public function ingresoUsuario(){
		
		/* TITULO DE PAGINA */
		$h_data = array('titulo_pagina' => 'Login Process');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('static/head',$h_data,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$id=((isset($_POST['user']) and strlen($_POST['user'])>1)?filter_input(INPUT_POST, 'user'):'nd');
		$pwr=filter_input(INPUT_POST, 'pwr');
			if($this->ion_auth->login($id,$pwr)){
				//if the login is successful
				/* ingresar datos en sesion */
				$datosUsuario = $this->usuariosModel->getSessionData($id);
				$sessionInfo = array(
					'username'  => $datosUsuario->first_name.' '.$datosUsuario->last_name,
					'email'     => $datosUsuario->email,
					'imagen'    => $datosUsuario->imagen,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sessionInfo);
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('sistema', 'refresh');
			}else{
				$iUser = $this->integracionModel->getUser($id);
				if($iUser['count']>0){
					$user = $iUser['result'];
					$check = $this->passwordhash->CheckPassword($pwr, $user->user_pass);
					if($check){
					 /* chequear si existe en sistema si no registrarlo y seguir */
					 $sistemaExiste = $this->usuariosModel->checkUserExist($id);
					 if($sistemaExiste){
						$this->usuariosModel->loginMail($id);
						/* si existe iniciar session con los datos*/
						$datosUsuario = $this->usuariosModel->getSessionData($id);
						$sessionInfo = array(
							'username'  => $datosUsuario->first_name.' '.$datosUsuario->last_name,
							'email'     => $datosUsuario->email,
							'imagen'    => $datosUsuario->imagen,
							'logged_in' => TRUE
						);
						$this->session->set_userdata($sessionInfo);
						//redirect them back to the home page
						$this->session->set_flashdata('message', 'Sesion Iniciada por Integracion.');
						redirect('sistema', 'refresh');
					 }else{
						/* Registrar el usuario e iniciar sesion */
						$email = strtolower($user->user_email);
						$identity = $user->user_email;
						$password = $pwr;
							$additional_data = array(
								'first_name' => $iUser['first_name'],
								'last_name' => $iUser['last_name'],
								'active' => 1
							);
						if ($this->ion_auth->register($identity, $password, $email, $additional_data))
						{
							$this->usuariosModel->loginMail($id);
							$datosUsuario = $this->usuariosModel->getSessionData($id);
							$sessionInfo = array(
								'username'  => $datosUsuario->first_name.' '.$datosUsuario->last_name,
								'email'     => $datosUsuario->email,
								'imagen'    => $datosUsuario->imagen,
								'logged_in' => TRUE
							);
							$this->session->set_userdata($sessionInfo);
							//redirect them back to the home page
							$this->session->set_flashdata('message', 'Session iniciada con exito, Usuario Registrado en sistema, por favor <a href="'.site_url('usuarios/perfilUsuario').'">verifique sus datos</a>');
							redirect('sistema', 'refresh');
						}else{
							$this->session->set_flashdata('message', 'No se puede iniciar sesion con los datos Suministrados');
							redirect('inicio', 'refresh'); // use redirects instead of loading views for compatibility with MY_C
						  // do something
						}
					 }
					}else{
						$this->session->set_flashdata('message', 'No se puede iniciar session con los datos Suministrados');
						redirect('inicio', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
					}	
				}else{
					$pwrold = md5($pwr);
					$datosUsuario = $this->usuariosModel->getUserOld($pwrold,$id, 2);
					if($datosUsuario){
						$data = $this->usuariosModel->getUserOld($pwrold,$id);
						$this->usuariosModel->loginMail($data->email);
						/* si existe iniciar session con los datos*/
						$datosUsuario = $this->usuariosModel->getSessionData($id);
						$sessionInfo = array(
							'username'  => $datosUsuario->first_name.' '.$datosUsuario->last_name,
							'email'     => $datosUsuario->email,
							'imagen'    => $datosUsuario->imagen,
							'logged_in' => TRUE
						);
						$this->session->set_userdata($sessionInfo);
						//redirect them back to the home page
						$this->session->set_flashdata('message', 'Sesion Iniciada por Integracion plataforma Anterior.');
						redirect('sistema', 'refresh');
					}else{
						// if the login was un-successful
						// redirect them back to the login page
						$this->session->set_flashdata('message', 'No se ha podido iniciar sesion con los datos suministrados');
						redirect('inicio', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
					}
				}
			}
		//var_dump($_POST);
	}
	public function logout(){
		session_destroy();
		redirect('inicio', 'refresh');
	}
	
	public function ping(){
		if(isset($_GET["ip"])){
			$ip = (strlen($_GET["ip"])>6?$_GET["ip"]:'172.217.28.99');
			if(strlen($_GET["ip"])<6){ echo "La direccion ip no es correcta... usando ip google.com.co <br><br>";}
			echo "Haciendo ping a: <b>".$ip."</b><br><br>";
		}else{
			echo "No enviaste ip para hacer ping";
		return 0;
		}

		if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $ip);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		// Petición HEAD
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		$content = curl_exec($ch);
		if (!curl_errno($ch)) {
		$info = curl_getinfo($ch);
			print_r("\nSe recibió respuesta " . $info['http_code'] . ' en ' . $info['total_time'] . " segundos \n");
		} else {
			print_r("\nError en petición: " . curl_error($ch) . "\n");
		}
		curl_close($ch);
		} else {
			print_r("\nDirección IP no válida: " . $ip . "\n");
		}
	}
}