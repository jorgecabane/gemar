<?php
/*
 * get_users funcion que se conecta al a base de datos para entregar la informacion de todos los usuarios
 * o uno especifico si hay una variable $_POST['$user_id'] que indique id
 *
 */
include_once dirname(__FILE__).'/conexion.php'; // archivo de conexion local

function get_contactos($contacto_id = null, $company_id = null, $centro_id = null) {
	global $con;

	if ($contacto_id != null) { // si se utilizo la funcion con un id especifico
		$query = "SELECT *
				  FROM contacto
				  WHERE contacto_id = $contacto_id
                  ORDER BY nombre ASC";
	} 

	else if($company_id != null){ // si se indico un id para buscar solo los datos de empresa
		$query = "SELECT *
				  FROM contacto
				  WHERE company_company_id = $contacto_id
                  ORDER BY nombre ASC";
    }

	else if($centro_id != null){ // si se indico un id para buscar solo los datos de centro
		//primero hacer query para sacar de que company pertenece el centro
		$sql = "SELECT * FROM centro WHERE centro_id = $centro_id";

    	if ($res = $con->query($sql)) {
			$result_row = $result->fetch_object(); 
			$companyid = $result_row ->company_company_id;
			$res->close();
		}

		$query = "SELECT *
				  FROM contacto
				  WHERE company_company_id = $companyid
                  ORDER BY nombre ASC";
    }

    else {
    	$query = "SELECT *
				  FROM contacto
                  ORDER BY nombre ASC";
    }

    // if returns something
    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$array[] = $result_row;
		}
	}
	$result->close();
	return $array;
}

//var_dump ( get_users() );
