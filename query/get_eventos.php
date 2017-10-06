<?php

include_once dirname(__FILE__) . '/conexion.php'; // archivo de conexion local

function get_eventos($iduser = null) {
	global $con;
	$array = array();

    if  ($iduser != null) {
    	//solamente eventos de un usuario

        $query = "SELECT *
        			FROM evento
        			INNER JOIN centro on (centro.centro_id = evento.centro_centro_id AND evento.users_user_id = $iduser)
        			INNER JOIN contacto on (contacto.contacto_id = evento.contacto_contacto_id)
                    ORDER BY evento.criticidad DESC, evento.HoraInicio DESC";
    }
    else {
        //administrador
        $query = "SELECT *
            FROM evento
            LEFT OUTER JOIN reporte on (evento.evento_id = reporte.evento_evento_id)
            LEFT OUTER JOIN equipos on (reporte.reporte_id = equipos.reporte_reporte_id)
            LEFT OUTER JOIN asistentes on (reporte.reporte_id = asistentes.reporte_reporte_id)
            LEFT OUTER JOIN documentos on (reporte.reporte_id = documentos.reporte_reporte_id)
            LEFT OUTER JOIN pendientes on (reporte.reporte_id = pendientes.reporte_reporte_id)
            LEFT OUTER JOIN fotografias on (reporte.reporte_id = fotografias.reporte_reporte_id)
            INNER JOIN centro on (centro.centro_id = evento.centro_centro_id)
            INNER JOIN contacto on (contacto.contacto_id = evento.contacto_contacto_id)
            ORDER BY evento.criticidad DESC, evento.HoraInicio DESC";
    }
        
    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	$result->close();

    return $array;
}

?>