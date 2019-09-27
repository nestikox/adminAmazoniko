 <?php
    /**
     * Created by PhpStorm.
     * User: Angel Leon
     * Date: 11/05/17
     * Time: 2:05 PM
     * Author: ideco.com.co
     */
    defined('BASEPATH') or exit('No direct script access allowed');
    class AjaxRequestModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
												$this->load->database();
        }
        
        public function request($q){
            $r = $this->db->query($q);
            return $r->result();
        }
        
        public function request_conteo($q){
            $r = $this->db->query($q);
            return $r->num_rows($r);
        }
        
        public function getUsuarioRutasConcat($id){
         $qr="select r.nombre from a005_usuario_rutas ur 
                left join a001_ruta r on r.ida001_ruta = ur.ruta_id
                left join users u on u.id = ur.usuario_id where u.id=$id;";
         $exec = $this->db->query($qr);
         $r = $exec->result();
         $numeroRegistros = $exec->num_rows();
         $resultado = "";
         $i = 0; /*contador*/
         if($numeroRegistros>=2){
          foreach($r as $k => $v){
            if($i==0){
              $resultado.=$v->nombre;
             }else{
              $resultado.=" , ".$v->nombre;
             }  
           $i++;
          }
         }elseif($numeroRegistros==1){
            $resultado=$r[0]->nombre;
         }
         return $resultado;
        }
       public function getUsuarioZonasConcat($id){
         $qr="select z.nombre from a005_usuario_zonas uz 
           left join a003_zonas z on z.id = uz.zona
           left join users u on u.id = uz.usuario where u.id=$id;";
         $exec = $this->db->query($qr);
         $r = $exec->result();
         $numeroRegistros = $exec->num_rows();
         $resultado = "";
         $i = 0; /*contador*/
         if($numeroRegistros>=2){
          foreach($r as $k => $v){
            if($i==0){
              $resultado.=$v->nombre;
             }else{
              $resultado.=" , ".$v->nombre;
             }  
           $i++;
          }
         }elseif($numeroRegistros==1){
            $resultado=$r[0]->nombre;
         }
         return $resultado;
       }
}
