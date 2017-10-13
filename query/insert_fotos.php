<?php

require_once dirname(__FILE__) . '/conexion.php';

function insertFoto($foto) {
    global $con;

    $imagenpath = $foto['imagenpath'];
    $elemento = $foto['elemento'];
    $observaciones = $foto['observaciones'];
    $reporte = $foto['reporte'];

    $query = "INSERT INTO `gemar`.`fotografias`  VALUES (NULL, '$imagenpath', '$elemento', '$observaciones', '$reporte')";
  
    if ($result = $con->query($query)) {
        return $con->insert_id;
     } 
     else {
        return $query;
    }
}

echo insertFoto($_REQUEST['foto']);
?>
