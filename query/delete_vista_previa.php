<?php

require_once dirname(__FILE__) . '/conexion.php';

function deleteVistaPrevia($idreporte) {
	global $con;
	$query = "DELETE FROM reporte WHERE reporte_id = $idreporte";
	$query_equipos = "DELETE FROM equipos WHERE reporte_reporte_id = $idreporte";
	$query_asistentes = "DELETE FROM asistentes WHERE reporte_reporte_id = $idreporte";
	$query_documentos = "DELETE FROM documentos WHERE reporte_reporte_id = $idreporte";
	$query_pendientes = "DELETE FROM pendiente WHERE reporte_reporte_id = $idreporte";
	$query_fotos = "DELETE FROM fotografias WHERE reporte_reporte_id = $idreporte";
	
	if ($result = $con->query($query)) {
		$con->query($query_equipos);
		$con->query($query_asistentes);
		$con->query($query_documentos);
		$con->query($query_pendientes);
		$con->query($query_fotos);
	}
	else {
		return $query;
	}
}

//echo deleteVistaPrevia($_REQUEST['idreporte']);

?>