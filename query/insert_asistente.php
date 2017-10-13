<?php

require_once dirname(__FILE__) . '/conexion.php';

function insertAsistentes($asistentes) {
    global $con;

    $nombre = $asistentes['nombre'];
    $company = $asistentes['company'];
    $cargo = $asistentes['cargo'];
    $reporte = $asistentes['reporte'];

    $query = "INSERT INTO `gemar`.`asistentes`  VALUES (NULL, '$nombre', '$company', '$cargo', '$reporte')";
  
    if ($result = $con->query($query)) {
        return $con->insert_id;
     } 
     else {
        return $query;
    }
}

echo insertAsistentes($_REQUEST['asistentes']);
?>
