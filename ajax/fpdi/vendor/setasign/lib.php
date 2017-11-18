<?php

require_once dirname(__FILE__) . "/../../../../query/conexion.php";

function fill_alertas($pdf, $alertas){
	$x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY(10 , $y + 10);
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Write(0, utf8_decode("2.   ALERTAS:"));
	$pdf->SetXY(10 , $y +20);
	$pdf->SetFont('Arial', '', 11);
    $pdf->MultiCell(190, 20, utf8_decode($alertas), 1, 'J', false);
    return $pdf;
}

function fill_alcances($pdf, $alcances){
	$x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY(10 , $y + 10);
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Write(0, utf8_decode("3.   ALCANCES DE LA INSPECCIÓN:"));
	$pdf->SetXY(10 , $y +20);
	$pdf->SetFont('Arial', '', 11);
    $pdf->MultiCell(190, 20, utf8_decode($alcances), 1, 'J', false);
    return $pdf;
}

function fill_resumen($pdf, $resumen){
	$headers = array("Avance Fabricación", "Fecha estimada cierre", "Comentarios");
	$pdf = resumen_table($pdf, $headers, $resumen);
	return $pdf;
}

function fill_equipos($pdf, $data){
	if(check_empty($data)){
		return $pdf;
	}
	else{
		$headers = array("N°", "TAG EQUIPO", "DESCRIPCIÓN", "PROVEEDOR", "COMENTARIO");
		$title = utf8_decode("3.1.-   SUMINISTRO INTEGRACIÓN EQUIPO / AVANCE DE FABRICACIÓN: DE ACUERDO AL ITEMNIZADO DE LA PO");
	    $w = array(10, 30, 30, 30, 90);
		$pdf = generic_table($pdf, $headers, $data, $w, $title, true);
		return $pdf;
	}
}	

function fill_asistentes($pdf, $data){
	if(check_empty($data)){
		return $pdf;
	}
	else{
		$headers = array("Nombre", "Compañía", "Cargo");
		$title = utf8_decode("4.   ASISTENTES");
	    $w = array(65, 62, 63);
		$pdf = generic_table($pdf, $headers, $data, $w, $title, false);
		return $pdf;
	}
}

function fill_documentos($pdf, $data){
	if(check_empty($data)){
		return $pdf;
	}
	else{
		$headers = array("Nº del Documento", "Revisión", "Nombre del Documento", "Status de aprobación");
		$title = utf8_decode("5.   DOCUMENTOS UTILIZADOS");
	    $w = array(40, 20, 70, 60);
		$pdf = generic_table($pdf, $headers, $data, $w, $title, false);
		return $pdf;
	}
}

function fill_pendientes($pdf, $data){
	if(check_empty($data)){
		return $pdf;
	}
	else{
		$headers = array("Nº", "Nº de Doc.", "Descripción", "Pendientes- NCR- Deficiencias", "Comentarios");
		$title = utf8_decode("6.   LISTADO DE PENDIENTES, DEFICIENCIAS NOTADAS – NO CONFORMIDADES.");
	    $w = array(12, 30, 43, 60, 45);
		$pdf = generic_table($pdf, $headers, $data, $w, $title, true);
		return $pdf;
	}
}


function fill_fotografias($pdf, $data, $pdftitle, $pdfsubtitle, $imgempresa){
	if(check_empty($data)){
		return $pdf;
	}
	else{
		$title = utf8_decode("8.   REGISTRO FOTOGRAFICO");
		$pdf = fotografias_table($pdf, $data, $title, $pdftitle, $pdfsubtitle, $imgempresa);
		return $pdf;
	}
}

function fotografias_table($pdf, $data, $title, $pdftitle, $pdfsubtitle, $imgempresa){
	//Bold
	$pdf->SetFont('Arial', 'B', 11);
	//titulo
	$y=$pdf->GetY();
	$pdf->SetXY(10, $y + 20);
    $pdf->MultiCell(190,7, $title, 0, 'L', false);

    // Colors, line width and bold font
	$pdf->SetXY(10, $y + 35);
    $pdf->SetDrawColor(191,189,189);
    $pdf->SetLineWidth(.2);
	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
 	$pdf->SetFont('Arial','', 9);

 	//print_r($data);
 	$actual = 1;
 	$count = 1;
 	foreach($data as $row){
 		if($actual == 1){
			$pdf->Image('../images/reportes/'.$row->imagen_path,10,$y,40);	
			$actual++;
 		}
 		else{
 			$pdf->Image('../images/reportes/'.$row->imagen_path,80,$y,40);	
 			$actual = 1;
 		}

 		$count++;
 		if($count%4 == 0){
			add_page($pdf, 2, $title, $subtitle, $imgempresa);
		}
	}
 	return $pdf;

}

function generic_table($pdf, $header, $data, $w, $title, $firstnumeric)
{
	//Bold
	$pdf->SetFont('Arial', 'B', 11);
	//titulo
	$y=$pdf->GetY();
	$pdf->SetXY(10, $y + 20);
    $pdf->MultiCell(190,7, $title, 0, 'L', false);

    // Colors, line width and bold font
	$pdf->SetXY(10, $y + 35);
    $pdf->SetFillColor(46, 116, 181);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(191,189,189);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B', 11);

    // Header
    for($i=0;$i<count($header);$i++){
    	$x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell($w[$i],7,utf8_decode($header[$i]), 1, 'C', true);
        $pdf->SetXY($x+$w[$i],$y);
    }
    $pdf->Ln();

    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
 	$pdf->SetFont('Arial','', 9);
    // Data
    $fill = false;
    $num = 1;
    foreach($data as $row)
    {	

    	$row = array_values(get_object_vars($row));
    	$objects = count($row);

    	if($firstnumeric){
	    	$x=$pdf->GetX();
	        $y=$pdf->GetY();
	        $pdf->MultiCell($w[0],20,$num,1,'C',$fill);
	        $pdf->SetXY($x+$w[0],$y);

	        $count = 1;
        }
        else {
        	$count = 0;
        }
        
        for ($i = 1; $i < $objects -1; $i++){        
	    	$x=$pdf->GetX();
	        $y=$pdf->GetY();
	        $pdf->Cell($w[$count],20, $row[$i],1,2,'C',$fill);
	        $pdf->SetXY($x+$w[$count],$y);
	    	$count++; 
    	}
                
    	$pdf->Ln();
        $fill = !$fill;
        $count = 0;
        $num ++;

    }
    //$pdf->Ln();
    // Closing line
    $pdf->Cell(array_sum($w),0,'','T');
    return $pdf;
}

function jornada($jornadaid){
	switch ($jornadaid) {
	    case 0:
	        $txt = "Residente";
	        break;
	    case 0.5:
	        $txt = "Media Jornada";
	        break;
	    case 1:
	        $txt = "Jornada Completa";
	        break;
	}
	return $txt;
}

function get_reporte($reporteid){
	global $con;

	$reporte = array();

	$reporte = array();	
	$equipos = array();	
	$asistentes = array();	
	$documentos = array();	
	$pendientes = array();
	$fotografias = array();		

	//get reporte
	$query = "SELECT evento.orden_compra, evento.nombre_proyecto, evento.HoraInicio, evento.HoraTermino, evento.proveedor, evento.comprador, evento.componente, reporte.subcontratista, reporte.version, reporte.fecha, reporte.horario_trabajado, reporte.tipo_inspeccion, reporte.resumen, contacto.nombre, contacto.telefono, contacto.cargo, users.user_first_name, users.user_last_name, company.nombre AS empresa, company.logopath AS imgempresa, centro.direccion AS lugar, reporte.avance, reporte.fecha_estimada_cierre, reporte.comentarios, reporte.alertas, reporte.alcances
			  FROM reporte
			  INNER JOIN evento on (evento.evento_id = reporte.evento_evento_id AND reporte.reporte_id = $reporteid)
			  INNER JOIN contacto on (contacto.contacto_id = evento.contacto_contacto_id)
			  INNER JOIN users on (users.user_id = evento.users_user_id)
			  INNER JOIN centro on (centro.centro_id = evento.centro_centro_id)
			  INNER JOIN company on (centro.company_company_id = company.company_id)";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$reporte[] = $result_row;
		}
	}
	$result->close();

	//get equipos
	$query = "SELECT *
			  FROM equipos
			  WHERE reporte_reporte_id = $reporteid";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$equipos[] = $result_row;
		}
	}
	$result->close();

	//get asistentes
	$query = "SELECT *
			  FROM asistentes
			  WHERE reporte_reporte_id = $reporteid";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$asistentes[] = $result_row;
		}
	}
	$result->close();

	//get documentos
	$query = "SELECT *
			  FROM documentos
			  WHERE reporte_reporte_id = $reporteid";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$documentos[] = $result_row;
		}
	}
	$result->close();

	//get pendientes
	$query = "SELECT *
			  FROM pendientes
			  WHERE reporte_reporte_id = $reporteid";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$pendientes[] = $result_row;
		}
	}
	$result->close();

	//get fotografias
	$query = "SELECT *
			  FROM fotografias
			  WHERE reporte_reporte_id = $reporteid";

    if ($result = $con->query($query)) {
		while ( $result_row = $result->fetch_object() ) {
			$fotografias[] = $result_row;
		}
	}
	$result->close();

	$array = array("reporte" => $reporte, "equipos" => $equipos, "asistentes" => $asistentes, "documentos" => $documentos, "pendientes" => $pendientes, "fotografias" => $fotografias);

	return $array;
}


function resumen_table($pdf, $header, $data)
{
	//Bold
	$pdf->SetFont('Arial', 'B', 11);
	//titulo
	$pdf->SetXY(10, 50);
	$pdf->Write(0, utf8_decode("1.   RESUMEN:"));

    // Colors, line width and bold font
	$pdf->SetXY(10, 60);
    $pdf->SetFillColor(46, 116, 181);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(191,189,189);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');
    // Header
    $w = array(44, 50, 96);
    for($i=0;$i<count($header);$i++){
    	$x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell($w[$i],10,utf8_decode($header[$i]), 1, 'C', true);
        $pdf->SetXY($x+$w[$i],$y);
    }
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = false;

    $count = 0;
    foreach($data as $row)
    {	
    	$x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell($w[0],10,$row->avance."%",1,'C',$fill);
        $pdf->SetXY($x+$w[$count],$y);

    	$x=$pdf->GetX();
        $y=$pdf->GetY();
    	$count++;

    	$timestamp = strtotime($row->fecha_estimada_cierre);
		$date = date('d/m/Y', $timestamp);
        $pdf->MultiCell($w[1],10,$date,1,'C',$fill);
        $pdf->SetXY($x+$w[$count],$y);
                
    	$x=$pdf->GetX();
        $y=$pdf->GetY();
    	$count++; 
        $pdf->MultiCell($w[2],10,$row->comentarios,1,'C',$fill);

        $pdf->SetXY($x+$w[$count],$y);
                
        $fill = !$fill;

    }
    $pdf->Ln();
    // Closing line
    $pdf->Cell(array_sum($w),0,'','T');
    return $pdf;
}

function fill_form ($pdf, $comprador, $cliente, $orden, $direccion, $contacto, $telefono, $fecha, $proveedor, $proyecto, $cargo, $subcontratista, $inspector, $fechainicio, $fechatermino, $jornada, $inspeccion, $resumen){
	//letra normal
	$pdf->SetFont('Arial', '', 10);
	$pdf->SetTextColor(0, 0, 0);

	//comprador
	$pdf->SetXY(39, 50);
	$pdf->Write(0, utf8_decode($comprador));

	//cliente final
	$pdf->SetXY(39, 59);
	$pdf->Write(0, utf8_decode($cliente));

	//orden compra
	$pdf->SetXY(39, 68);
	$pdf->Write(0, utf8_decode($orden));

	//direccion
	$pdf->SetXY(39, 78);
	$pdf->Write(0, utf8_decode($direccion));

	//contacto
	$pdf->SetXY(39, 86);
	$pdf->Write(0, utf8_decode($contacto));

	//telefono
	$pdf->SetXY(39, 91);
	$pdf->Write(0, utf8_decode($telefono));

	//fecha
	$pdf->SetXY(147, 50);
	$pdf->Write(0, utf8_decode($fecha));

	//proveedor
	$pdf->SetXY(124, 59);
	$pdf->Write(0, utf8_decode($proveedor));

	//proyecto
	$pdf->SetXY(117, 68);
	$pdf->Write(0, utf8_decode($proyecto));

	//cargo
	$pdf->SetXY(87, 91);
	$pdf->Write(0, utf8_decode($cargo));

	//subcontratistas
	$pdf->SetXY(72, 99);
	$pdf->Write(0, utf8_decode($subcontratista));

	//Inspector
	$pdf->SetXY(47, 106);
	$pdf->Write(0, utf8_decode($inspector));

	//fecha inicio
	$pdf->SetXY(47, 113);
	$pdf->Write(0, utf8_decode($fechainicio));

	//fecha termino
	$pdf->SetXY(115, 113);
	$pdf->Write(0, utf8_decode($fechatermino));

	//jornada
	$pdf->SetXY(47, 121);
	$pdf->Write(0, utf8_decode($jornada));

	//tipo inspeccion 78 -- 7 -- 13 -- 20
	switch ($inspeccion) {
	    case 1:
	        $sum = 0;
	        break;
	    case 2:
	        $sum = 7;
	        break;
	    case 3:
	        $sum = 13;
	        break;
	    case 4:
	        $sum = 20;
        break;
	}

	$pdf->SetXY(190, 78+$sum);
	$pdf->Write(0, utf8_decode("X"));

	//actividad resumida
	$pdf->SetXY(147, 115);
	$pdf->Write(0, utf8_decode($resumen));
}

function add_page($pdf, $page, $title, $subtitle, $imgempresa){
	// add a page
	$pdf->AddPage();
	// set the source file
	$pdf->setSourceFile(dirname(__FILE__) ."/template.pdf");
	// import page 1
	$tplIdx = $pdf->importPage($page);
	// use the imported page and place it at point 10,10 with a width of 100 mm
	$pdf->useTemplate($tplIdx, -3, 0);

	draw_header($pdf, $title, $subtitle);

	$pdf->Image('../images/empresas/'.$imgempresa,159,20, 40);
}

function draw_header($pdf, $title, $subtitle) {
	//Bold
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->SetTextColor(0, 0, 0);

	//titulo
	$pdf->SetXY(62, 23);
	$pdf->Write(0, utf8_decode($title));

	//subtitulo
	$pdf->SetXY(41, 30);
	$pdf->Write(0, utf8_decode($subtitle));
}

function check_empty($array){
	if(count($array) == 0){
		//empty
		return true;
	}
	else{
		//not empty
		return false;
	}

}