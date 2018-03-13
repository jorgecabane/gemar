<?php

require_once dirname(__FILE__) . '/conexion.php';
require_once dirname(__FILE__) . '/insert_notification.php';

function insertReporte($reporte) {
    global $con;

    $rehacer = $reporte['rehacer'];
    $evento = $reporte['evento'];
    $resumen = $reporte['resumen'];
	$horario = $reporte['horario'];
    $inspeccion = $reporte['inspeccion'];
    $avance = $reporte['avance'];
    $fechacierre = $reporte['fechacierre'];
    $comentarios = $reporte['comentarios'];
    $alertas = $reporte['alertas'];
    $alcances = $reporte['alcances'];
    $conclusiones = $reporte['conclusiones'];
    $subcontratista = $reporte['subcontratista'];
    
    $number = 1;
    $numbersql = "SELECT max(numero_reporte) AS num
    			FROM reporte";
    if($numresult = $con->query($numbersql)){
    	$number = ($numresult->fetch_object()->num)+1;
    }

    $versionsql = "SELECT max(version) AS version
        FROM reporte
        WHERE evento_evento_id = $evento";
        
        // if returns something
        $lastversion = 1;
        if ($resultversion = $con->query($versionsql)) {
            $lastversion = ($resultversion->fetch_object()->version)+1;
        }
        else{
            $lastversion = 1;
        }
        $resultversion->close();

    if($rehacer == 1){
        $reporteid = $reporte['reporteid'];
        
        $query = "UPDATE reporte SET status='0', 
        		version='$lastversion', 
		        horario_trabajado='$horario', 
		        tipo_inspeccion='$inspeccion', 
		        avance='$avance', 
		        fecha_estimada_cierre='$fechacierre',  
		        comentarios='$comentarios',
		        alertas='$alertas',
		        alcances='$alcances',
		        conclusiones='$conclusiones',
		        resumen='$resumen',
		        numero_reporte='$number'
		        WHERE reporte_id = '$reporteid'";

        if ($result = $con->query($query)) {
        	$notifiaction_info_sql =  "SELECT e.nombre_proyecto, e.HoraTermino, u.user_id, u.user_first_name, u.user_last_name 
        								FROM evento e 
        								INNER JOIN users u ON (u.user_id = e.users_user_id AND e.evento_id = '$evento')";
        	if ($info = $con->query($notifiaction_info_sql)) {
        		$notification_info = $info->fetch_object();
	        	$descripcion = $notification_info->user_first_name." ".$notification_info->user_last_name." actualizó un reporte para ".$notification_info->nombre_proyecto;
	        	echo insertNotification('2', '1', $descripcion);
        	}
        	return $reporteid;
        }
        else {
        	return $query;
        }
    }
	else{
    	$query = "INSERT INTO `gemar`.`reporte`  VALUES (NULL, '$evento', '$lastversion', NOW(), '$horario', '$inspeccion', '$avance', '$fechacierre', '$comentarios', '$alertas', '$alcances', '$conclusiones', '$resumen', 0, '$subcontratista', '$number')";
    	if ($result = $con->query($query)) {
    		$notifiaction_info_sql =  "SELECT e.nombre_proyecto, e.HoraTermino, u.user_id, u.user_first_name, u.user_last_name
							    		FROM evento e
							    		INNER JOIN users u ON (u.user_id = e.users_user_id AND e.evento_id = '$evento')";
    		if ($info = $con->query($notifiaction_info_sql)) {
    			$notification_info = $info->fetch_object();
    			$descripcion = $notification_info->user_first_name." ".$notification_info->user_last_name." entregó un reporte para ".$notification_info->nombre_proyecto;
    			echo insertNotification('1', '1', $descripcion);
    		}
    		return $con->insert_id;
    	}
    	else {
    		return $query;
    	}
	}

        $eventosql =  "SELECT e.*, u.* FROM evento e INNER JOIN users u ON (users.user_id = evento.users_user_id) INNER JOIN reporte ON (reporte.evento_evento_id = evento.evento_id AND reporte.reporte_id = $reporteid)";
        if ($evento = $con->query($eventosql)) {
            $nombre = $evento->fetch_object()->user_first_name." ".$evento->fetch_object()->user_last_name;
             $logssql = "INSERT INTO `gemar`.`logs`  VALUES (NULL, '-', '-', '$nombre', '$evento->fetch_object()->comprador', '$evento->fetch_object()->nombre_proyecto', '$evento->fetch_object()->orden_compra', '$evento->fetch_object()->descripcion', '$evento->fetch_object()->proveedor', '$evento->fetch_object()->HoraInicio', '0', '$evento->fetch_object()->HoraTermino', '$avance', NOW(), '$comentarios')";
            $con->query($logssql);
        }
        else{
            
        }

}

echo insertReporte($_REQUEST['reporte']);
?>
