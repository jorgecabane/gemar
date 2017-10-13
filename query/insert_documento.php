<?php

require_once dirname(__FILE__) . '/conexion.php';

function insertDocumento($documento) {
    global $con;

    $numero = $documento['numero'];
    $revision = $documento['revision'];
    $nombre = $documento['nombre'];
    $status = $documento['status'];
    $reporte = $documento['reporte'];

    $query = "INSERT INTO `gemar`.`documentos`  VALUES (NULL, '$numero', '$revision', '$nombre', '$status', '$reporte')";
  
    if ($result = $con->query($query)) {
        return $con->insert_id;
     } 
     else {
        return $query;
    }
}

echo insertDocumento($_REQUEST['documento']);
?>
