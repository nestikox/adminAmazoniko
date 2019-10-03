<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
$con = mysqli_connect('localhost',"amazonik_uadmin","group5md1", 'amazonik_amazoniko2');
$recoleccionesFinalizadas = finalizarRecolecciones($con);
$fechasGeneradas = 0;
$q1 = "select pf.* from a007_programaciones_fecha pf
                inner join a006_programaciones p on pf.programacion_id = p.id
                left join a003_zonas z on p.zona = z.id
                where pf.nuevafecha <= current_date() and pf.estado in(1,3) and z.activo = 1;";
$sql1 = mysqli_query($con, $q1);
if($sql1!=false){
  while ($fechas = mysqli_fetch_assoc($sql1)){
    $recoleccion = comprobar_recoleccion_fecha($con, $fechas['id']);
    if($recoleccion){
            if(isset($recoleccion['estado']) and $recoleccion['estado']==2){
              asignarPuntosRecoleccion($con, $recoleccion['id']);
            }
            /* si existe recoleccion cerrar fecha en estado 3 = vencida fecha con recoleccion */
            cambiarEstadoFecha($con,$fechas['id'], 3);
            /* comprobar ultima fecha y crear nueva fecha a partir de la ultima */
            $in = generarNuevaFecha($con, $fechas['programacion_id']);
            $fechasGeneradas++;
            //echo $v1->nuevafecha." Dia vencido con Recoleccion. nueva fecha id -> ".$in."<br>";
        }else{
            /* NO existe recoleccion cerrar fecha en estado 2 = vencida */
            cambiarEstadoFecha($con, $fechas['id'], 2);
            /* crear nueva fecha */
            $in = generarNuevaFecha($con,$fechas['programacion_id']);
            $fechasGeneradas++;
            //echo $v1->nuevafecha." Vencida sin recoleccion. nueva fecha id -> ".$in."<br>";
        }
  }
}else{
 echo "ERROR:".$con->error;
}
echo "RECOLECCIONES VENCIDAS:".$recoleccionesFinalizadas."<br>";
echo "FECHAS GENERADAS:".$fechasGeneradas."<br>";

/* FUNCIIONES */
function asignarPuntosRecoleccion($con, $idRecoleccion){
 $q1="SELECT * FROM a010_recoleccion_usuarios where recoleccion = $idRecoleccion;";
          $qr1 = mysqli_query($con, $q);
          while($usRe = mysqli_fetch_assoc($qr1)){
            /* usRe = usuarios recoleccion */
            $puntosActuales=0;$puntosGanados=0;$puntosTotales=0;
            $querydataRecoleccion="select puntos, recoleccion_id, recolector_id, usuario_id from a010_recoleccion_data where usuario_id =".$usRe['usuario']." and recoleccion_id =".$usRe['recoleccion'].";";
            $qrdat = mysqli_query($con, $querydataRecoleccion);
            $dataRecoleccion = mysqli_fetch_assoc($qrdat);
            $dataRecoleccionNUM = mysqli_num_rows($qrdat);
            if($dataRecoleccionNUM>0){
              $userDataQuery="select id, puntos from users where id=".$dataRecoleccion['usuario_id'].";";
              $qrun = mysqli_query($con, $userDataQuery);
              $ud = mysqli_fetch_assoc($qrun);
              $puntosActuales = intval($ud['puntos']);
              $puntosGanados = intval($dataRecoleccion['puntos']);
              $puntosTotales = $puntosActuales + $puntosGanados;
              $dataHistorial = "insert into historial_puntos(puntosa,puntosg,puntost,recoleccion,user)
              values(".$puntosActuales.",".$puntosGanados.",".$puntosTotales.",".$dataRecoleccion['recoleccion_id'].",".$ud['id'].");";
              $updatePuntos ="update users set puntos=".$puntosTotales." where id=".$ud['id'] ;/*array('puntos'=>$puntosTotales);*/
              mysqli_query($con, $dataHistorial);
              mysqli_query($con, $updatePuntos);
            }
          }
}
function generarNuevaFecha($con, $programacion_id){
        /* consulta la ultima fecha programada */
        $q = "select * from a007_programaciones_fecha where programacion_id=$programacion_id and estado=1 order by nuevafecha desc limit 1;";
        $qr = mysqli_query($con, $q);
        $ultima = mysqli_fetch_assoc($qr);
        /* genero nueva fecha a partir de la ultima */
        $q2="select DATE_ADD('".$ultima['nuevafecha']."', INTERVAL 7 DAY) as next";
        $qr2 = mysqli_query($con, $q2);
        $fcn = mysqli_fetch_assoc($qr2);
        
        $nuevaFc="insert into a007_programaciones_fecha(programacion_id, nuevafecha, estado)values(".$programacion_id.", '".$fcn['next']."', 1)";
        mysqli_query($con, $nuevaFc);
        $insert_id = mysqli_insert_id($con);
        return  $insert_id;
}

function cambiarEstadoFecha($con, $id, $estado){
 $q="update a007_programaciones_fecha set estado=".$estado." where id=".$id;
 mysqli_query($con, $q);
}

function finalizarRecolecciones($con=false){
 $i=0;
    if($con!=false){
        $q="SELECT r.id FROM a009_recolecciones r 
            left join a007_programaciones_fecha pf on pf.id = r.fecha_id 
            where pf.nuevafecha < current_date() and r.estado not in(4,5);";
            /* not in FINALIZADA, o VENCIDA */
        $vencidas = mysqli_query($con, $q);
        if($vencidas!=false){
            while ($v = mysqli_fetch_assoc($vencidas)){
               cambiarEstadoRecoleccion($con, $v['id'],5);
               $i++;
            }
        }
    }
    return $i;
}
function comprobar_recoleccion_fecha($con, $idFecha){
        $q = "SELECT * FROM a009_recolecciones where fecha_id =$idFecha";
        $qr = mysqli_query($con, $q);
        $qn = mysqli_num_rows($qr);
        if($qn>0){
            return true;
        }else{
            return false;
        }
 }

function cambiarEstadoRecoleccion($con, $idr, $estado){
 $q="update a009_recolecciones set estado=".$estado." where id=".$idr;
 mysqli_query($con, $q);
}
/* CONTADOR VENCIDAS $ven = 0;*/
/* fecha actual 
$qf = "select (DATE_ADD(CURDATE(), INTERVAL 0 DAY)) as today;";
$faquery = mysqli_query($con, $qf);
$fa = mysqli_fetch_assoc($faquery);
//var_dump($fa);
echo "Fecha actual : ".$fa['today']."\n";
while($n = mysqli_fetch_assoc($sql1)){
    echo "CONSULTA DE LA EMPRESA ==> **".$n['alias']."**\n";
    $sql2 = "select count(ordtracodigo) as vencidas from bd_".$n['alias'].".ot 
    where ordtrafecfin <= current_date()
    and ot.otestacodigo in (2);";
    $sql3 = "select ordtracodigo as vencidas from bd_".$n['alias'].".ot 
    where ordtrafecfin <= current_date() and ot.otestacodigo in (2);";
    $vquery = mysqli_query($con, $sql2);
    $vres = mysqli_fetch_assoc($vquery);
    $vencidasq = mysqli_query($con, $sql3);
    if($vres['vencidas']>0){
        echo "Ordenes vencidas:".$vres['vencidas']."\n";
        while($v=mysqli_fetch_assoc($vencidasq)){
            echo $v['vencidas']." -> VENCIDA \n";
            $qvo1="update bd_".$n['alias'].".ot set otestacodigo=15 where ordtracodigo =".$v['vencidas'];
            $qvo2="update bd_".$n['alias'].".tareot set otestacodigo=15 where ordtracodigo =".$v['vencidas'];
            $gestionq ="INSERT INTO bd_".$n['alias'].".gestionot(ordtracodigo,usuacodi,tipousuario,fecha,hora,comentario)
            VALUES(".$v['vencidas'].",1,1,'".$fa['today']."','01:00:00','Orden de compra cambiada de estado por VENCIMIENTO.');";
            mysqli_query($con, $qvo1);
            mysqli_query($con, $qvo2);
            mysqli_query($con, $gestionq);
        }
    }else{
        echo "No tiene ordenes vencidas...\n";
    }
}*/
?>