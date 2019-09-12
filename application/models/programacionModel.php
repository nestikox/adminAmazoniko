  <?php
    /**
     * Created by
     * User: Nestor Castellano
     * Date: 17/04/19
     * Time: 11:10 AM
     * Author: 5mdgroup
     */
    defined('BASEPATH') or exit('No direct script access allowed');
    class ProgramacionModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
					$this->load->database();
        }
        public function guardarProgramacion($data){
            if($this->db->insert('a006_programaciones', $data)){
                $insert_id = $this->db->insert_id();
                return $insert_id;
            }else{
                return 0;
            }
        }
        
        public function guardarNuevaFecha($data){
            if($this->db->insert('a007_programaciones_fecha', $data)){
                return true;
            }else{
                return false;
            }
        }
        
        public function getParaderoUsuario($id){
          $q="select p.*, u.address, u.address_detail, u.habitantes, u.tipo_vivienda from a002_paraderos p
          left join users u on p.usuario_id = u.id where usuario_id = $id;";
          $r =  $this->db->query($q);
          //$n = $r->num_rows();
          //$result =  array();
           // if($n>0){
          return $r->row();
          //    }else{
          //    return false;
           // }
        }
        
        public function getProximasFechas($id){
          /* validaciones */
          $result = array();
          $q ="select pf.*, r.nombre as ruta, z.nombre as zona from a002_paraderos pa
            left join a006_programaciones p on pa.id_ruta = p.ruta
            left join a001_ruta r on p.ruta = r.ida001_ruta
            left join a003_zonas z on r.id_zona = z.id
            left join a007_programaciones_fecha pf on p.id = pf.programacion_id
            left join a007_programacion_usuarios pu on pf.id = pu.programacion_fecha
            where pa.usuario_id = $id and pu.id is null and pf.estado = 1 ;";
          $qr1 = $this->db->query($q);
          $q1n = $qr1->num_rows();
          $q2 ="select pf.*, r.nombre as ruta, z.nombre as zona, pu.* from a002_paraderos pa
            left join a006_programaciones p on pa.id_ruta = p.ruta
            left join a001_ruta r on p.ruta = r.ida001_ruta
            left join a003_zonas z on r.id_zona = z.id
            left join a007_programaciones_fecha pf on p.id = pf.programacion_id
            left join a007_programacion_usuarios pu on pf.id = pu.programacion_fecha
            where pa.usuario_id = $id and pu.id is not null and pf.estado = 1 ;";
          $qr2 = $this->db->query($q2);
          $q2n = $qr2->num_rows();
          $result['proximas']= ($q1n>0?$qr1->result():0);
          $result['r1']= ($q1n>0?1:0);
          $result['programadas']= ($q2n>0?$qr2->result():0);
          $result['r2']= ($q2n>0?1:0);
          return $result;
        }
        public function comprobarParadero($idUsuario){
          $q2 ="select * from a002_paraderos where usuario_id = $idUsuario;";
          $qr2 = $this->db->query($q2);
          $q2n = $qr2->num_rows();
          if($q2n>0){
            return 1;
          }else{
            return 0;
          }
        }
        
        public function getIdRecoleccion($id){
          $q="SELECT id FROM a009_recolecciones where fecha_id=$id;";
          $rq = $this->db->query($q);
          $res = $rq->row();
          return $res->id;
        }
        
        public function registrarUsuarioProgramacion($data){
          if($this->db->insert('a007_programacion_usuarios',$data)){
            return true;
          }else{
            return false;
          }
        }
        public function validarFechaPostulacionUsr($us,$fc){
          $q="SELECT * FROM a007_programacion_usuarios
          where usuario_id=$us and programacion_fecha=$fc and estado=1";
          $rq = $this->db->query($q);
          $n = $rq->num_rows();
          if($n>0){
            return true;
          }else{
            return false;
          }
        }
        
        public function validarFechaRecoleccion($idfc){
          $q="SELECT * FROM a009_recolecciones where fecha_id=$idfc;";
          $rq = $this->db->query($q);
          $n = $rq->num_rows();
          if($n>0){
            return true;
          }else{
            return false;
          }
        }
        
        public function borrarFechaUsuario($id_fecha, $id_usuario){
          $this->db->where('id',$id_fecha);
          $this->db->where('usuario_id',$id_usuario);
          $this->db->delete('a007_programacion_usuarios');
        }
        
        public function getRutaUsuarioMember($id){
          $q="SELECT * FROM amazoniko2.a005_usuario_rutas where usuario_id =$id;";
          $rq = $this->db->query($q);
          return $rq->row();
        }
        
        public function getProgramacionesAdmin(){
          $q ="SELECT pf.*, r.nombre as ruta, z.nombre as zona
              FROM a007_programaciones_fecha pf
              left join a006_programaciones p on p.id = pf.programacion_id
              left join a001_ruta r on p.ruta = r.ida001_ruta
              left join a003_zonas z on r.id_zona = z.id
              where r.nombre is not null
              order by pf.id asc;";
          $rq = $this->db->query($q);
          $progs = $rq->result();
          $arrayS = "";
          $add = "";
          $add = ',"backgroundColor":"#A8DC8F"';
          foreach ($progs as $k =>$fila) {
            $arrayS.= '{"id":"'.$fila->id.'","title":"'.$fila->ruta.'", "start":"'.$fila->nuevafecha.'"'.$add.'},';
          }
          return $arrayS;  
        }
        public function getProgramaciones($user=0, $perfil){
          /*$q="select pf.nuevafecha, concat('Recoleccion en ruta: ',r.nombre ,' / ',ur.first_name,' ',ur.last_name) as info from a006_programaciones p
            left join a007_programaciones_fecha pf on pf.programacion_id = p.id
            left join users ur on ur.id = p.recolector
            left join a001_ruta r on r.ida001_ruta = p.ruta
            where pf.estado =1 ";*/
          /* traer todas las fechas de todas las zonas */
          $q ="SELECT pf.*, r.nombre as ruta, z.nombre as zona, 
              (select count(id) from a007_programacion_usuarios where programacion_fecha = pf.id and usuario_id = $user) as usuario_agenda
              FROM a007_programaciones_fecha pf
              left join a006_programaciones p on p.id = pf.programacion_id
              left join a001_ruta r on p.ruta = r.ida001_ruta
              left join a003_zonas z on r.id_zona = z.id
              where r.nombre is not null
              order by pf.id asc;";
          $rq = $this->db->query($q);
          $progs = $rq->result();
          $arrayS = "";
          $add = "";
          foreach ($progs as $k =>$fila) {
            if($fila->usuario_agenda>0){ $add = ',"backgroundColor":"green"'; }
            else if($fila->estado !=1){
              $add = ',"backgroundColor":"red"';
            }else{$add = ',"backgroundColor":"#222d32"'; }
            $arrayS.= '{"title":"'.$fila->ruta.'", "start":"'.$fila->nuevafecha.'"'.$add.'},';
          }
          return $arrayS;  
        }
        
        public function getProgramacionUsuario(){
          $resultado = array('code'=>1, 'codeText'=>'No se han encontrado programaciones para su usuario.');
          $resultado['result'] = '';
          return $resultado;
        }
        public function actualizarEstadoFecha($id, $dat){
          $this->db->where('id', $id);
          if($this->db->update('a007_programaciones_fecha', $dat)){
            return true;
          }else{
            return false;
          }
        }
        public function asignarUsuariosPostulados($fechaId, $recoleccionId){
          /* obtener los usuarios postulados de la fecha */
          $q="SELECT usuario_id FROM a007_programacion_usuarios where programacion_fecha=$fechaId;";
          $uq = $this->db->query($q);
          $usuarios = $uq->result();
          $contador = 0;
          foreach($usuarios as $k => $v){
            $this->asignarUsuarioRecoleccion($v->usuario_id, $recoleccionId);
            $contador++;
          }
          return $contador;
        }
        
        public function asignarUsuarioRecoleccion($idUsuario, $idRecoleccion){
          $data = array('usuario'=>$idUsuario,'recoleccion'=>$idRecoleccion);
          $this->db->insert('a010_recoleccion_usuarios',$data);
        }
        
        public function getProgramacionFecha($id){
          $q="SELECT pf.*, p.dia, r.nombre FROM a007_programaciones_fecha pf
            left join a006_programaciones p on pf.programacion_id = p.id
            left join a001_ruta r on p.ruta = r.ida001_ruta where pf.id=$id;";
          $qr = $this->db->query($q);
          return $qr->row();
        }
        
        public function guardarRecoleccion($data){
          if($this->db->insert('a009_recolecciones', $data)){
            $insert_id = $this->db->insert_id();
            return $insert_id;
          }else{
              return false;
          }
        }
    }

