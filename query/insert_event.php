<?php

/**
 * @param {int} : $idTM [mandatory]
 * @param {int} : $idEco [mandatory]
 * @param {string} : $start [mandatory] ('YYYY-MM-DDTHH:mm:ss')
 * @param {string} : $end [mandatory] ('YYYY-MM-DDTHH:mm:ss')
 * @return {int} : numero del evento ingresado
 * Funcion recibe los datos de un evento para ingresarlo en la base de datos, retorna
 * 1 si success o 0 si fail
 */
require_once dirname(__FILE__) . '/conexion.php';

function insertEvento($idTM, $idEco, $start, $end) {
    global $con;

    $newStart = explode('T', $start);
    $newEnd = explode('T', $end);
    $newStart = $newStart[0] . ' ' . $newStart[1];
    $newEnd = $newEnd[0] . ' ' . $newEnd[1];

    $query = "INSERT INTO evento (TM_idTM, Ecos_idEcos, HoraInicio, HoraTermino) VALUES ($idTM,$idEco,'$newStart', '$newEnd')";
    $con->query($sql);
    $result = mysql_query($query);
    if ($result) {
        return $con->insert_id();
    } else {
        return $query;
    }
}

?>
