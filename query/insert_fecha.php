<?php

require_once dirname(__FILE__) . '/conexion.php';

function insertFechaInspeccion($inspeccion) {
	global $con;

	$inspeccionid = $inspeccion['inspeccionid'];
	$fecha = $inspeccion['fecha'];
	$reporte = $inspeccion['reporte'];

	if(is_null($inspeccionid)){
		$query = "INSERT INTO `gemar`.`inspeccion`  VALUES (NULL, '$fecha','$reporte')";
	}
	else{
		$query = "UPDATE inspeccion SET
		fecha='$fecha'
		WHERE inspeccion_id = '$inspeccionid'";
	}

	if ($result = $con->query($query)) {
		return $con->insert_id;
	}
	else {
		return $query;
	}
}

echo insertFechaInspeccion($_REQUEST['inspeccion']);
?>
