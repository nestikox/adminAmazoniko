<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CronJobProcess extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->library('passwordHash');
		$this->load->helper(array('url', 'language'));
		$this->load->model('usuariosModel');
		$this->load->model('cronModel');
		//$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}
	
    /*
     ****cerrarFechasVencimiento***
     - Cerrar la fecha ACTUAL
     - Crear proxima fecha segun ultima fecha programada (ruta last fc)
       -- la proxima fecha es la ultima generada con mas de 13 dias siguientes 
     - Desactivar postulaciones a esta fecha
     (opcional)
        --- verificar postulaciones y si esta fecha generó recoleccion
        --- si no genero recoleccion informar a los usuarios de su cierre y apertura de nueva fecha para postulaciones
        
    */
    public function cerrarFechasVencimiento(){
		$this->cronModel->cerrarDia();
    }
	
	 public function actualizarPuntos(){
		$this->cronModel->actualizarPuntos();
    }
	/*public function asignarRuta(){
		$usuarios = $this->cronModel->getUsuarios();
		foreach($usuarios as $k => $v){
			echo " usuario -> ".$v->id.' ';
			$this->cronModel->asignarRuta($v->id, 1);
			echo 'ruta 1 asiganada <br>'; 
		}
	}*/
}