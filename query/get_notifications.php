<?php

include_once dirname(__FILE__) . '/conexion.php'; // archivo de conexion local

function getNotifications($iduser = null) {
	global $con;
	$array = array();
	
	if($iduser == null){
		$query = "SELECT evento.nombre_proyecto, reporte.fecha, users.user_first_name, users.user_last_name
		FROM reporte
		INNER JOIN evento ON (reporte.evento_evento_id = evento.evento_id)
		INNER JOIN users ON (evento.users_user_id = users.user_id)
		LIMIT 5";
	}
	else{
		$query = "SELECT *
		FROM evento
		WHERE users_user_id = $iduser
		LIMIT 5";
	}

	if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	$result->close();

	return $array;
}



?>