<?php

require_once dirname(__FILE__) . '/conexion.php';

function insertReporte($reporte) {
    global $con;


    $rehacer = $reporte['rehacer'];
    $evento = $reporte['evento'];
    $resumen = $reporte['resumen'];
	$horario = $reporte['horario'];
    $inspeccion = $reporte['inspeccion'];
    $avance = $reporte['avance'];
    $fechacierre = $reporte['fechacierre'];
    $comentarios = $reporte['comentarios'];
    $alertas = $reporte['alertas'];
    $alcances = $reporte['alcances'];
    $conclusiones = $reporte['conclusiones'];

    if($rehacer == 1){
        $reporteid = $reporte['reporteid'];

        $query = "UPDATE reporte SET status='$rehacer' WHERE reporte_id = '$reporteid'";

        $result = $con->query($query);
    }

    $versionsql = "SELECT max(version) AS version
              FROM reporte
              WHERE evento_evento_id = $evento";
    
    // if returns something
    if ($resultversion = $con->query($versionsql)) {
        $lastversion = ($resultversion->fetch_object()->version) + 1;
    }
    else{
        $lastversion = 1;
    }
    $resultversion->close();

    $query = "INSERT INTO `gemar`.`reporte`  VALUES (NULL, '$evento', '$lastversion', NOW(), '$horario', '$inspeccion', '$avance', '$fechacierre', '$comentarios', '$alertas', '$alcances', '$conclusiones', '$resumen', 0)";
  
    if ($result = $con->query($query)) {
        return $con->insert_id;
     } 
     else {
        return $query;
    }
}

echo insertReporte($_REQUEST['reporte']);
?>
