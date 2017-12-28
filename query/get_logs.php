<?php

include_once dirname(__FILE__) . '/conexion.php'; // archivo de conexion local

function get_logs($start, $end) {
	global $con;
	$array = array();

  
        $query = "SELECT * FROM logs
                    WHERE fecha between $start AND $end
                    ORDER BY fecha DESC";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	$result->close();

    return $array;
}    

?>