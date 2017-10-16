<?php

/*
 * script que hara update a un evento via ajax
 */

$idreporte = $_REQUEST['idreporte'];
$idevento = $_REQUEST['idevento'];

include_once dirname(__FILE__) . '/conexion.php'; // archivo de conexion local

function rehacerReporte($idreporte, $idevento) {
	global $con;

    $query = "UPDATE reporte SET status='1' WHERE reporte_id = '$idreporte'";
  
    if ($result = $con->query($query)) {
        return 1;  
     } 
     else {
        return $query;
    }

}

echo rehacerReporte($idreporte, $idevento);
?>
