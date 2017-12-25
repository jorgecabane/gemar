<?php

include_once dirname(__FILE__) . '/conexion.php'; // archivo de conexion local

function get_logs($start, $end) {
	global $con;
	$array = array();

  
        $query = "SELECT *
            FROM evento
            INNER JOIN users on (users.user_id = evento.users_user_id) 
            INNER JOIN reporte on (evento.evento_id = reporte.evento_evento_id )
            INNER JOIN centro on (centro.centro_id = evento.centro_centro_id)
            WHERE reporte.status IN (0,2) AND MONTH(reporte.fecha) = $month AND YEAR(reporte.fecha) = $year 
            ORDER BY evento.criticidad DESC, evento.HoraInicio DESC, reporte.version DESC";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	$result->close();

    return $array;
}

?>