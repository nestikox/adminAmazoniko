  <?php
    /**
     * Created by
     * User: Nestor Castellano
     * Date: 17/04/19
     * Time: 11:10 AM
     * Author: 5mdgroup
     */
    defined('BASEPATH') or exit('No direct script access allowed');
    class SistemaModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
					$this->load->database();
        }
        
        public function guardarUnidad($data){
            if($this->db->insert('a011_unidades', $data)){$insert_id = $this->db->insert_id();return true;}else{return false;}
        }

        public function cambiarEstadoUnidad($id, $data){
            $this->db->where('id', $id);$this->db->update('a011_unidades', $data);
        }

        public function getUnidad($id){
            $q="SELECT * FROM amazoniko2.a011_unidades where id=$id;";
            $r=$this->db->query($q);
            return $r->result();
        }
        
        public function actualizarUnidad($id, $data){
            $this->db->where('id', $id);
            if($this->db->update('a011_unidades', $data)){ return true; }else{return false;}
        }
        
        public function getDashboard($type, $user=0){
          switch($type){
            case 'admin':
                $q="select 
                  (select count(id) from users where active = 1) as usuarios, 
                  (select count(ida001_ruta) from a001_ruta where activo = 1) as rutas,
                  (select count(id) from a007_programacion_usuarios where estado = 1) as programaciones;";
                $qr = $this->db->query($q);
                return $qr->row(); 
              break;
            case 'members':
              $q="select
              (select puntos from users where id=".$user.") as puntos,
              (select sum(peso_a) from a010_recoleccion_data where usuario_id =".$user." and estado=4) as plastico,
              (select sum(peso_b) from a010_recoleccion_data where usuario_id =".$user." and estado=4) as reciclado ";
              $qr = $this->db->query($q);
              return $qr->row(); 
            break;
            case 'recolector':
              break;
          }
          } 
        /*actualizacion de usuarios
        public function getUsuarios(){
          $q="select * from usuarios ;";
          $qr = $this->db->query($q);
          return $qr->result();
        }
        public function asignarGrupo($id, $grupo){
            $data = array('user_id'=>$id, 'group_id'=>$grupo);
            $this->db->insert('users_groups', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
        public function insertarUsuario($data){
            $this->db->insert('users', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
        public function asignarParadero($data){
            $this->db->insert('a002_paraderos', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }*/
    }

