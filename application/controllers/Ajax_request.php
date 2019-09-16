<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ajaxRequestModel');
		$this->load->helper('url');
    }
    public function getHistorial($idUser=0){
        $request = $_REQUEST;/*pedidos de datatable*/
        $data = array();
        $recolector = $_GET['r'];
        if($recolector==1){$t = 'recolector_id';}else{$t = 'usuario_id';}
        /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
        $q = "SELECT * FROM amazoniko2.a010_recoleccion_data where ".$t."=$idUser ";
        $totalData=$this->ajaxRequestModel->request_conteo($q);
        /* si existe una busqueda agregar los campos para filtrar resultados */
        /* AREA DE FILTROS */
        if(!empty($request['search']['value'])){
            $q.=" and (time like '".$request['search']['value']."%' ";
            $q.=" or calificacion like '".$request['search']['value']."%' ) ";
        }
        /* PAGINACION */
        $q.="order by time asc limit ".$request['start'].",".$request['length']." ";
        $rs = $this->ajaxRequestModel->request($q);
        $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
    /* Ordenar los resultados para ser procesados */
    foreach($rs as $k=>$r){
        $subdata = array();
        $subdata[] = $r->bolsa_a;
        $subdata[] = $r->bolsa_a;
        $subdata[] = $r->peso_a;
        $subdata[] = $r->peso_b;
        $subdata[] = $r->calificacion;
        $subdata[] = $r->puntos;
        $subdata[] = $r->time;
        $data[] = $subdata;
    }
            
    $results = array(
    "draw"              => intval($request['draw']),
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalData),
    "data"=>$data);
    $response = json_encode($results);
    echo $response;/* for some reason i have to kill the process in this case or it will redirect so it wont work */
    //die($this->output->set_content_type('application/json')->set_output());
        
    }
    public function pag_unidades(){
        $request = $_REQUEST;/*pedidos de datatable*/
        $data = array();
        /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
        $q = "SELECT * FROM amazoniko2.a011_unidades where 1=1";
        $totalData=$this->ajaxRequestModel->request_conteo($q);
        /* si existe una busqueda agregar los campos para filtrar resultados */
        /* AREA DE FILTROS */
        if(!empty($request['search']['value'])){
            $q.=" and (nombre like '".$request['search']['value']."%' ";
            $q.=" or id like '".$request['search']['value']."%' ) ";
        }
        /* PAGINACION */
        $q.=" limit ".$request['start'].",".$request['length']." ";
        $rs = $this->ajaxRequestModel->request($q);
        $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
    /* Ordenar los resultados para ser procesados */
    foreach($rs as $k=>$r){
        $subdata = array();
        $subdata[] = $r->id;
        $subdata[] = $r->nombre;
        /* OPCIONES MAS LARGO */
        $edicionEstadoUrl = site_url('sistema/cambiarEstadoUnidad?id='.$r->id.'&estado='.$r->activo);
        $estado = ($r->activo==0?'<a href="'.$edicionEstadoUrl.'"><i class="fa fa-circle" title="Inactivo" style="color:red;"></i></a>':'<a href="'.$edicionEstadoUrl.'"><i class="fa fa-circle" title="Activo" style="color:green;"></i></a>');
        $edicionUsuarioUrl = site_url('sistema/editarUnidad/'.$r->id);
        $subdata[] = '<a href="'.$edicionUsuarioUrl.'" ><i class="fa fa-edit"> Editar</i></a> &nbsp;'.$estado;
        /* FIN DE OPCIONES */
        $data[] = $subdata;
    }
            
    $results = array(
    "draw"              => intval($request['draw']),
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalData),
    "data"=>$data);
    $response = json_encode($results);
    echo $response;/* for some reason i have to kill the process in this case or it will redirect so it wont work */
    //die($this->output->set_content_type('application/json')->set_output());
    }
    
    public function pag_usuarios(){
       $request = $_REQUEST;/*pedidos de datatable*/
            $data = array();
            /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
            $q = "SELECT g.name as tipousuario,u.*  FROM users u
                left join users_groups ug on ug.user_id = u.id
                left join groups g on g.id = ug.group_id where 1=1";
            $totalData=$this->ajaxRequestModel->request_conteo($q);
            /* si existe una busqueda agregar los campos para filtrar resultados */
            /* AREA DE FILTROS */
            if(!empty($request['search']['value'])){
                $q.=" and (first_name like '".$request['search']['value']."%' ";
                $q.=" or email like '".$request['search']['value']."%' ";
                $q.=" or company like '".$request['search']['value']."%' ) ";
            }
            /* PAGINACION */
            $q.=" limit ".$request['start'].",".$request['length']." ";
            $rs = $this->ajaxRequestModel->request($q);
            $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
        /* Ordenar los resultados para ser procesados */
        foreach($rs as $k=>$r){
            $subdata = array();
            $subdata[] = $r->id;
            $subdata[] = $r->first_name." ".$r->last_name;
            $subdata[] = $r->phone;
            $subdata[] = $r->email;
            $subdata[] = $r->tipousuario;
            $subdata[] = number_format($r->puntos, 0, ',', '.');;
            /* OPCIONES MAS LARGO
             $detalleUsuarioUrl = site_url('usuarios/verUsuario/'.$r->id);<a href="'.$detalleUsuarioUrl.'" ><i class="fa fa-eye"> Ver</i></a>&nbsp;
            */
            $estado = ($r->active==0?'<i class="fa fa-circle" title="Inactivo" style="color:red;"></i>':'<i class="fa fa-circle" title="Activo" style="color:green;"></i>');
            $edicionUsuarioUrl = site_url('usuarios/editarUsuario/'.$r->id);
           
            $subdata[] = '<a href="'.$edicionUsuarioUrl.'" ><i class="fa fa-edit"> Editar</i></a>  '.$estado;
            /* FIN DE OPCIONES */
            $data[] = $subdata;
        }
                
        $results = array(
        "draw"              => intval($request['draw']),
        "recordsTotal"      => intval($totalData),
        "recordsFiltered"   => intval($totalData),
        "data"=>$data);
        $response = json_encode($results);
        echo $response;/* for some reason i have to kill the process in this case or it will redirect so it wont work */
        //die($this->output->set_content_type('application/json')->set_output());
    }

    public function pag_zonas(){
        $request = $_REQUEST;/*pedidos de datatable*/
             $data = array();
             /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
             $q = "SELECT * FROM a003_zonas where 1=1";
             $totalData=$this->ajaxRequestModel->request_conteo($q);
             /* si existe una busqueda agregar los campos para filtrar resultados */
             /* AREA DE FILTROS */
             if(!empty($request['search']['value'])){
                 $q.=" and (nombre like '".$request['search']['value']."%' ";
                 $q.=" or descripcion like '".$request['search']['value']."%' ";
                 $q.=" or direccion like '".$request['search']['value']."%' ) ";
             }
             /* PAGINACION */
             $q.=" limit ".$request['start'].",".$request['length']." ";
             $rs = $this->ajaxRequestModel->request($q);
             $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
         /* Ordenar los resultados para ser procesados */
         foreach($rs as $k=>$r){
             $subdata = array();
             $subdata[] = $r->id;
             $subdata[] = $r->nombre;
             $subdata[] = $r->delimitacion;
             $subdata[] = $r->direccion;
			 $subdata[] = "<input type='color' value='".$r->color."' disabled>";
             /* OPCIONES MAS LARGO */
             $estado = ($r->activo==0?'<i class="fa fa-circle" title="Inactivo" style="color:red;"></i>':'<i class="fa fa-circle" title="Activo" style="color:green;"></i>');
             /* URLS DE EDICION */
             $edicionUrl = site_url('rutas/editarZona/'.$r->id);
             /* OPCIONES*/
             $subdata[] = '<a href="'.$edicionUrl.'" ><i class="fa fa-edit"> Editar</i></a>
                           &nbsp;
                           '.$estado;
             /* FIN DE OPCIONES */
             $data[] = $subdata;
         }
                 
         $results = array(
         "draw"              => intval($request['draw']),
         "recordsTotal"      => intval($totalData),
         "recordsFiltered"   => intval($totalData),
         "data"=>$data);
         $response = json_encode($results);
         echo $response; die(); /* for some reason i have to kill the process in this case or it will redirect so it wont work */
         //die($this->output->set_content_type('application/json')->set_output());
     }

     public function pag_rutas(){
        $request = $_REQUEST;/*pedidos de datatable*/
             $data = array();
             /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
             $q = "SELECT *, (select count(id) from a005_usuario_rutas where ruta_id = a001_ruta.ida001_ruta) as paraderos FROM a001_ruta where 1=1";
             $totalData=$this->ajaxRequestModel->request_conteo($q);
             /* si existe una busqueda agregar los campos para filtrar resultados */
             /* AREA DE FILTROS */
             if(!empty($request['search']['value'])){
                 $q.=" and (nombre like '".$request['search']['value']."%' ";
                 $q.=" or direccion like '".$request['search']['value']."%' ";
                 $q.=" or ida001_ruta like '".$request['search']['value']."%' ) ";
             }
             /* PAGINACION */
             $q.=" limit ".$request['start'].",".$request['length']." ";
             $rs = $this->ajaxRequestModel->request($q);
             $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
         /* Ordenar los resultados para ser procesados */
         foreach($rs as $k=>$r){
             $subdata = array();
             $subdata[] = $r->ida001_ruta." <input type='radio' name='selectedF' value='".$r->ida001_ruta."'>";
             $subdata[] = $r->nombre;
             $subdata[] = $r->paraderos;
             /* OPCIONES MAS LARGO */
             $estado = ($r->activo==0?'<i class="fa fa-circle" title="Inactivo" style="color:red;"></i>':'<i class="fa fa-circle" title="Activo" style="color:green;"></i>');
             /* URLS DE EDICION */
             $edicionUrl = site_url('rutas/editarRuta/'.$r->ida001_ruta);
             /* OPCIONES*/
             $subdata[] = '<a href="'.$edicionUrl.'" ><i class="fa fa-edit"> Editar</i></a>
                           &nbsp;
                           '.$estado;
             /* FIN DE OPCIONES */
             $data[] = $subdata;
         }
                 
         $results = array(
         "draw"              => intval($request['draw']),
         "recordsTotal"      => intval($totalData),
         "recordsFiltered"   => intval($totalData),
         "data"=>$data);
         $response = json_encode($results);
         echo $response; die(); /* for some reason i have to kill the process in this case or it will redirect so it wont work */
         //die($this->output->set_content_type('application/json')->set_output());
     }
	public function pag_historial(){
		 $request = $_REQUEST;/*pedidos de datatable*/
             $data = array();
             /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
             $q = "SELECT r.*, concat(ua.first_name,' ',ua.last_name) as usuarioa, concat(ur.first_name,' ',ur.last_name) as recolector 
					FROM amazoniko2.recoleccion r
					left join amazoniko2.users ua on id_usuario = ua.id
					left join amazoniko2.users ur on id_recolector = ur.id where 1=1";
             $totalData=$this->ajaxRequestModel->request_conteo($q);
             /* si existe una busqueda agregar los campos para filtrar resultados */
             /* AREA DE FILTROS */
             if(!empty($request['search']['value'])){
                 $q.=" and (usuarioa like '".$request['search']['value']."%' ";
                 $q.=" or recolector like '".$request['search']['value']."%' ";
                 $q.=" or r.fecha_solicitud like '".$request['search']['value']."%' ) ";
             }
             /* PAGINACION */
             $q.=" limit ".$request['start'].",".$request['length']." ";
             $rs = $this->ajaxRequestModel->request($q);
             $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
         /* Ordenar los resultados para ser procesados */
         foreach($rs as $k=>$r){
             $subdata = array();
             $subdata[] = $r->id;
             $subdata[] = $r->usuarioa;
             $subdata[] = $r->recolector;
			 $subdata[] = $r->fecha_solicitud;
             /* OPCIONES MAS LARGO */
             $estado = ($r->estado==0?'<i class="fa fa-circle" title="Inactivo" style="color:red;"></i>':'<i class="fa fa-circle" title="Activo" style="color:green;"></i>');
             /* URLS DE EDICION */
             $edicionUrl = site_url('rutas/editarRuta/'.$r->ida001_ruta);
             /* OPCIONES*/
             $subdata[] = '<a href="'.$edicionUrl.'" ><i class="fa fa-edit"> Editar</i></a>
                           &nbsp;
                           '.$estado;
             /* FIN DE OPCIONES */
             $data[] = $subdata;
         }
                 
         $results = array(
         "draw"              => intval($request['draw']),
         "recordsTotal"      => intval($totalData),
         "recordsFiltered"   => intval($totalData),
         "data"=>$data);
         $response = json_encode($results);
         echo $response; die(); /* for some reason i have to kill the process in this case or it will redirect so it wont work */
         //die($this->output->set_content_type('application/json')->set_output());
	}
    public function finalizarRecoleccion($id){
        $this->load->model('programacionModel');
        /* cambiar el estado a finalizada */
        $this->programacionModel->cambiarEstadoRecoleccion($id, 4);
        $r = array();
        $r['c']=1;
        $r['url']=site_url('programaciones/recolectores');
        echo json_encode($r);
    }
    public function getParaderosRecoleccion($idr=0){
        $this->load->model('programacionModel');
        $idRecoleccion=0;
        if(isset($_POST['idruta']) and $_POST['idruta']>0){
            $idRecoleccion=$_POST['idruta'];
        }elseif(isset($idr) and $idr>0){
            $idRecoleccion=$idr;
        }
        $res =  array();
        if($idRecoleccion>0){
            /* obtener los paraderos de la recoleccion */
            $paraderos = $this->programacionModel->getParaderosRecoleccion($idRecoleccion);   
            if($paraderos['n']>0){
                $poptions ="<option value=''> Seleccione Paradero...</option>";
                foreach($paraderos['r'] as $k=>$v){
                    $poptions.="<option value='".$v->usuario."'>".$v->direccion." ".$v->tipo_vivienda."/".$v->nombre_vivienda." ".$v->address_detail."</option>";
                }
                $res['code'] = 1;
                $res['m'] = 'Peticion procesada.';
                $res['d'] = $poptions;
                echo json_encode($res);
            }else{
                $res['code'] = 2;
                $res['m'] = 'Finalizaron los Paraderos.';
                $res['d'] = '<option value="">No existen mas paraderos pendientes...</option>';
                echo json_encode($res);
            }
        }else{
            $res['code'] = 0;
            $res['m'] = 'No se ha enviado recoleccion.';
            echo json_encode($res);
        }
    }
    
    public function pag_rutas_usuarios(){
        $request = $_REQUEST;/*pedidos de datatable*/
        $data = array();
        /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
        $q = "SELECT u.* FROM users u left join users_groups ug on u.id = ug.user_id where group_id in (2,3) ";
        $totalData=$this->ajaxRequestModel->request_conteo($q);
        /* si existe una busqueda agregar los campos para filtrar resultados */
        /* AREA DE FILTROS */
            if(!empty($request['search']['value'])){
                $q.=" and (u.first_name like '".$request['search']['value']."%' ";
                $q.=" or u.email like '".$request['search']['value']."%' ";
                $q.=" or u.company like '".$request['search']['value']."%' ) ";
            }
            /* PAGINACION */
            $q.=" limit ".$request['start'].",".$request['length']." ";
            $rs = $this->ajaxRequestModel->request($q);
            $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
            $rutas = "";
        /* Ordenar los resultados para ser procesados */
        foreach($rs as $k=>$r){
            $subdata = array();
            $subdata[] = $r->id;
            $subdata[] = $r->first_name." ".$r->last_name;
            $subdata[] = $r->email;
            /* obtener las rutas del usuarios */
            $rutas = $this->ajaxRequestModel->getUsuarioRutasConcat($r->id);
            $subdata[] = strlen($rutas)>3?$rutas:'No tiene Rutas asignadas...';
            /* OPCIONES MAS LARGO */
            $edicionUsuarioUrl = site_url('usuarios/editarRutaUsuarios/'.$r->id);
            $subdata[] = '<a href="'.$edicionUsuarioUrl.'" ><i class="fa fa-edit"> Editar</i></a>';
            /* FIN DE OPCIONES */
            $data[] = $subdata;
        }
                
        $results = array(
        "draw"              => intval($request['draw']),
        "recordsTotal"      => intval($totalData),
        "recordsFiltered"   => intval($totalData),
        "data"=>$data);
        $response = json_encode($results);
        echo $response;/* for some reason i have to kill the process in this case or it will redirect so it wont work */
        //die($this->output->set_content_type('application/json')->set_output());
    }
    public function pag_programaciones(){
        
        $request = $_REQUEST;/*pedidos de datatable*/
            $data = array();
            /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
            $q = "SELECT p.id, concat(uc.first_name,' ',uc.last_name) as creador, z.nombre as zona, r.nombre as ruta, concat(ur.first_name,' ',ur.last_name) as recolector, pf.nuevafecha as proximaProgamacion FROM amazoniko2.a006_programaciones p
                left join a007_programaciones_fecha pf on p.id = pf.programacion_id
                left join a003_zonas z on p.zona = z.id
                left join a001_ruta r on p.ruta = r.ida001_ruta
                left join users ur on p.recolector = ur.id
                left join users uc on p.user_id = uc.id where 1=1";
            $totalData=$this->ajaxRequestModel->request_conteo($q);
            /* si existe una busqueda agregar los campos para filtrar resultados */
            /* AREA DE FILTROS */
            if(!empty($request['search']['value'])){
                $q.=" and (uc.first_name like '".$request['search']['value']."%' ";
                $q.=" or ur.first_name like '".$request['search']['value']."%' ";
                $q.=" or r.name like '".$request['search']['value']."%' ";
                $q.=" or z.name like '".$request['search']['value']."%' ) ";
            }
            /* PAGINACION */
            $q.=" limit ".$request['start'].",".$request['length']." ";
            $rs = $this->ajaxRequestModel->request($q);
            $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
            $rutas = "";
        /* Ordenar los resultados para ser procesados */
        foreach($rs as $k=>$r){
            $subdata = array();
            $subdata[] = $r->id;
            $subdata[] = $r->creador;
            $subdata[] = $r->zona;
            $subdata[] = $r->ruta;
            $subdata[] = $r->recolector;
            $subdata[] = $r->proximaProgamacion;
            /* OPCIONES MAS LARGO */
            $edicionUsuarioUrl = site_url('programacion/editarProgramacion/'.$r->id);
            $subdata[] = '<a href="'.$edicionUsuarioUrl.'" ><i class="fa fa-edit"></i></a>';
            /* FIN DE OPCIONES */
            $data[] = $subdata;
        }
                
        $results = array(
        "draw"              => intval($request['draw']),
        "recordsTotal"      => intval($totalData),
        "recordsFiltered"   => intval($totalData),
        "data"=>$data);
        $response = json_encode($results);
        echo $response;/* for some reason i have to kill the process in this case or it will redirect so it wont work */
        //die($this->output->set_content_type('application/json')->set_output());
    }
    
    public function getRutasPorZona(){
        $this->load->model('rutasModel');
        $r = array();
        $r['result'] = $this->rutasModel->getRutasPorZona($_POST['zona']);
        echo json_encode($r);
    }
    public function getRecolectoresPorRuta(){
        $this->load->model('rutasModel');
        $r = $this->rutasModel->getRecolectorPorRuta($_POST['ruta']);
        echo json_encode($r);
    }
    public function getRecoleccionFc(){
        $this->load->model('programacionModel');
        $r = $this->programacionModel->getProgramacionFecha($_POST['programacion_fecha']);
        echo json_encode($r);
    }
    
    public function pag_rRecolecciones($idUsuario=0){
        $request = $_REQUEST;/*pedidos de datatable*/
        $data = array();
        /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
        $q = "SELECT d.id as idRecoleccion,d.estado as estadoCodigo,d.*,f.nombre as estadoRecoleccion, c.*, e.nombre, d.id as idRecoleccion FROM a005_usuario_rutas a
            left join a001_ruta e on a.ruta_id = e.ida001_ruta
            left join a006_programaciones b on a.ruta_id = b.ruta
            left join a007_programaciones_fecha c on c.programacion_id = b.id
            left join a009_recolecciones d on d.fecha_id = c.id
            left join a010_recoleccion_estado f on d.estado = f.id
            where a.usuario_id =$idUsuario and d.id is not null and c.nuevafecha BETWEEN DATE_ADD(current_date(), INTERVAL -50 DAY) AND DATE_ADD(current_date(), INTERVAL 16 DAY) ";
        $totalData=$this->ajaxRequestModel->request_conteo($q);
        /* si existe una busqueda agregar los campos para filtrar resultados */
        /* AREA DE FILTROS */
        if(!empty($request['search']['value'])){
            $q.=" and (d.id like '".$request['search']['value']."%')";
        }
        /* PAGINACION */
        $q.=" order by nuevafecha desc limit ".$request['start'].",".$request['length']." ";
        $rs = $this->ajaxRequestModel->request($q);
        $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
        $rutas = "";
        /* Ordenar los resultados para ser procesados */
        foreach($rs as $k=>$r){
            $subdata = array();
            $subdata[] = $r->idRecoleccion;
            $subdata[] = $r->programacion_id;
            $subdata[] = $r->nuevafecha;
            $subdata[] = $r->nombre;
            $subdata[] = $r->estadoRecoleccion;
            /* OPCIONES MAS LARGO */
            $opciones = $this->filterOptionEstado($r->estadoCodigo, $r);
            /*$edicionUsuarioUrl = site_url('programacion/editarProgramacion/'.$r->id);*/
            $subdata[] = $opciones;
            /* FIN DE OPCIONES */
            $data[] = $subdata;
        }
                
        $results = array(
        "draw"              => intval($request['draw']),
        "recordsTotal"      => intval($totalData),
        "recordsFiltered"   => intval($totalData),
        "data"=>$data);
        $response = json_encode($results);
        echo $response;/* for some reason i have to kill the process in this case or it will redirect so it wont work */
        //die($this->output->set_content_type('application/json')->set_output());
    }
    
    public function guardarRecoleccion($id){
        $this->load->model('programacionModel');
        /* datos de la recoleccion */
        $data = array(
          'recoleccion_id' => $id,
          'usuario_id' => $_POST['paradero'],
          'recolector_id' => $_POST['recolector'],
          'estado' =>1,
          'bolsa_a' =>$_POST['bolsaa'],
          'bolsa_b' =>$_POST['bolsab'],
          'peso_a' =>$_POST['pesoa'],
          'peso_b' =>$_POST['pesob'],
          'calificacion'=>$_POST['stars'],
          'puntos' =>$_POST['puntos'] 
        );
        $result = array();
        $rec= $this->programacionModel->guardarRecoleccionData($data);
        if($rec>0){
            $result['c']=$rec;
            $result['m']='Recoleccion procesada.';
            echo json_encode($result);
        }else{
            $result['c']=0;
            $result['m']='No se pudo guardar la Recoleccion.';
            echo json_encode($result);
        }
    }
    
    public function pagRecoleccionLive($idR){
        $request = $_REQUEST;/*pedidos de datatable*/
        $data = array();
        /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
        $q = "SELECT rd.*,concat(u.tipo_vivienda,'/',pa.nombre,'-',u.address_detail) as ubicacion FROM a010_recoleccion_data rd
            left join a002_paraderos pa on pa.usuario_id = rd.usuario_id
            left join users u on pa.usuario_id = u.id
            where recoleccion_id=$idR ";
        $totalData=$this->ajaxRequestModel->request_conteo($q);
        /* AREA DE FILTROS */
        if(!empty($request['search']['value'])){
            $q.=" and (d.id usuario_id '".$request['search']['value']."%')";
        }
        /* PAGINACION */
        $q.=" limit ".$request['start'].",".$request['length']." ";
        $rs = $this->ajaxRequestModel->request($q);
        $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
        $rutas = "";
        /* Ordenar los resultados para ser procesados */
        foreach($rs as $k=>$r){
            $subdata = array();
            $subdata[] = $r->bolsa_a;
            $subdata[] = $r->bolsa_b;
            $subdata[] = $r->peso_a;
            $subdata[] = $r->peso_b;
            $subdata[] = $r->calificacion;
            $subdata[] = $r->puntos;
            $subdata[] = $r->ubicacion;
            /* OPCIONES MAS LARGO */
            //$opciones = $this->filterOptionEstado($r->estadoCodigo, $r);
            /*$edicionUsuarioUrl = site_url('programacion/editarProgramacion/'.$r->id);*/
            $subdata[] = 'opciones';
            /* FIN DE OPCIONES */
            $data[] = $subdata;
        }           
        $results = array("draw"=> intval($request['draw']),"recordsTotal"=> intval($totalData),"recordsFiltered"=> intval($totalData),"data"=>$data);$response = json_encode($results);
        echo $response;
    }
    public function filterOptionEstado($estado, $r){
        switch($estado){
            case 1:
                $op = '<a href="#" onClick="iniciarRecoleccion(\''.$r->idRecoleccion.'\',\''.$r->nuevafecha.'\')" ><i class="fa fa-clock-o"></i> <i class="fa fa-truck"> Iniciar recoleccion</i></a>';
                return $op;
            break;
            case 2:
                $op = '<a href="'.site_url('programaciones/recolectar/'.$r->idRecoleccion).'"><i class="fa fa-truck"> Ir a recoleccion</i></a>';
                return $op;
            break;
            case 3:
                $op = '<i class="fa fa-minus-circle faCancelada" title="Recoleccion Cancelada"></i>';
                return $op;
            break;
            case 4:
                $op = '<i class="fa fa-calendar-check-o faFinalizada" title="Recoleccion Finalizada !"></i>';
                return $op;
            break;
            case 5:
                 $op = '<i class="fa fa-clock-o faVence" title="Recoleccion Finalizada-Vencida"></i>';
                return $op;
            break;
        }
    }
    
    public function postularRecoleccion(){
        $this->load->model('programacionModel');
        $idu = $_POST['usuario'];
        $idFecha = $_POST['fechaId'];
		$data = array('programacion_fecha'=>$idFecha,'usuario_id'=>$idu,'estado'=>1);
        /* validar si ya tiene una postulacion en la fecha */
        $postulado = $this->programacionModel->validarFechaPostulacionUsr($idu, $idFecha);
        /* si no esta postulado */
        if(!$postulado){
            /* verificar si la fecha tiene recoleccion si es asi asignar a recoleccion si no postular */
            $recoleccion = $this->programacionModel->validarFechaRecoleccion($idFecha);
            /* validar si la fecha tiene recoleccion */
            /* segun validacion 2 crear postulacion o asignar a recoleccion */
            if(!$recoleccion){
                /* asignar a postulacion */
                $this->programacionModel->registrarUsuarioProgramacion($data);
                echo json_encode(array('result'=>1, 'm'=>'Se ha postulado a la fecha de recoleccion'));
            }else{
                /* asignar a recoleccion */
                $idRecoleccion = $this->programacionModel->getIdRecoleccion($idFecha);
                $this->programacionModel->asignarUsuarioRecoleccion($idu, $idRecoleccion);
                echo json_encode(array('result'=>1, 'm'=>'Se ha asignado a la fecha de recoleccion'));
            }
        }else{
              echo json_encode(array('result'=>0, 'm'=>'Ya existe una postulacion a la fecha seleccionada'));
        }   
    }
    
    public function crearNuevaRecoleccion(){
        $result=array();
        /* cargamos el modelo de programacion */
        $this->load->model('programacionModel');
        /*recoleccion fechaid = id de fecha de programacion, estado = creada(1)*/
        $rec = array('fecha_id'=>$_POST['fechaid'], 'estado'=>1);
        $rec_in = $this->programacionModel->guardarRecoleccion($rec);
        /* actualizacion de el estado de la fecha */
        if($rec_in!=false){
            /* asignar los usuarios postulados */
            $this->programacionModel->asignarUsuariosPostulados($_POST['fechaid'], $rec_in);
            /*cambiar el estado de la fecha*/
            $fcestado = array('estado'=>3);
            $this->programacionModel->actualizarEstadoFecha($_POST['fechaid'],$fcestado);
            
            echo json_encode(array('estado'=>1, 'm'=>'Recoleccion creada'));
            }else{
            echo json_encode(array('estado'=>0, 'm'=>'No se pudo Crear la Recoleccion.'));
        }
    }
    public function get_fechas_programacion(){
        $request = $_REQUEST;/*pedidos de datatable*/
        $data = array();
        /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
        $q = "select pf.*, p.dia, r.nombre as ruta,
            (select count(id) FROM a007_programacion_usuarios where programacion_fecha=pf.id) as usuarios,
            case when pf.estado=1 then 'Programada' when pf.estado=2 then 'Vencida' when pf.estado=3 then 'Recoleccion Generada' when pf.estado=4 then 'Recoleccion Finalizada' end as estado_programacion
            from a007_programaciones_fecha pf
            left join a006_programaciones p on pf.programacion_id = p.id
            left join a001_ruta r on p.ruta = r.ida001_ruta
            where r.activo =1  ";
        $totalData=$this->ajaxRequestModel->request_conteo($q);
        /* si existe una busqueda agregar los campos para filtrar resultados */
        /* AREA DE FILTROS */
        if(!empty($request['search']['value'])){
            $q.=" and (r.nombre like '".$request['search']['value']."%' ";
            $q.=" or p.id like '".$request['search']['value']."%' ) ";
        }
        /* PAGINACION */
        $q.=" order by pf.estado asc, nuevafecha desc limit ".$request['start'].",".$request['length']." ";
        $rs = $this->ajaxRequestModel->request($q);
        $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
    /* Ordenar los resultados para ser procesados */
    foreach($rs as $k=>$r){
        $subdata = array();
        $subdata[] = $r->id;
        $subdata[] = $r->ruta;
        $subdata[] = $r->dia;
        $subdata[] = $r->nuevafecha;
        $subdata[] = $r->estado_programacion;
        $subdata[] = $r->usuarios;     
        /* OPCIONES MAS LARGO */
            $estado = (($r->estado==2 or $r->estado==3)?'<i class="fa fa-circle" title="Vencida o procesada" style="color:red;"></i>':'<i class="fa fa-circle" tsitle="Activo" style="color:green;"></i>');
        $recoleccionOpt = '<a href="#" onclick="crearRecoleccion('.$r->id.')">Crear Recoleccion <i class="fa fa-truck" aria-hidden="true"></i></a>';
        $subdata[] = ($r->estado==1?$recoleccionOpt:'&nbsp;&nbsp;').'&nbsp;&nbsp;'.$estado;
        /* FIN DE OPCIONES <a href="'.$edicionUsuarioUrl.'" ><i class="fa fa-edit"> Editar</i></a> <a href="'.$edicionEstadoUrl.'"></a><a href="'.$edicionEstadoUrl.'"></a> $edicionUsuarioUrl = site_url('sistema/editarUnidad/'.$r->id);*/
        $data[] = $subdata;
    }
            
    $results = array(
    "draw"              => intval($request['draw']),
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalData),
    "data"=>$data);
    $response = json_encode($results);
    echo $response;/* for some reason i have to kill the process in this case or it will redirect so it wont work */
    //die($this->output->set_content_type('application/json')->set_output());
    }
    
    public function get_recolecciones(){
        $request = $_REQUEST;/*pedidos de datatable*/
        $data = array();
        /* AREA DE ARMADO DE LOS QUERYS DE CONSULTA */
        $q = "select r.*, pf.nuevafecha, 
            (select count(usuario) from a010_recoleccion_usuarios where recoleccion = r.id ) as usuarios,
            re.nombre as estado_nombre from a009_recolecciones r
            left join a007_programaciones_fecha pf on pf.id = r.fecha_id
            left join a010_recoleccion_estado re on re.id = r.estado
            where pf.nuevafecha is not null ";
        $totalData=$this->ajaxRequestModel->request_conteo($q);
        /* si existe una busqueda agregar los campos para filtrar resultados */
        /* AREA DE FILTROS */
        if(!empty($request['search']['value'])){
            $q.=" and (nuevafecha like '".$request['search']['value']."%' ";
            $q.=" or r.fecha_id like '".$request['search']['value']."%' ) ";
        }
        /* PAGINACION */
        $q.="order by nuevafecha limit ".$request['start'].",".$request['length']." ";
        $rs = $this->ajaxRequestModel->request($q);
        $totalFiltered=$this->ajaxRequestModel->request_conteo($q);
    /* Ordenar los resultados para ser procesados */
    foreach($rs as $k=>$r){
        $subdata = array();
        $subdata[] = $r->id;
        $subdata[] = $r->nuevafecha;
        $subdata[] = $r->usuarios;
        $subdata[] = $r->estado_nombre;
        /* OPCIONES MAS LARGO */
        $estado = (($r->estado==2 or $r->estado==3)?'<i class="fa fa-circle" title="Vencida o procesada" style="color:red;"></i>':'<i class="fa fa-circle" tsitle="Activo" style="color:green;"></i>');
        $recoleccionOpt = '<a href="#" onclick="editarRecoleccion(\''.$r->id.'\')">Editar <i class="fa fa-edit" aria-hidden="true"></i></a>';
        $subdata[] = $recoleccionOpt; //($r->estado==1?$recoleccionOpt:'&nbsp;&nbsp;').'&nbsp;&nbsp;'.$estado;
        /* FIN DE OPCIONES <a href="'.$edicionUsuarioUrl.'" ><i class="fa fa-edit"> Editar</i></a> <a href="'.$edicionEstadoUrl.'"></a><a href="'.$edicionEstadoUrl.'"></a> $edicionUsuarioUrl = site_url('sistema/editarUnidad/'.$r->id);*/
        $data[] = $subdata;
    }
            
    $results = array(
    "draw"              => intval($request['draw']),
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalData),
    "data"=>$data);
    $response = json_encode($results);
    echo $response;/* for some reason i have to kill the process in this case or it will redirect so it wont work */
    //die($this->output->set_content_type('application/json')->set_output());
    }
    
    public function getProgramacionesUsuario(){
        $this->load->model('usuariosModel');
        $this->load->model('programacionModel');
        if(isset($_POST['usuario']) and $_POST['usuario']>0){
            $perfil = $this->usuariosModel->getGrupoUsuario($_POST['usuario']);
            $prog = $this->programacionModel->getProgramaciones($_POST['usuario'], $perfil);
            echo $prog;
        }else{
            echo json_encode(array('title'=>'', 'start'=>''));
        }
    }
    public function getProgramacionesAdmin(){
        $this->load->model('usuariosModel');
        $this->load->model('programacionModel');
        $perfil = 'admin';
        $prog = $this->programacionModel->getProgramacionesAdmin();
        echo $prog;
    }
    
    public function vcZona(){
  
    }
    public function crearRuta(){
   
    }
     public function crearZona(){
     
    }
}
