  <?php
    /**
     * Created by
     * User: Nestor Castellano
     * Date: 17/04/19
     * Time: 11:10 AM
     * Author: 5mdgroup
     */
    defined('BASEPATH') or exit('No direct script access allowed');
    class IntegracionModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
			$this->load->database('amazoniko');
        }
        public function test($email){
            
        }
        public function getUser($email){
            $q ="SELECT * FROM amazoniko.wp_users where user_email = '$email';";
            $p = $this->db->query($q);
            $resultado = array('count'=>$p->num_rows());
            $resNum = $p->num_rows();
            $resultado['result'] = $p->row();
            $usuario = $p->row();
            if($resNum>0){
                $id =$usuario->ID;
                $resultado['status'] = 100;
                $q1="select meta_value as first_name from amazoniko.wp_usermeta where user_id=$id and meta_key = 'first_name';";
                $q2="select meta_value as last_name from amazoniko.wp_usermeta where user_id=$id and meta_key = 'last_name';";
                $fnq = $this->db->query($q1);
                $lnq = $this->db->query($q2);
                $first_name=$fnq->row();
                $last_name=$lnq->row();
                $resultado['first_name'] = $first_name->first_name;
                $resultado['last_name'] = $last_name->last_name;
            }else{
                $resultado['status'] = 400;    
            }
            return $resultado;
        }
    }