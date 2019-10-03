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
        public function getProgramacionZona($idZona){
          $q="SELECT * FROM a006_programaciones where zona =$idZona;";
          $qr = $this->db->query($q);
          $qn = $qr->num_rows();
          if($qn>0){
            return $qr->row();
          }else{
            return false;
          }
        }
        public function asignarPuntosRecoleccion($idRecoleccion){
          $q1="SELECT * FROM a010_recoleccion_usuarios where recoleccion = $idRecoleccion;";
          $qr1 = $this->db->query($q1);
          foreach($qr1->result() as $k => $usRe){
            /* usRe = usuarios recoleccion */
            $puntosActuales=0;$puntosGanados=0;$puntosTotales=0;
            $querydataRecoleccion="select puntos, recoleccion_id, recolector_id, usuario_id from a010_recoleccion_data where usuario_id =".$usRe->usuario." and recoleccion_id =".$usRe->recoleccion.";";
            $qrdat = $this->db->query($querydataRecoleccion);
            $dataRecoleccion = $qrdat->row();
            $dataRecoleccionNUM = $qrdat->num_rows();
            if($dataRecoleccionNUM>0){
              $userDataQuery="select id, puntos from users where id=".$dataRecoleccion->usuario_id.";";
              $qrun = $this->db->query($userDataQuery);
              $ud = $qrun->row();
              $puntosActuales = intval($ud->puntos);
              $puntosGanados = intval($dataRecoleccion->puntos);
              $puntosTotales = $puntosActuales + $puntosGanados;
              $dataHistorial = array(
                'puntosa'=>$puntosActuales,'puntosg'=>$puntosGanados,
                'puntost'=>$puntosTotales,'recoleccion'=>$dataRecoleccion->recoleccion_id,'user'=>$ud->id);
              $updatePuntos = array('puntos'=>$puntosTotales);
              $this->db->where('id', $ud->id);
              $this->db->update('users', $updatePuntos);
              $this->db->insert('historial_puntos', $dataHistorial);
            }
          }
        }
        public function borrarFechasActivasPorProgramacion($programacion){
          $q="select * from a007_programaciones_fecha where programacion_id =$programacion and nuevafecha >= current_date() and estado in (1,2) ;";
          $qr = $this->db->query($q);
          $progs = $qr->result();
          $qn = $qr->num_rows();
          if($qn>0){
            foreach($progs as $k => $v){
              $this->borrarRegistro($v->id, 'id', 'a007_programaciones_fecha');
            }
          }
        }
        
        public function guardarNuevaFechaProgramacion($data){
          return $this->db->insert('a007_programaciones_fecha', $data);
        }
        
        public function actualizarProgramacion($idProgramacion, $data){
          $this->db->where('id', $idProgramacion);
          return $this->db->update('a006_programaciones', $data);
        }
        
        public function borrarRegistro($registroId, $columna, $tablaRegistro){
          $this->db->where($columna, $registroId);
          return $this->db->delete($tablaRegistro);
        }
        
        public function borrarUsuarioRecoleccion($fechaid,$u){
          $q="select r.id from a007_programaciones_fecha pf
          left join a009_recolecciones r on r.fecha_id = pf.id
           where pf.id=$fechaid;";
          $qr = $this->db->query($q);
          $res = $qr->row();
          $qrn = $qr->num_rows();
          if($qrn>0){
            $this->db->where('recoleccion', $res->id);
            $this->db->where('usuario', $u);
            $this->db->delete('a010_recoleccion_usuarios');
            return;
          }else{
            return;
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
        public function validarActivarRecoleccion($idR){
          $q="select * from a009_recolecciones where id = $idR";
          $qr=$this->db->query($q);
          $r = $qr->row();
          /* activar en caso de que este en espera */
          if($r->estado!=4 and $r->estado!=3 and $r->estado!=2){
            $this->cambiarEstadoRecoleccion($idR, 2);
          }
        }
         
        public function getParaderosRecoleccion($idR){
          $qv ="select usuario_id from a010_recoleccion_data where recoleccion_id =$idR;";
          $qvr = $this->db->query($qv);
          $val = $qvr->result();
          $npro = $qvr->num_rows();
          $puntosYaPro = "";
          $c1 = 0;
          foreach($val as $k1 =>$v1){
            if($c1==0){ $puntosYaPro.= $v1->usuario_id;
            }else{ $puntosYaPro.= ','.$v1->usuario_id; }
            $c1++;
          }
          /* fin de obtencion de los paraderos que ya estan procesados en la recoleccion */
          if($npro>0){
            $qadd="and u.id not in (".$puntosYaPro.");";
          }else{
            $qadd=";";
          }
          /* en caso no asignados no dañar el query */
          $q1="select ru.usuario, pa.direccion, concat(u.first_name,' ',u.last_name) as nombre_usuario, u.tipo_vivienda,pa.nombre as nombre_vivienda, u.address_detail from a010_recoleccion_usuarios ru
            left join a002_paraderos pa on pa.usuario_id = ru.usuario 
            left join users u on pa.usuario_id = u.id
            where ru.recoleccion =".$idR." ".$qadd;
          $qr1 = $this->db->query($q1);
          $result = array();
          $result['n'] = $qr1->num_rows();
          $result['r'] = $qr1->result();
          return $result;
        }
        
        public function getProgramacionesZona($idu){
          $q="select pro.dia, z.nombre, z.color from a006_programaciones pro
        left join a002_paraderos pa on pa.zona = pro.zona
        left join a003_zonas z on pa.zona = z.id
        where pa.usuario_id=$idu;";
        $qr = $this->db->query($q);
          return $qr->row();
        }
        public function getProximasFechas($id){
          /* validaciones */
          $result = array();
          /*$q ="select pf.*, reco.estado as recoleccionEstado from a005_usuario_rutas ru
              left join a006_programaciones p on p.ruta = ru.ruta_id
              left join a007_programaciones_fecha pf on pf.programacion_id = p.id
              left join a010_recoleccion_usuarios reu on reu.usuario 
              left join a009_recolecciones reco on pf.id = reco.fecha_id
              where ru.usuario_id=$id and pf.nuevafecha >= current_date() group by nuevafecha;";*/
          $q =" select pf.*, reco.estado as recoleccionEstado from a002_paraderos para
              left join a006_programaciones p on p.zona = para.zona
              left join a007_programaciones_fecha pf on pf.programacion_id = p.id
              left join a010_recoleccion_usuarios reu on reu.usuario = para.usuario_id
               left join a009_recolecciones reco on pf.id = reco.fecha_id
              where usuario_id =$id and pf.nuevafecha >= current_date() group by nuevafecha;";
          $qr1 = $this->db->query($q);
          $q1n = $qr1->num_rows();
          $r1= $qr1->result();
          /* ARREGLAR LOS ID DE FECHAS PARA VALIDACION PROXIMA*/
          $fechasId='(';
          $i=0;
          if($q1n>0){
            foreach($r1 as $k1 => $v1){
              if($i==0){ $fechasId.=$v1->id;}else{ $fechasId.=','.$v1->id;}
              $i++;
            }
          }
          $fechasId.=')';
          /* DETERMINAR SI TIENE RECOLECCIONES ACTIVAS */
          $q2 ="select ru.usuario as usuario_id, pf.nuevafecha, pf.id from a009_recolecciones r
            left join a010_recoleccion_usuarios ru on ru.recoleccion = r.id
            left join a007_programaciones_fecha pf on r.fecha_id = pf.id
            where ru.usuario =$id ".(strlen($fechasId)>2?'and pf.id in '.$fechasId:'')." and r.estado not in(4,5)";
          $qr2 = $this->db->query($q2);
          
          $q2n = $qr2->num_rows();
          /* PROGRAMACIONES FINALIZADAS RECIENTEMENTE */
          $q3 = "select ru.usuario as usuario_id, pf.nuevafecha from a009_recolecciones r
                left join a010_recoleccion_usuarios ru on ru.recoleccion = r.id
                left join a007_programaciones_fecha pf on r.fecha_id = pf.id
                where ru.usuario =$id ".(strlen($fechasId)>2?'and pf.id in '.$fechasId:'')." and r.estado in(4,5) and 
                pf.nuevafecha between date_add(current_date(), interval -3 day) and current_date();";
          $qr3 = $this->db->query($q3);
          $q3n = $qr3->num_rows();
          $result['proximas']= ($q1n>0?$r1:0);
          $result['r1']= ($q1n>0?1:0);
          $result['programadas']= ($q2n>0?$qr2->result():0);
          $result['r2']= ($q2n>0?1:0);
          $result['pasadas']= ($q3n>0?$qr3->result():0);
          $result['r3']= ($q3n>0?1:0);
          return $result;
        }
        
        public function validarFechasRecoleccion($idR){
         $q1 = "select a.*,b.*, current_date() as today from a009_recolecciones a
            left join a007_programaciones_fecha b on b.id = a.fecha_id
            where a.id=$idR;";
         $qr1 = $this->db->query($q1);
         $r1 = $qr1->row();
         $n = $qr1->num_rows();
         if($n>0){
          if($r1->nuevafecha == $r1->today){
            return true;
           }else{
            return false;
           }
         }else{
          return false;
         }
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
          $q="SELECT * FROM a005_usuario_rutas where usuario_id =$id;";
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
          if($perfil != 'admin'){$qadd = "uz.usuario =$user and";}else{$qadd=' ';}
          $q ="select pf.*, z.nombre as zona, 
            (select count(id) from a010_recoleccion_usuarios where recoleccion = re.id) as usuario_agenda,
            (case when pf.nuevafecha < current_date() then 1 else 0 end) as vencida
            from a005_usuario_zonas uz 
            left join a003_zonas z on uz.zona = z.id
            left join a006_programaciones p on p.zona = z.id
            left join a007_programaciones_fecha pf on pf.programacion_id = p.id
            left join a009_recolecciones re on re.fecha_id = pf.id
            where ".$qadd." pf.nuevafecha between date_add(current_date(), interval -30 day) and date_add(current_date(), interval 60 day);";
          $rq = $this->db->query($q);
          $progs = $rq->result();
          $arrayS = "";
          $add = ',"backgroundColor":"#A8F1DE"';
          foreach ($progs as $k =>$fila) {
            if($fila->usuario_agenda>0){ $add = ',"backgroundColor":"#199919"'; }
            if($fila->usuario_agenda==0){ $add = ',"backgroundColor":"#A8F1DE"'; }
            if($fila->vencida>0){$add = ',"backgroundColor":"grey"'; }
            $arrayS.= '{"title":"'.$fila->zona.'", "start":"'.$fila->nuevafecha.'"'.$add.'},';
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
        public function guardarRecoleccionData($data){
              if($this->db->insert('a010_recoleccion_data', $data)){
            $insert_id = $this->db->insert_id();
            return $insert_id;
          }else{
              return 0;
          }
        }
    }

