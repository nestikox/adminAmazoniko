<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class usuariosModel extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database(); //$this->load->model('actas_model');
    }
    
    public function getUsuariosSistema($id=0){
        if($id!=0):
            $q="SELECT u.*, ug.user_id, ug.group_id, g.name as grupo FROM users u
                left join users_groups ug on ug.user_id=u.id 
                left join groups g on ug.group_id = g.id where u.id=$id;";
            $r =  $this->db->query($q);
            return $r->row();
        else:
            $q ="SELECT * FROM users;";
            $r =  $this->db->query($q);
            return $r->result();
        endif;
	}
    public function actualizarEstado($id, $estado){
        $this->db->where('id',$id);
        if($this->db->update('users', $estado)){
            return true;
        }else{
            return false;
        }
    }
    public function getParaderoUsuario($id_Usuario){
        $q ="select * from a002_paraderos where usuario_id =$id_Usuario";
        $r =  $this->db->query($q);
        $paraderos = $r->result();
        $response = array();
        $resnum = $r->num_rows();
        $retorno="[";
        $i=0;
        if($resnum>0){
            foreach($paraderos as $k=>$v){
                if($i>0){
                    $retorno.= ",['".$v->nombre."',".$v->lat.",".$v->lon.", ".$v->ordenamiento."]";	
                }else{
                    $retorno.= "['".$v->nombre."',".$v->lat.",".$v->lon.", ".$v->ordenamiento."]";	
                }
                $i++;
            }
        }
        $retorno.="]";
        $response['map'] = $retorno;
        $response['result'] = $r->result();
		return $response;
    }
    public function getGrupos(){
        $q ="SELECT * FROM groups;";
		$r =  $this->db->query($q);
		return $r->result();	
    }
    
    public function getGrupoUsuario($id){
        $q ="select g.name from users u
            left join users_groups ug on ug.user_id = u.id
            left join groups g on g.id = ug.group_id 
            where u.id = $id;";
        $r =  $this->db->query($q);
        $result = $r->row();	
		return $result->name;
    }
    public function comprobarRut($r){
        $q ="select id from users where rut =$r;";
		$r =  $this->db->query($q);
        $n = $r->num_rows();
        $result =  array();
        if($n>0){
            return true;
        }else{
            return false;
        }
    }
    public function getUserOld($oldPassword, $id, $type=1){
        $q ="SELECT * FROM amazoniko2.users where email = '$id' and password_old='$oldPassword';";     
        $r =  $this->db->query($q);
        $n = $r->num_rows();
        $result =  array();
        if($type==1){
            return $r->row();
        }else{
            if($n>0){
                return true;
            }else{
                return false;
            }
        }
        
    }
    public function getSessionData($id, $idtipo=1){
        if($idtipo==2){
            $q ="SELECT email, first_name, last_name, company, phone, rut, imagen FROM amazoniko2.users where id='$id';";
        }else{
            $q ="SELECT email, first_name, last_name, company, phone, rut, imagen FROM amazoniko2.users where email='$id';"; 
        }
       $r=$this->db->query($q);
       return $r->row();
    }
    public function checkUserExist($id){
        $q ="SELECT email, first_name, last_name, company, phone, rut, imagen FROM amazoniko2.users where email='$id';";
        $r=$this->db->query($q);
        $check = $r->num_rows();
        if($check>0){
            return true;
        }else{
            return false;
        }
    }
    public function loginMail($email){
        $this->load->model('ion_auth_model');
        $query = $this->db->select('email, id, password, active, last_login')
						  ->where('email', $email)
						  ->limit(1)
						  ->order_by('id', 'desc')
						  ->get('users');                  
        $user = $query->row();
        $this->ion_auth_model->set_session($user);
		$this->ion_auth_model->update_last_login($user->id);
		$this->ion_auth_model->clear_login_attempts($user->id);
    }
    public function check_rutaAsignada($idRuta, $idUsuario){
        $q="select r.ida001_ruta, r.nombre from a005_usuario_rutas ur 
            left join a001_ruta r on r.ida001_ruta = ur.ruta_id
            left join users u on u.id = ur.usuario_id where ur.ruta_id = $idRuta and ur.usuario_id = $idUsuario;";
        $r1=$this->db->query($q);
        $conteo = $r1->num_rows();
        if($conteo>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function getRutasOptions($id){
        $q="select ida001_ruta, nombre from a001_ruta where activo =1;";
        $r1=$this->db->query($q);
        $rutas = $r1->result();
        $resultado = "";
        foreach($rutas as $k=> $v){
               $resultado.="<option value='".$v->ida001_ruta."' ".($this->check_rutaAsignada($v->ida001_ruta,$id)?'selected':'').">".$v->nombre."</option>";
        }
        return $resultado;
    }
    
    public function actualizarParaderoUsuario($id, $ruta){
        $this->db->where('usuario_id', $id);
        $data= array('id_ruta'=>$ruta);
        $this->db->update('a002_paraderos', $data);
    }
    
    public function delUsuarioRutas($idUsuario){
        $this->db->where('usuario_id', $idUsuario);
        $this->db->delete('a005_usuario_rutas');
    }
    
    public function asignarRutas($usuario, $ruta){
        $data = array('usuario_id'=>$usuario, 'ruta_id'=>$ruta);
        $this->db->insert('a005_usuario_rutas',$data);
        $this->actualizarParaderoUsuario($usuario,$ruta);
    }
}