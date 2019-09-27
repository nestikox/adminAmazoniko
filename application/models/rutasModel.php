  <?php
    /**
     * Created by
     * User: Nestor Castellano
     * Date: 17/04/19
     * Time: 11:10 AM
     * Author: 5mdgroup
     */
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class rutasModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
					$this->load->database();
        }
        
        public function getRutaUsuario($u){
          $q="select ruta_id from a005_usuario_rutas where usuario_id =".$u;
          $qr = $this->db->query($q);
          $qresult = $qr->row();
          var_dump($q);
          return $qresult->ruta_id;
        }
				 public function getRutas($id=0){
            if($id!=0):
            $q="select a.*,
            (select count(ida002_paraderos) from a002_paraderos where id_ruta = a.ida001_ruta) as paraderos
            from a001_ruta a where ida001_ruta =$id;";
            else:
            $q="select a.*,
            (select count(ida002_paraderos) from a002_paraderos where id_ruta = a.ida001_ruta) as paraderos
            from a001_ruta a;";
            endif;
            $r =  $this->db->query($q);
            return $r->result();
        }
				public function getPoligonZona($idZona){
				$q="SELECT * FROM amazoniko2.a004_zona_coordenadas where co_zona =".$idZona." order by id004 asc";
				$r = $this->db->query($q);
				$poligon = $r->result();
				$retorno="";
				$i=0;
				foreach($poligon as $k => $v){
					 if($i>0){
									$retorno.= ",{lat:".$v->lat.",lng:".$v->lng."}";	
							}else{
									$retorno.= "{lat:".$v->lat.",lng:".$v->lng."}";	
							}
							$i++;
					}
				return $retorno;
				}
        
        public function getPoligonZonaArray($idZona){
          $q="SELECT * FROM amazoniko2.a004_zona_coordenadas where co_zona =".$idZona." order by id004 asc";
				$r = $this->db->query($q);
				$poligon = $r->result();
				$retorno=array();
				$i=0;
          foreach($poligon as $k => $v){
            array_push($retorno,$v->lat." ".$v->lng);
          }
          return $retorno;
        }
        
    public function getParaderoUsuario($idusuario){
      $q="select * from a002_paraderos where usuario_id =$idusuario;";
      $r =$this->db->query($q);
      $n = $r->num_rows();
      if($n>0){
        return $r->row();
      }else{
        return false;
      }
    }
        
    public function asignarZonaParadero($u, $z){
      $this->db->where('usuario_id', $u);
      if($this->db->update('a002_paraderos', array('zona'=>$z))){
        return true;
      }else{
        return false;
      }
    }
        
    public function getParaderos($idruta){
      
      $response = array();
      $q="select * from a002_paraderos where id_ruta =$idruta;";
      $r =  $this->db->query($q);
      $paraderos = $r->result();
      /* Resultado Comun*/
      $response['result'] = $paraderos;
      /* Ordenar datos para MAPA*/
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
            return $response;
        }
				
			public function actualizarPosicionParadero($id, $posicion){
						$q="update a002_paraderos set ordenamiento=$posicion where id=".$id;
						$r =  $this->db->query($q);
						if($r){
							return true;
						}else{
							return $this->db->error();
						}
				}
      public function actualizarDatosUsuario($id,$data){
        $this->db->where('id', $id);
					if($this->db->update('users',$data)){
						return true;
					}else{
						return false;
					}
      }
				
			public function guardarParaderoAjax($paradero){
				if($this->db->insert('a002_paraderos',$paradero)){
					return true;
				}else{
					return false;
				}
			}
			public function actualizarParaderoAjax($id_usuario,$paradero){
				$this->db->where('usuario_id', $id_usuario);
					if($this->db->update('a002_paraderos',$paradero)){
						return true;
					}else{
						return false;
					}
			}
      
			public function chequearParaderoExiste($ruta, $numeroParadero){
			$q="select * from a002_paraderos where id_ruta =$ruta and ordenamiento = $numeroParadero";
			$r =  $this->db->query($q);
			$res = $r->result();
			$resnum = $r->num_rows();
			if($resnum>0){
					return true;/* devolver true por que hay un paradero con ese numero de parada */
				}else{
					return false;/* devolver false por que no hay paradero con ese numero de parada */
				}
		}
		public function chequearParaderoExisteUsuario($id_Usuario){
			$q="select * from a002_paraderos where usuario_id =$id_Usuario";
			$r =  $this->db->query($q);
			$res = $r->row();
			$resnum = $r->num_rows();
      $q2="SELECT phone, rut FROM amazoniko2.users where id=$id_Usuario";
			$r2 =  $this->db->query($q2);
      $res2 = $r2->row();
      $retorno = false;
			if($resnum>0){ $retorno = true;}else{return false;}
      if(strlen($res2->phone)>2){ $retorno = true;}else{ return false;}
      if(strlen($res2->rut)>2){ $retorno = true;}else{  return false; }
      if($res->zona!=0 or strlen($res->zona)>0){ $retorno = true;}else{  return false; }
      return $retorno;
		}
    
		public function checkParaderoUsuario($usuario){
     $q="select * from a002_paraderos where usuario_id =$usuario";
			$r =  $this->db->query($q);
			$res = $r->row();
			$resnum = $r->num_rows();
			if($resnum>0){
					return $res->ida002_paraderos;/* devolver true por que hay un paradero con ese numero de parada */
				}else{
					return false;/* devolver false por que no hay paradero con ese numero de parada */
				}
    }
		public function guardarRuta($ruta, $paraderoInicial){/* RUTAS */
			$arrayResult = array();
			if($this->db->insert('a001_ruta', $ruta)){
				$insert_id = $this->db->insert_id();
				$paraderoInicial['id_ruta'] = $insert_id;
				$this->db->insert('a002_paraderos', $paraderoInicial);
			 $arrayResult['codeFinal'] = 1; /* 1 true 0 false*/
			 return $arrayResult;
			}else{
			$error = $this->db->error();
			$arrayResult['codeFinal'] = 0; /* 1 true 0 false*/
			$arrayResult['message'] =$error['message'];
			return $arrayResult;
			}
		}
		public function actualizarRuta($id, $datos){
				$arrayResult = array();
				$this->db->where('ida001_ruta', $id);
			if($this->db->update('a001_ruta', $datos)){
				$arrayResult['codeFinal'] = 1; /* 1 true 0 false*/
				return $arrayResult;
			 }else{
				 $error = $this->db->error();
				 $arrayResult['codeFinal'] = 0; /* 1 true 0 false*/
				 $arrayResult['message'] =$error['message'];
				 return $arrayResult;
			 }
		}
    /* coordenadas juntas seperadas por espacio */
    public function getCoordZonaSep($id){
      $q="SELECT concat(lat,' ',lng) as coordenadas FROM amazoniko2.a004_zona_coordenadas where co_zona =$id;";
      $query = $this->db->query($q);
      $res = $query->result();
      $result = array();
      foreach($res as $k=>$v){
        $result[] = $v->coordenadas;
      }
      return $result;
    }
    /* coordenadas sin arreglo */
    public function getCoordZona($id){
      	$q ="select * from a004_zona_coordenadas where co_zona =$id;";
        $r = $this->db->query($q);
        return $r->result();
    }
    
		public function getZonas($id=0){
				if($id!=0){
						$q ="SELECT * FROM a003_zonas where id =".$id;
						$r = $this->db->query($q);
						return $r->row();
				}else{
					/* ZONAS ACTIVAS */
					$q ="select * from a003_zonas where activo=1;";
					$r = $this->db->query($q);
					return $r->result();
				}
		}
		public function resetZonaCoordenadas($idZona){
			$this->db->where('co_zona', $idZona);
			$this->db->delete('a004_zona_coordenadas');
		}
		public function guardarZonaCoordenada($latlng, $idZona){
				$data = explode ( ',' , $latlng );
				$dataIn = array('co_zona'=>$idZona,
												'lat'=>$data[0],
												'lng'=>$data[1]);
				$this->db->insert('a004_zona_coordenadas', $dataIn );
			}
		public function getRecoleccionZona($id){
			$q="SELECT p.id, p.dia, pf.nuevafecha as proxima_programacion, p.repetir FROM a006_programaciones p
			left join a007_programaciones_fecha pf on pf.programacion_id = p.id 
			left join a009_recolecciones r on pf.id = r.fecha_id 
            where p.zona =$id 
            and pf.nuevafecha between current_date() and DATE_ADD(current_date(), INTERVAL 16 DAY)
            and pf.estado in(1,2)";
			$rq = $this->db->query($q);
      return $rq->result();
		}

		public function guardarZona($data){
			 $arrayResult = array();
					 if($this->db->insert('a003_zonas', $data)){
							 $insert_id = $this->db->insert_id();
							 $arrayResult['codeFinal'] = 1; /* 1 true 0 false*/
							 $arrayResult['id'] = $insert_id;
							 return $arrayResult;
					 }else{
							 $error = $this->db->error();
							 $arrayResult['codeFinal'] = 0; /* 1 true 0 false*/
							 $arrayResult['message'] =$error['message'];
							 return $arrayResult;
					 }
	 }
	 public function actualizarZona($id, $data){
			 $arrayResult = array();
			 $this->db->where('id', $id);
					 if($this->db->update('a003_zonas', $data)){
							 $arrayResult['codeFinal'] = 1; /* 1 true 0 false*/
							 $arrayResult['id'] = $id;
							 return $arrayResult;
					 }else{
							 $error = $this->db->error();
							 $arrayResult['codeFinal'] = 0; /* 1 true 0 false*/
							 $arrayResult['message'] =$error['message'];
							 return $arrayResult;
					 }
	 }
	public function getRutasPorZona($zona, $t = 0){
		$q="select * from a001_ruta where id_zona = $zona;";
		$rq = $this->db->query($q);
		if($t == 0){
			$resultado = "<option value='0'>Seleccione...</option>";
			foreach($rq->result() as $k => $v){
				$resultado.="<option value='".$v->ida001_ruta."'>".$v->nombre."</option>";
			}
			return $resultado;
		}else{
			return $rq->result();
		}
	}
  
  public function actualizarProgramacion($id, $data){
    $this->db->where('id', $id);
    if($this->db->update('a006_programaciones',$data)){
      return true;
    }else{
      return false;
    }
  }
  public function actualizarRecoleccion($programacion, $data){
    $this->db->where('programacion_id', $programacion);
    $this->db->where('estado', 1);
    if($this->db->update('a009_recolecciones',$data)){
      return true;
    }else{
      return false;
    }
  }
  public function guardarRecoleccion($data){
    if($this->db->insert('a009_recolecciones',$data)){
      return true;
    }else{
      return false;
    } 
  }
  public function guardarFechasProgramacion($data){
    if($this->db->insert('a007_programaciones_fecha',$data)){
      return true;
    }else{
      return false;
    } 
  }
  public function actualizarDireccionUsuario($id, $data){
    $this->db->where('id', $id);
    $this->db->update('users', $data);
  }
  public function resetProgramaciones($programacion){
    $this->db->where('programacion_id', $programacion);
    $this->db->where('estado', 1);
    $this->db->delete('a007_programaciones_fecha');
  }
  
  public function getNuevaFecha($fecha){
    $q="select '$fecha' as fecha1, DATE_ADD('$fecha', INTERVAL 7 DAY) as next,DATE_ADD('$fecha', INTERVAL 14 DAY) as next2";
    $r = $this->db->query($q);
    return $r->row();
  }
  
  public function getProgramacionRuta($ruta){
    $result = array();
    $q="select * from a006_programaciones where ruta=$ruta ;";
    $qr = $this->db->query($q);
    $nr =  $qr->num_rows();
    $r1 = $qr->row();
    $result['programacion'] = $r1;
    if($nr>0){
      $result['fechas'] = $this->getProximasFechas($r1->id);
    }
    return $result;
  }
   public function getProgramacionZona($z){
    $result = array();
    $q="select * from a006_programaciones where zona=$z ;";
    $qr = $this->db->query($q);
    $nr =  $qr->num_rows();
    $r1 = $qr->row();
    $result['programacion'] = $r1;
    if($nr>0){
      $result['fechas'] = $this->getProximasFechas($r1->id);
    }
    return $result;
  }
  
  public function getProximasFechas($pid){
    $q="select * from a007_programaciones_fecha where programacion_id=$pid and nuevaFecha >= current_date() order by nuevafecha asc;";
    $qr = $this->db->query($q);
    return $qr->result();
  }
  
  public function guardarProgramacion($data){
    if($this->db->insert('a006_programaciones', $data)){
        $insert_id = $this->db->insert_id();
        return $insert_id;
        }else{
      return 0;
    }
  }
  
	public function getRecolectorPorRuta($ruta, $t=0){
		$q="SELECT u.id, u.email, concat(u.first_name,' ',u.last_name) as name  
      FROM amazoniko2.a005_usuario_rutas ur
      left join users u on u.id = ur.usuario_id
      left join users_groups ug on u.id = user_id
      left join groups g on g.id = ug.group_id
      where g.id = 3 and ur.ruta_id =$ruta;";
		$rq = $this->db->query($q);
    $rr = $rq->num_rows();
    $r = array();
		if($t == 0){
			$resultado = "<option value='0'>Seleccione...</option>";
			foreach($rq->result() as $k => $v){
				$resultado.="<option value='".$v->id."'>".$v->name."</option>";
			}
      if($rr > 0){ $r['resultCode']=1;}else{$r['resultCode']=0;}
      $r['result']=$resultado;
			return $r;
		}else{
			return $rq->result();
		}
	}
  public function getProgramaciones(){
    $q ="select pf.nuevafecha, concat('Recoleccion en ruta: ',r.nombre ,' / ',ur.first_name,' ',ur.last_name) as info from a006_programaciones p
          left join a007_programaciones_fecha pf on pf.programacion_id = p.id
          left join users ur on ur.id = p.recolector
          left join a001_ruta r on r.ida001_ruta = p.ruta
          where pf.estado =1;";
    $qr = $this->db->query($q);
   return $qr->result();
  }
}