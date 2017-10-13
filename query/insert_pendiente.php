<?php

require_once dirname(__FILE__) . '/conexion.php';

function insertPendientes($pendientes) {
    global $con;

    $numero = $pendientes['numero'];
    $descripcion = $pendientes['descripcion'];
    $pendiente = $pendientes['pendiente'];
    $comentarios = $pendientes['comentarios'];
    $reporte = $pendientes['reporte'];

    $query = "INSERT INTO `gemar`.`pendientes`  VALUES (NULL, '$numero', '$descripcion', '$pendiente', '$comentarios', '$reporte')";
  
    if ($result = $con->query($query)) {
        return $con->insert_id;
     } 
     else {
        return $query;
    }
}

echo insertPendientes($_REQUEST['pendientes']);
?>
