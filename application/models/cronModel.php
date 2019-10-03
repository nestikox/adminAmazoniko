 <?php
    /**
     * User: Nestor Castellano
     * Date: 2019-07-29
     * Time: 9:12 PM
     * Author: 5md
     */
defined('BASEPATH') or exit('No direct script access allowed');
class CronModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();$this->load->database();
    }
    
    public function cerrarDia(){
        /*
        * Funcion: cerrarDia
        * Objetivo: Realizar el chequeo diario para cerrar las fechas en curso
        * y generar nueva fecha, tomando en cuenta si la fecha tiene recoleccion creada o no en caso
        * de tener recoleccion el estado queda en 3 en caso contrario el estado queda en 2
        */
        /*vencer o finalizar las recolecciones pasadas de fecha*/
        $this->finalizarRecoleccionesActuales();
        $today = date('Y-m-d');
        $q1 ="select pf.* from a007_programaciones_fecha pf
                inner join a006_programaciones p on pf.programacion_id = p.id
                left join a003_zonas z on p.zona = z.id
                where pf.nuevafecha <= current_date() and pf.estado in(1,3) and z.activo = 1;";
                
        $qr1 = $this->db->query($q1);
            foreach($qr1->result() as $k1=>$v1){
            /* comprobar si tiene recoleccion activa */
            $recoleccion=$this->comprobar_recoleccion_fecha($v1->id);
                if($recoleccion){
                    /* si existe recoleccion cerrar fecha en estado 3 = vencida fecha con recoleccion */
                    $this->cambiarEstadoFecha($v1->id, 4);
                    /* comprobar ultima fecha y crear nueva fecha a partir de la ultima */
                    $in = $this->generarNuevaFecha($v1->programacion_id);
                    echo $v1->nuevafecha." Dia vencido con Recoleccion. nueva fecha id -> ".$in."<br>";
                }else{
                    /* NO existe recoleccion cerrar fecha en estado 2 = vencida */
                    $this->cambiarEstadoFecha($v1->id, 2);
                    /* crear nueva fecha */
                    $in = $this->generarNuevaFecha($v1->programacion_id);
                    echo $v1->nuevafecha." Vencida sin recoleccion. nueva fecha id -> ".$in."<br>";
                }
            }
            $this->generarRecolecciones();
    }
    
    public function generarFechasNuevaProgramacion($programacion){
     
       $q1 ="select pf.* from a007_programaciones_fecha pf
                left join a006_programaciones p on pf.programacion_id = p.id
                left join a003_zonas z on p.zona = z.id
                where z.activo = 1 and programacion_id = $programacion";
       $qr1 = $this->db->query($q1);
      
       $res = $qr1->row();
       $this->generarNuevaFecha($res->programacion_id);
       $this->generarRecolecciones();
    }
     public function cerrarDiaNOPRINT(){
        /*
        * Funcion: cerrarDia
        * Objetivo: Realizar el chequeo diario para cerrar las fechas en curso
        * y generar nueva fecha, tomando en cuenta si la fecha tiene recoleccion creada o no en caso
        * de tener recoleccion el estado queda en 3 en caso contrario el estado queda en 2
        */
        /*vencer o finalizar las recolecciones pasadas de fecha*/
        $this->finalizarRecoleccionesActuales();
        $today = date('Y-m-d');
        $q1 ="select pf.* from a007_programaciones_fecha pf
                inner join a006_programaciones p on pf.programacion_id = p.id
                left join a003_zonas z on p.zona = z.id
                where pf.nuevafecha <= current_date() and pf.estado in(1,3) and z.activo = 1;";
                
        $qr1 = $this->db->query($q1);
            foreach($qr1->result() as $k1=>$v1){
            /* comprobar si tiene recoleccion activa */
            $recoleccion=$this->comprobar_recoleccion_fecha($v1->id);
                if($recoleccion){
                    /* si existe recoleccion cerrar fecha en estado 3 = vencida fecha con recoleccion */
                    $this->cambiarEstadoFecha($v1->id, 4);
                    /* comprobar ultima fecha y crear nueva fecha a partir de la ultima */
                    $in = $this->generarNuevaFecha($v1->programacion_id);
                    //echo $v1->nuevafecha." Dia vencido con Recoleccion. nueva fecha id -> ".$in."<br>";
                }else{
                    /* NO existe recoleccion cerrar fecha en estado 2 = vencida */
                    $this->cambiarEstadoFecha($v1->id, 2);
                    /* crear nueva fecha */
                    $in = $this->generarNuevaFecha($v1->programacion_id);
                    //echo $v1->nuevafecha." Vencida sin recoleccion. nueva fecha id -> ".$in."<br>";
                }
            }
            $this->generarRecolecciones();
    }
    public function generarRecolecciones(){
      /* consultar fechas que no tienen recoleccion */
      $q1="SELECT pf.* FROM a007_programaciones_fecha pf
          left join a009_recolecciones rec on rec.fecha_id = pf.id
          where pf.nuevafecha >= current_date() and rec.id is null;";
      $q1r = $this->db->query($q1);
      $res1 = $q1r->result();
      $res1n = $q1r->num_rows();
      if($res1n > 0){
       foreach($res1 as $k => $v){
        /* crear recoleccion, estado =1 creada - en espera */
         $data = array('fecha_id'=>$v->id, 'estado'=>1);
         $this->generarRecoleccion($data);
       }
      }
    }
    public function generarRecoleccion($data){
      return $this->db->insert('a009_recolecciones', $data);
    }
    public function generarNuevaFecha($programacion_id){
        /* consulta la ultima fecha programada */
        $q = "select * from a007_programaciones_fecha where programacion_id=$programacion_id and estado=1 order by nuevafecha desc limit 1;";
        $qr = $this->db->query($q);
        $ultima = $qr->row();
        /* genero nueva fecha a partir de la ultima */
        $q2="select DATE_ADD('".$ultima->nuevafecha."', INTERVAL 7 DAY) as next";
        $qr2 = $this->db->query($q2);
        $fcn = $qr2->row();
        
        $nuevaFc = array('programacion_id'=>$programacion_id, 'nuevafecha'=>$fcn->next, 'estado'=>1);
        $this->db->insert('a007_programaciones_fecha', $nuevaFc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function getUsuarios(){
     $q="SELECT * FROM users where id not in(3,22,4);";
     $r = $this->db->query($q);
     return $r->result();
    }
    
    public function asignarRuta($idUsuario, $ruta){
     $data = array('usuario_id'=>$idUsuario,'ruta_id'=>$ruta);
     $this->db->insert('a005_usuario_rutas', $data);
    }
    
    public function comprobar_recoleccion_fecha($idFecha){
        $q = "SELECT * FROM a009_recolecciones where fecha_id =$idFecha;";
        $qr = $this->db->query($q);
        $qn = $qr->num_rows();
        if($qn>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function cambiarEstadoFecha($id, $estado){
        $this->db->where('id', $id);
        if($this->db->update('a007_programaciones_fecha', array('estado'=>$estado))){
            return true;
        }else{
            return false;
        }
    }
    public function getUsuarioXCorreo($correo){
     
     $r = $this->db->query("select id from users where email='$correo' limit 1;");
     $re = $r->row();
     $n = $r->num_rows();
     if($n>0){
      return $re->id; 
     }else{
      return 0;
     }
    }
	public function actualizarPuntos(){
  echo "Not allowed";
		/*
		$r = $this->db->query('SELECT u.correo as usuario, r.correo as recolector, a.bolsas_p, a.bolsas_ac, a.peso_p, a.peso_ac, calificacion, a.puntos FROM recoleccion a
left join usuarios u on u.id = a.id_usuario
left join usuarios r on r.id = a.id_recolector');
		$usuariosAnteriores = $r->result();
  $i=0;
		foreach($usuariosAnteriores as $k => $ua){
   $idU = intval($this->getUsuarioXCorreo($ua->usuario));
   $idR = intval($this->getUsuarioXCorreo($ua->recolector));
   
   $data = array('usuario_id'=>$idU, 'recolector_id'=>$idR, 'bolsa_a'=>$ua->bolsas_p,'bolsa_b'=>$ua->bolsas_ac,
                 'peso_a'=>$ua->peso_p,'peso_b'=>$ua->peso_ac,'calificacion'=>$ua->calificacion,'puntos'=>$ua->puntos);
   $this->db->insert('a010_recoleccion_data', $data);
   $i++;
		}
  echo $i." actualizaciones";*/
	}
 
 public function insertarZona($z){
   if($this->db->insert('a004_zona_coordenadas', $z)){
     return true;
    }else{
     return false;
    }
 }
 
 public function finalizarRecoleccionesActuales(){
  $q="SELECT r.id FROM a009_recolecciones r 
   left join a007_programaciones_fecha pf on pf.id = r.fecha_id 
   where pf.nuevafecha < current_date() and r.estado not in(4,5);";
   /* not in FINALIZADA, o VENCIDA */
  $qr = $this->db->query($q);
  $res = $qr->result();
  $nr = $qr->num_rows();
   if($nr>0){
    foreach($res as $k => $v){
      echo 'recoleccion <b>#'.$v->id.'</b> Vencida <br>';
      $this->cambiarEstadoRecoleccion($v->id, 5);
     } 
   }
 }
 
 public function cambiarEstadoRecoleccion($idR, $estado){
  $e = array('estado'=>$estado);
  $this->db->where('id', $idR);
  if($this->db->update('a009_recolecciones', $e)){
    return true;
   }else{
    return false;
   }
 }
 
}