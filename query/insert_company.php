<?php

require_once dirname(__FILE__) . '/conexion.php';

function insertEvento($nombre, $rut, $giro, $direccion, $comuna, $ciudad, $razonsocial, $mail, $logopath = null) {
    global $con;

    $query = "INSERT INTO `gemar`.`company`  VALUES (NULL, '$nombre', '$rut', '$giro', '$direccion', '$comuna', '$ciudad', '$razonsocial', '$mail', '$logopath')";
  
    if ($result = $con->query($query)) {
        $result->close();
        return $con->insert_id;
     } 
     else {
        $result->close();
        return $query;
    }
}

if(isset($_REQUEST['logopath'])){
    $logopath = $_REQUEST['logopath'];
}
else {
    $logopath = null;
}

echo insertEvento($_REQUEST['nombre'], $_REQUEST['rut'], $_REQUEST['giro'], $_REQUEST['direccion'], $_REQUEST['comuna'], $_REQUEST['ciudad'] , $_REQUEST['razonsocial'], $_REQUEST['mail'], $logopath);
?>
