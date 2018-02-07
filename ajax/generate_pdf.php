<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(isset($_REQUEST["vista_previa"])){
	$vp = $_REQUEST["vista_previa"];
	$reporte = $_REQUEST["reporte"];
}
else{
	$idreporte = $_REQUEST["idreporte"];
	$vp = 0;
}

use setasign\Fpdi;

// setup the autoload function
require_once dirname(__FILE__) . "/fpdi/src/autoload.php";
require_once dirname(__FILE__) . "/fpdf/fpdf.php";
require_once dirname(dirname(__FILE__)) . "/query/get_pdfdata.php";
require_once dirname(dirname(__FILE__)) . "/query/get_extras.php";
require_once dirname(dirname(__FILE__)) . "/query/delete_vista_previa.php";
require_once dirname(__FILE__) . "/table.php";

if($vp == 0){
	$data = getPdfData($idreporte)[0]; //$data[0]->resumen
	$extras = getExtras($idreporte);
}
else{
	$rawdata = json_decode($reporte);
	$data1 = $rawdata->data;
	$data2 = getPdfData(null, $data1->evento)[0];
	$data = (object) array_merge((array) $data1, (array) $data2);
	$extras = (array) $rawdata->extras;
	//var_dump($extras);
	//die();
}
$fechaInicio = explode("-",explode(" ",$data->HoraInicio)[0]);
$fechaTermino = explode("-", explode(" ",$data->HoraTermino)[0]);
$horarioTrabajado = (($data->horario_trabajado == 1) ? "Jornada Completa" : ($data->horario_trabajado == 0.5 ? "Media jornada" : "Residente"));
$tipoVisita = ["","","",""];
$tipoVisita[$data->tipo_inspeccion-1] = "X";
$fechaEstimadaCierre = explode("-", explode(" ",$data->fecha_estimada_cierre)[0]);
$logo = dirname(dirname(__FILE__)) . "/images/login-logo.png";
$logo2 = dirname(dirname(__FILE__)) . "/images/empresas/".$data->logopath;
$fotos_path = dirname(dirname(__FILE__)) . "/images/reportes/";

$pdf = new PDF_MC_Table();
$heigth = $pdf->GetPageHeight();
$width = $pdf->GetPageWidth();
$row = array();
//Page 1
newPage($pdf, $data, $logo, $logo2, $vp);

//Tabla inicial - cabeceras
$row[1] = array("Comprador Activador", $data->comprador, "Fecha", "Fecha inspeccion"); //Aca va la fecha de la inspección
$row[2] = array("Cliente Final", $data->nombre, "Proveedor", $data->proveedor);
$row[3] = array("Orden de Compra", $data->orden_compra,"Proyecto", $data->nombre_proyecto, "Tipo de inspección");
$row[4] = array("Dirección", $data->direccion.", ".$data->comuna.", ".$data->ciudad, "Visita Semanal", $tipoVisita[0]);
$row[5] = array("Contacto",$data->contacto_centro,"Visita Spot",$tipoVisita[1]);
$row[6] = array("Teléfono",$data->telefono_contacto, "Cargo",$data->cargo_contacto,"Inspección Residente",$tipoVisita[2]);
$row[7] = array("Subcontratista del proveedor",$data->subcontratista,"Final y despacho",$tipoVisita[3]);
$row[8] = array("Inspector", $data->user_first_name." ".$data->user_last_name, "Resumen");
$row[9] = array("Fecha Inicio", $fechaInicio[2]."/".$fechaInicio[1]."/".$fechaInicio[0],"Fecha Término",$fechaTermino[2]."/".$fechaTermino[1]."/".$fechaTermino[0]);
$row[10] = array("Horario de Trabajo", $horarioTrabajado);
//$data->resumen
$y = $pdf->tableRow(10, 50, ($width-20), $row[1], array(0.2,0.35,0.2,0.25), array("B","","B",""), 10);
$y = $pdf->tableRow(10, $y, ($width-20), $row[2], array(0.2,0.35,0.2,0.25), array("B","","B",""), 10);
$y = $pdf->tableRow(10, $y, ($width-20), $row[3], array(0.2,0.2,0.15,0.2,0.25), array("B","","B","","B"), 10);
$y = $pdf->tableRow(10, $y, ($width-20), $row[4], array(0.2,0.55,0.2,0.05), array("B","","","B"), 10);
$y = $pdf->tableRow(10, $y, ($width-20), $row[5], array(0.2,0.55,0.2,0.05), array("B","","","B"), 10);
$y = $pdf->tableRow(10, $y, ($width-20), $row[6], array(0.2,0.2,0.15,0.2,0.2,0.05), array("B","","B","","","B"), 10);
$y = $pdf->tableRow(10, $y, ($width-20), $row[7], array(0.2,0.55,0.2,0.05), array("B","","","B"), 10);
$y = $pdf->tableRow(10, $y, ($width-20), $row[8], array(0.2,0.4,0.4), array("B","","B"), 10);
$y1 = $y;
$y = $pdf->tableRow(10, $y, ($width-20)*0.6, $row[9], array(0.335,0.1825,0.3,0.1825), array("B","","B",""), 10);
$y = $pdf->tableRow(10, $y, ($width-20)*0.6, $row[10], array(0.335,0.665), array("B",""), 10);
$h = $y - $y1;
$y = $pdf->summaryCell($y1, ($width-20), $data->resumen, $h, 0.4);
//Indice
$y=165;
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(($width/2)-25,$y);
$y+=10;
$pdf->Cell(0,10,utf8_decode("TABLA DE CONTENIDOS"),0,0,"L");
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("1.\n2.\n3.\n4.\n5.\n6.\n7.\n8."),0,"L");
$pdf->SetXY(40,$y);
$pdf->MultiCell(0,10,utf8_decode("Resumen:\nAlertas:\nAlcances de la inspección:\nAsistentes:\nDocumentos utilizados:\nListado de pendientes, deficiencias notadas - No comformidades:\nResultados finales/Conclusiones:\nRegistro fotográfico:"),0,"L");
$pdf->SetXY(190,$y);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("1\n2\n3\n4\n5\n6\n7\n8"),0,"L");

//Pagina 2
$y = 0;
newPage($pdf, $data, $logo, $logo2, $vp);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y=50;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("1. Resumen:"),0,"L");
$pdf->SetFont('Arial','',10);
$pdf->SetXY(20,60);
$pdf->MultiCell($width-40,5,utf8_decode("En este cuadro deben indicar el porcentaje de avance del proyecto de acuerdo a vuestra evaluación. Fecha de término de orden de compra estimada por ustedes y comentarios generales resumen de actividades de esta orden de compra."),0,"J");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$y=80;
$dat = array("Avance Fabricación","Fecha estimada \n de cierre","Comentarios");
$y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.2,0.25,0.55), array("B","B","B"), 10);
$pdf->SetFillColor(235);
$pdf->SetTextColor(0);
$pdf->SetXY(20,90);
$dat = array($data->avance."%", $fechaEstimadaCierre[2]."/".$fechaEstimadaCierre[1]."/".$fechaEstimadaCierre[0], $data->comentarios);
$y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.2,0.25,0.55), array("","",""), 10);
$pdf->SetXY(20,$y+=20);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("2. Alertas:"),0,"L");
$pdf->SetXY(20,$y+=10);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell($width-40,10,utf8_decode($data->alertas),0,"J");
$pdf->SetXY(20,$y+=40);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("3. Alcances:"),0,"L");
$pdf->SetXY(20,$y+=10);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell($width-40,10,utf8_decode($data->alcances),0,"J");

//Pagina 3
newPage($pdf, $data, $logo, $logo2, $vp);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y=50;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("2.1.- SUMINISTRO INTEGRACIÓN EQUIPO / AVANCE DE FABRICACIÓN: DE ACUERDO AL ITEMNIZADO DE LA,PO"),0,"L");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$y+=15;
$y = $pdf->tableRow(20, $y, ($width-40), array("Listado de equipos"), array(1), array("B"), 10);
$dat = array("Nº", "Tag", "Descripción", "Proveedor", "Comentarios");
$y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.1,0.15,0.25,0.2,0.3), array("B","B","B","B","B"), 10);
$count = 1;
$pdf->SetFillColor(235);
$pdf->SetTextColor(0);
foreach($extras["equipos"] as $equipo){
	if($y>$heigth-50){
		newPage($pdf, $data, $logo, $logo2, $vp);
		$y = 50;
	}
	$dat = array($count, $equipo->tag, $equipo->descripcion, $equipo->proveedor, $equipo->comentario);
	$y = $y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.1,0.15,0.25,0.2,0.3), array("","","","",""), 10);
	$count++;
}
//Asistente
if($y>$heigth-50){
	newPage($pdf, $data, $logo, $logo2, $vp);
	$y=40;
}
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("4. Asistentes"),0,"L");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$y+=10;
$dat = array("Nombre", "Compañía", "Cargo");
$y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.3,0.4,0.3), array("B","B","B"), 10);
$pdf->SetFillColor(235);
$pdf->SetTextColor(0);
foreach($extras["asistentes"] as $asistente){
	if($y>$heigth-50){
		newPage($pdf, $data, $logo, $logo2, $vp);
		$y = 50;
	}
	$dat = array($asistente->nombre, $asistente->compa, $asistente->cargo);
	$y = $y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.3,0.4,0.3), array("","","",""), 10);
}
//Documentos utilizados
if($y>$heigth-50){
	newPage($pdf, $data, $logo, $logo2, $vp);
	$y=40;
}
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("5. Documentos utilizados"),0,"L");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$y+=10;
$dat = array("Nº de documento", "Revisión", "Nombre del documento", "Status de aprobación");
$y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.3,0.2,0.25,0.25), array("B","B","B","B"), 10);
$pdf->SetFillColor(235);
$pdf->SetTextColor(0);
foreach($extras["documentos"] as $documento){
	if($y>$heigth-50){
		newPage($pdf, $data, $logo, $logo2, $vp);
		$y = 50;
	}
	$dat = array($documento->numero, $documento->revision, $documento->nombre, $documento->status);
	$y = $y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.3,0.2,0.25,0.25), array("","","",""), 10);
}
//Listado de pendientes
if($y>$heigth-50){
	newPage($pdf, $data, $logo, $logo2, $vp);
	$y=40;
}
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("6. Listado de pendientes"),0,"L");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$y+=10;
$dat = array("Nº", "Nº documento", "Descripción", "Pendientes NCR-Deficiencias", "Comentarios/status/fechas");
$y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.1,0.2,0.2,0.2,0.3), array("B","B","B","B", "B"), 10);
$pdf->SetFillColor(235);
$pdf->SetTextColor(0);
$count = 1;
foreach($extras["pendientes"] as $pendiente){
	if($y>$heigth-50){
		newPage($pdf, $data, $logo, $logo2, $vp);
		$y = 50;
	}
	$dat = array($count, $pendiente->numero,$pendiente->descripcion,$pendiente->pendientes,$pendiente->comentarios);
	$y = $y = $pdf->tableRow(20, $y, ($width-40), $dat, array(0.1,0.2,0.2,0.2,0.3), array("","","","", ""), 10);
	$count++;
}
$y+=10;
//Resultados finales y conclusiones
if($y>$heigth-70){
	newPage($pdf, $data, $logo, $logo2, $vp);
	$y=50;
}
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("7. Resultados finales y conclusiones"),0,"L");
$y+=10;
$pdf->SetFont('Arial','',10);
$pdf->SetXY(20,$y);
$pdf->MultiCell($width-40,10,utf8_decode($data->conclusiones),0,"J");
//Registro fotografico
if($y>$heigth-70){
	newPage($pdf, $data, $logo, $logo2, $vp);
	$y=40;
}
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y+=20;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("8. Registro fotográfico"),0,"L");
$y+=15;
$count=1;
foreach($extras["fotografias"] as $foto){
	list($foto_width, $foto_height) = getimagesize($fotos_path.$foto->imagen_path);
	$h=round(($foto_height*($width-80)/2)/$foto_width);
	$h = $h>=80 ? 80 : $h;
	if($y+$h>$heigth-100){
		newPage($pdf, $data, $logo, $logo2, $vp);
		$y = 50;
	}
	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(0);
	$pdf->SetXY(20,$y);
	$align = ($count%2 == 0) ? 1 : 0;
	$pdf->Rect(20+$align*((20+($width-40)/2)-15),$y,(20+($width-40)/2)-25, 80);
	$pdf->Image($fotos_path.$foto->imagen_path, (27+$align*((20+($width-40)/2)-15)),$y+5, ($width-80)/2, $h);
	$y+=80;
	$pdf->SetXY(20+$align*((20+($width-40)/2)-15),$y);
	$pdf->MultiCell(((20+($width-40)/2)-25)/3,10,utf8_decode("Elemento"),1,"C");
	$pdf->SetXY(20+$align*((20+($width-40)/2)-15)+((20+($width-40)/2)-25)/3,$y);
	$pdf->MultiCell(((20+($width-40)/2)-25)*2/3,10,utf8_decode($foto->elemento),1,"C");
	$y+=10;
	$pdf->SetXY(20+$align*((20+($width-40)/2)-15),$y);
	$pdf->MultiCell(((20+($width-40)/2)-25)/3,10,utf8_decode("Observaciones"),1,"C");
	$pdf->SetXY(20+$align*((20+($width-40)/2)-15)+((20+($width-40)/2)-25)/3,$y);
	$pdf->MultiCell(((20+($width-40)/2)-25)*2/3,10,utf8_decode($foto->observaciones),1,"C");
	$y=$y-90;
	if($align == 1){
		$y+=100;
	}
	$count++;
}

$pdf->Output();

function newPage($pdf, $data, $logo, $logo2, $vp){
	$heigth = $pdf->GetPageHeight();
	$width = $pdf->GetPageWidth();
	$pdf->AddPage();
	$x = 10;
	//Header
	$pdf->SetFont('Arial','B',12);
	$pdf->SetFillColor(204,204,255);
	$pdf->SetXY($x,10);
	if($vp == 0){
		$header = array("Reporte de inspección RI-".sprintf('%02d', $data->numero_reporte)."\n"."Orden de compra ".$data->orden_compra." ".$data->componente." - ".$data->proveedor);
	}
	else{
		$header = array("Reporte de inspección RI-00\n"."Orden de compra ".$data->orden_compra." ".$data->componente." - ".$data->proveedor);
	}
	$pdf->tableRow(10, 10, $width-80, $header, array(1), array("B"), 12,true);
	$pdf->SetFillColor(255,255,255);
	$pdf->Rect($x,10, 30, 30, "DF");
	$pdf->Image($logo, 12, 12, 26);
	$pdf->Rect($width-40,10, 30, 30, "DF");
	$pdf->Image($logo2, $width-38, 12, 26, 26);
	//Footer
	$pdf->SetFont('Arial','',7);
	$pdf->SetXY($x,$heigth-30);
	$pdf->MultiCell(0,3,utf8_decode("La emisión del Reporte de inspección, no libera al Proveedor de sus responsabilidades y obligaciones bajo contrato o la ley, con respecto a los materiales y equipo descritos en este reporte de inspección. Esto no implica la aceptación de estos materiales y equipos por el comprador o Dueño."),0,"C");
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(0,0,110);
	$pdf->SetXY($x,$heigth-23);
	$pdf->MultiCell(0,2,utf8_decode("GEMAR Ingeniería y asesorías técnicas. Vespucio Sur 1117 Las Condes Celular: +56 989210647 www.gemaringenieria.cl"),0,"C");
	$pdf->SetTextColor(0);
}


