<?php

require_once dirname(__FILE__) . '/conexion.php';

function insertEquipo($equipo) {
    global $con;

    $tag = $equipo['tag'];
    $descripcion = $equipo['descripcion'];
    $proveedor = $equipo['proveedor'];
    $comentario = $equipo['comentario'];
    $reporte = $equipo['reporte'];

    $query = "INSERT INTO `gemar`.`equipos`  VALUES (NULL, '$tag', '$descripcion', '$proveedor', '$comentario', '$reporte')";
  
    if ($result = $con->query($query)) {
        return $con->insert_id;
     } 
     else {
        return $query;
    }
}

echo insertEquipo($_REQUEST['equipo']);
?>
