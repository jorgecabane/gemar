<?php

include_once dirname(__FILE__) . '/conexion.php'; // archivo de conexion local

function get_jornadas() {
	global $con;
	$array = array();
	$date = date('Y-m-00');
	
	$query = "SELECT COUNT(i.inspeccion_id) AS media_jornada
			FROM inspeccion i
			INNER JOIN reporte r ON (i.reporte_reporte_id = r.reporte_id AND r.horario_trabajado='0.5')
			WHERE i.fecha >= $date";

	if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	
	$query = "SELECT COUNT(i.inspeccion_id) AS jornada_completa
	FROM inspeccion i
	INNER JOIN reporte r ON (i.reporte_reporte_id = r.reporte_id AND r.horario_trabajado='1')
	WHERE i.fecha >= $date";
	
	if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	
	$query = "SELECT COUNT(i.inspeccion_id) AS jornada_residente
	FROM inspeccion i
	INNER JOIN reporte r ON (i.reporte_reporte_id = r.reporte_id AND r.horario_trabajado='0')
	WHERE i.fecha >= $date";
	
	if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	
	$result->close();

	return $array;
}

?>