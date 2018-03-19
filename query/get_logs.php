<?php

include_once dirname(__FILE__) . '/conexion.php'; // archivo de conexion local

function get_logs() {
	global $con;
	$array = array();

  
        $query = "SELECT * 
        		FROM logs
                ORDER BY fecha DESC";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	$result->close();

    return $array;
}

if($_REQUEST['json'] == 1)
	echo json_encode(get_logs());

?>