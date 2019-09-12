<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas extends CI_Controller
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
    public function editarZona($id){
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Zonas - Amazoniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		$head['poligonZona'] = $this->rutasModel->getPoligonZona($id);
		$head['zona'] = $this->rutasModel->getZonas($id);
		$head['recoleccion'] = $this->rutasModel->getRecoleccionZona($id);
		$this->load->view('sistema/rutas/editarZona', $head);
	}

    public function zonasAdm(){
       	/*HEAD*/
		$headData = array('titulo_pagina' => 'Zonas - Amazoniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		
		$this->load->view('sistema/rutas/listarZonas', $head);
    }
    public function vcRuta(){
     	/*HEAD*/
		$headData = array('titulo_pagina' => 'Crear Ruta - Amazóniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		$head['zonas'] = $this->rutasModel->getZonas();
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		
		$this->load->view('sistema/rutas/crearRutas', $head);
    }
    public function vcZona(){
       	/*HEAD*/
		$headData = array('titulo_pagina' => 'Crear Zonas - Amazóniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		
		$this->load->view('sistema/rutas/crearZonas', $head);
    }
	 public function editarRuta($idRuta){
       	/*HEAD*/
		$headData = array('titulo_pagina' => 'Editar Zonas - Amazóniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		if(!isset($idRuta) and $idRuta<1){
			$this->session->set_flashdata('message', 'No se pudo consultar la ruta especificada.');
			redirect('rutas');
		}
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		/* datos de recoleccion */
		$head['rd'] =$this->rutasModel->getProgramacionRuta($idRuta);
		$head['zonas'] = $this->rutasModel->getZonas();
		$head['ruta'] = $this->rutasModel->getRutas($idRuta);
		$this->load->view('sistema/rutas/editarRuta', $head);
    }
   
    public function crearRuta(){
        /*preparar los datos para el modelo*/
		$ruta = array('nombre'=>filter_input(INPUT_POST,'nombre_ruta'),'activo'=>1,'id_zona'=>filter_input(INPUT_POST,'zona'));
		$paraderoInicial = array('nombre'=>filter_input(INPUT_POST,'nombre_paradero'),'lat'=>filter_input(INPUT_POST,'lat'),
								 'lon'=>filter_input(INPUT_POST,'lon'),'direccion'=>filter_input(INPUT_POST,'direccion_paradero'),
								 'activo'=>TRUE,'ordenamiento'=>1);
		$resultado = $this->rutasModel->guardarRuta($ruta, $paraderoInicial);
		if($resultado['codeFinal']=1){
			$this->session->set_flashdata('message', 'La ruta se creó satisfactoriamente.');
			redirect('rutas');
		}else{
			$this->session->set_flashdata('message', $resultado['message']);
			redirect('rutas');
		}
    }
    
    public function listarParaderos($paradero){
		/*HEAD*/
		$headData = array('titulo_pagina' => 'Crear Zonas - Amazóniko');
		/*HEADER*/
		$headerData = array('rutas_main'=> 'active');
		/* CONTENIDO ESTATICO */
		$head = array('head'=>$this->load->view('sistema/static/head',$headData,true),
					  'header'=>$this->load->view('sistema/static/header',$headerData,true));
		if(isset($_SESSION['message'])){$head['message'] = $_SESSION['message'];}
		if(!isset($paradero) and $paradero<1){
            $this->session->set_flashdata('message', 'No se ha especificado una ruta.');
            redirect('rutas');
        }else{
			$pdata = $this->rutasModel->getParaderos($paradero);/*traer arreglo de datos*/
			$head['paraderosMap']=$pdata['map'];
            $head['paraderosData']=$pdata['result'];
			$head['rutas']=$this->rutasModel->getRutas($paradero);
		}
		
		$this->load->view('sistema/rutas/listarParaderos', $head);
    }
	
    public function crearZona(){
        /*preparar los datos para el modelo*/
		$zona = array('nombre'=>filter_input(INPUT_POST,'nombre'),
                      'descripcion'=>filter_input(INPUT_POST, 'descripcion'),
                      'direccion'=>filter_input(INPUT_POST, 'direccion'),
                      'delimitacion'=>filter_input(INPUT_POST, 'delimitacion'),
                      'color'=>filter_input(INPUT_POST, 'colorpoligono'),
                      'activo'=>1);
		$resultado = $this->rutasModel->guardarZona($zona);
		if($resultado['codeFinal']=1){
            foreach($_POST['coordenadaspoligono'] as $k => $v){
                $this->rutasModel->guardarZonaCoordenada($v, $resultado['id']);
            }
			$this->session->set_flashdata('message', 'La Zona fue creada satisfactoriamente.');
			redirect('rutas/zonasAdm');
		}else{
			$this->session->set_flashdata('message', $resultado['message']);
			redirect('rutas/zonasAdm');
		}
    }
	
	public function actualizarZona(){
		$idZona = filter_input(INPUT_POST,'idZona');
		$zona = array('nombre'=>filter_input(INPUT_POST,'nombre'),
                      'descripcion'=>filter_input(INPUT_POST, 'descripcion'),
                      'direccion'=>filter_input(INPUT_POST, 'direccion'),
                      'delimitacion'=>filter_input(INPUT_POST, 'delimitacion'),
                      'color'=>filter_input(INPUT_POST, 'colorpoligono'),
                      'activo'=>filter_input(INPUT_POST, 'estado'));
		$resultado = $this->rutasModel->actualizarZona($idZona, $zona);
		if($resultado['codeFinal']=1){
			if(isset($_POST['coordenadaspoligono']) and is_array($_POST['coordenadaspoligono']) and sizeof($_POST['coordenadaspoligono'])>1):
			$this->rutasModel->resetZonaCoordenadas($resultado['id']); /* RESETEAR COORDENADAS*/
				foreach($_POST['coordenadaspoligono'] as $k => $v){/* LOOP AGREGAR COORDENADAS*/
					$this->rutasModel->guardarZonaCoordenada($v, $resultado['id']);
				}
			endif;
			$this->session->set_flashdata('message', 'La Zona fue editada Correctamente.');
			redirect('rutas/zonasAdm');
		}else{
			$this->session->set_flashdata('message', $resultado['message']);
			redirect('rutas/zonasAdm');
		}
	}
	
	public function actualizarRuta(){
		/* si programacion_id es mayor que 0 quiere decir que
		   existe una programacion por tanto es una actualizacion,
		   si es 0 crear nueva programacion */
		$repetir =1;
		$programacion_id = $_POST['programacion_id'];
		$programacion_activa = ((isset($_POST['recoleccion_activa']) and $_POST['recoleccion_activa']==1)?$_POST['recoleccion_activa']:0);
			if($programacion_id>0){
				if(isset($_POST['actualizar_programacion']) and $_POST['actualizar_programacion']==1){
					/* actualizar programacion */
					$dataProgramacion =  array('user_id'=>$this->session->userdata('user_id'),
											   'estado'=>$programacion_activa,'zona'=>$_POST['zona'],'ruta'=>$_POST['idRuta'], 
											   'repetir'=>1,'dia'=>$_POST['dia_recoleccion']);
					/* Guardar programacion y traer el codigo generado */
					$programacionid = $this->rutasModel->actualizarProgramacion($programacion_id, $dataProgramacion);
					/* recoleccion inicial 
					$dataRecoleccion = array('fecha'=>$_POST['fecha_inicial'],'estado'=>1);
					$this->rutasModel->actualizarRecoleccion($programacionid, $dataRecoleccion);*/
					/* Si se repite agregar nueva fecha */
					if($repetir==1){
						/*calcular proximo dia y guardar recoleccion proxima*/
						$proximaFecha = $this->rutasModel->getNuevaFecha($_POST['fecha_inicial']);
						/* BORRAR PROGRAMACIONES y volver a insertar */
						$this->rutasModel->resetProgramaciones($programacion_id);
						/* proxima recoleccion despues de la fecha inicial */
						$inicial = array('programacion_id'=>$programacion_id, 'nuevafecha'=>$proximaFecha->fecha1,'estado'=>1);
						$dataProximaRecoleccion = array('programacion_id'=>$programacion_id, 'nuevafecha'=>$proximaFecha->next,'estado'=>1);
						$dataProximaRecoleccion2 = array('programacion_id'=>$programacion_id, 'nuevafecha'=>$proximaFecha->next2,'estado'=>1);
						$this->rutasModel->guardarFechasProgramacion($inicial);
						$this->rutasModel->guardarFechasProgramacion($dataProximaRecoleccion);
						$this->rutasModel->guardarFechasProgramacion($dataProximaRecoleccion2);
					};
				}
			}else{
				/* asegurar que estan enviado una fecha inicial para crear la programacion */
				if(isset($_POST['fecha_inicial']) and strlen($_POST['fecha_inicial'])>3){
					$repetir = (isset($_POST['repetir'])?$_POST['repetir']:1);
					/* crear programacion */
					$dataProgramacion =  array('user_id'=>$this->session->userdata('user_id'),
											   'estado'=>$programacion_activa,'zona'=>$_POST['zona'],'ruta'=>$_POST['idRuta'], 
											   'repetir'=>$repetir,'dia'=>$_POST['dia_recoleccion']);
					/* Guardar programacion y traer el codigo generado */
					$programacionid = $this->rutasModel->guardarProgramacion($dataProgramacion);
					/* recoleccion inicial 
					$dataRecoleccion = array('programacion_id'=>$programacionid, 'fecha'=>$_POST['fecha_inicial'],'estado'=>1);
					$this->rutasModel->guardarRecoleccion($dataRecoleccion);*/
					/* Si se repite agregar nueva fecha */
					if($repetir==1){
						/*calcular proximo dia y guardar recoleccion proxima*/
						$proximaFecha = $this->rutasModel->getNuevaFecha($_POST['fecha_inicial']);
						/* proxima recoleccion despues de la fecha inicial */
						$inicial = array('programacion_id'=>$programacionid, 'nuevafecha'=>$proximaFecha->fecha1,'estado'=>1);
						$this->rutasModel->guardarFechasProgramacion($inicial);
						$dataProximaRecoleccion = array('programacion_id'=>$programacionid, 'nuevafecha'=>$proximaFecha->next,'estado'=>1);
						$this->rutasModel->guardarFechasProgramacion($dataProximaRecoleccion);
						$dataProximaRecoleccion2 = array('programacion_id'=>$programacionid, 'nuevafecha'=>$proximaFecha->next2,'estado'=>1);
						$this->rutasModel->guardarFechasProgramacion($dataProximaRecoleccion2);
					}
				}
		}
		$idRuta =filter_input(INPUT_POST,'idRuta');
		$datos =array('nombre'=>filter_input(INPUT_POST,'nombre_ruta'),
					  'direccion'=>filter_input(INPUT_POST,'direccion'),
					  'activo'=>filter_input(INPUT_POST,'estado'),
					  'id_zona'=>filter_input(INPUT_POST,'zona'));
		$resultado = $this->rutasModel->actualizarRuta($idRuta, $datos);
		if($resultado['codeFinal']=1){
			$this->session->set_flashdata('message', 'La Ruta fue editada Correctamente.');
			redirect('rutas/editarRuta/'.$idRuta);
		}else{
			$this->session->set_flashdata('message', $resultado['message']);
			redirect('rutas/editarRuta/'.$idRuta);
		}
		
	}
	
	public function sortParadero($ruta){
		$paraderos = $_POST['idp'];
		$i = 1;
		foreach($paraderos as $k => $v){
			$this->rutasModel->actualizarPosicionParadero($v, $i);
			$i++;
		}
	}
	public function ajax_guardarParadero(){
		$resultado=array();
		if(!$this->rutasModel->chequearParaderoExiste(filter_input(INPUT_POST,'rutacodigo'), filter_input(INPUT_POST,'ordenamiento'))){
			$paraderoInicial = array('nombre'=>filter_input(INPUT_POST,'nombre'),
								 'id_ruta'=>filter_input(INPUT_POST,'rutacodigo'),
								 'lat'=>filter_input(INPUT_POST,'lat'),
								 'lon'=>filter_input(INPUT_POST,'lon'),
								 'direccion'=>filter_input(INPUT_POST,'direccion'),
								 'ordenamiento'=>filter_input(INPUT_POST,'ordenamiento'),
								 'activo'=>TRUE);
			$transaccion = $this->rutasModel->guardarParaderoAjax($paraderoInicial);
			if($transaccion){
				$resultado['result'] = 1;$resultado['codigo'] = 0;
				$resultado['mensaje'] = "El paradero fue guardado Correctamente.";
			}else{
				$resultado['result'] = 0;$resultado['codigo'] = 2;
				$resultado['mensaje'] = "Error al insertar los datos..";
			}
		}else{
			$resultado['result'] = 0;$resultado['codigo'] = 1;
			$resultado['mensaje'] = "El numero de parada que esta solicitando ya existe.";
		}
		echo json_encode($resultado);
	}
	public function ajax_guardarParadero_usuario(){
		$usuario = $this->session->userdata('user_id');
		$idRuta = $this->rutasModel->getRutaUsuario($usuario);
		/* si no existe el paradero crearlo */
		if(!$this->rutasModel->chequearParaderoExisteUsuario($usuario))
		{
			$paraderoInicial = array('nombre'=>filter_input(INPUT_POST,'nombre_paradero'),
								 'lat'=>filter_input(INPUT_POST,'lat'),
								 'lon'=>filter_input(INPUT_POST,'lon'),
								 'direccion'=>filter_input(INPUT_POST,'direccion_paradero'),
								 'id_ruta'=>$idRuta,
								 'usuario_id'=>$usuario,
								 'activo'=>TRUE);
			$transaccion = $this->rutasModel->guardarParaderoAjax($paraderoInicial);
			if($transaccion){
				$resultado['result'] = 1;$resultado['codigo'] = 0;
				$resultado['mensaje'] = "El paradero fue guardado Correctamente.";
			}else{
				$resultado['result'] = 0;$resultado['codigo'] = 2;
				$resultado['mensaje'] = "Error al insertar los datos..";
			}
		}else{
			$paraderoInicial = array('nombre'=>filter_input(INPUT_POST,'nombre_paradero'),
			'lat'=>filter_input(INPUT_POST,'lat'),
			'lon'=>filter_input(INPUT_POST,'lon'),
			'direccion'=>filter_input(INPUT_POST,'direccion_paradero'),
			'id_ruta'=>$idRuta,
			'activo'=>TRUE);
			$this->rutasModel->actualizarParaderoAjax($usuario, $paraderoInicial);
			$resultado['result'] = 0;$resultado['codigo'] = 1;
			$resultado['mensaje'] = "Parada actualizada.";
		}
		/*actualizar datos de direccion */
		$datosDireccionUsuario = array('address'=>filter_input(INPUT_POST,'direccion_paradero'),
									   'address_detail'=>filter_input(INPUT_POST,'informacion_adicional'),
									   'habitantes'=>filter_input(INPUT_POST,'no_habitantes'),
									   'tipo_vivienda'=>filter_input(INPUT_POST,'tipo_vivienda'));
		$this->rutasModel->actualizarDireccionUsuario($usuario, $datosDireccionUsuario);
		echo json_encode($resultado);
	}
}