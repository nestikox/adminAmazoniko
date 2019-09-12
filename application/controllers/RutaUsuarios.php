<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RutaUsuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->lang->load('auth');
		$this->load->model('rutasModel');
		/* SI NO HA INICIADO SESION REDIRIGIR Y ENVIAR MENSAJE */
		if (!$this->ion_auth->logged_in()){ $this->session->set_flashdata('message', 'Sesión Finalizada.'); redirect('inicio', 'refresh'); }
		/*else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins {// redirect them to the home page because they must be an administrator to view this return show_error('You must be an administrator to view this page.'); }*/
	}
	
	public function index()
    {
        /*HEAD*/
		$headData = array('titulo_pagina' => 'Rutas - Amazoniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		
		$this->load->view('sistema/rutas/listarRutas', $head);
    }
	
}
