<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tips extends CI_Controller
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
		{
			return show_error('You must be an administrator to view this page.');
		}*/
		$this->load->model('rutasModel');
		$this->load->model('programacionModel');
	}
	
	public function index(){
		
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Programaciones - Amazoniko');
		/*HEADER*/
		$headerData = array('op_tips'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
			$this->load->view('sistema/tips/index', $head);
	}
	
	
}