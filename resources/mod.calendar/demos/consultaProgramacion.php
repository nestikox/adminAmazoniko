<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../../mod.Datos/class.Datos.php';
$BBDD = new Datos();
$id = $_POST['metodo'];
if($id){ $a = new consultaProgramacion($id); }

class consultaProgramacion{
	private $id;
	private $controlador;
	public function __construct($id){
		$this->id = $id;
		$this->entorno = $_REQUEST;
		$this->negocio= $_SESSION['plantilla'];
        call_user_func(array($this,$id));
	}

    function obtenerProgramaciones(){
        $db = $GLOBALS['BBDD'];
        $q = "SELECT nuevafecha, concat(tareanombre,' - ',subzona.subzonnombre,'/',sistema.sistemnombre) as tareanombre FROM 5md_programacion_tarea 
        LEFT JOIN 5md_programacion_fecha ON 5md_programacion_fecha.id5md_programacion_tarea = 5md_programacion_tarea.id5md_programacion_tarea 
        LEFT JOIN tarea ON tarea.tareacodigo = 5md_programacion_tarea.tareacodigo
        left join sistema on 5md_programacion_tarea.sistemcodigo = sistema.sistemcodigo
        left join subzona on sistema.subzoncodigo = subzona.subzoncodigo";

        $consulta = $db->resultadosAsociados($q); 

        $arrayS = "";

        foreach ($consulta as $k =>$fila) {

            $arrayS .= '{"title":"'.$fila['tareanombre'].'", "start":"'.$fila['nuevafecha'].'"},';

        }
        echo $arrayS;   
    }
}


?>