<?php
/**
 * Simply import all pages and different bounding boxes from different PDF documents with version 1.
 */

require_once dirname(__FILE__) . "/fpdf/fpdf.php";
require_once dirname(__FILE__) . "/fpdi/fpdi.php";
require_once dirname(__FILE__) . "/lib.php";

$idreporte = $_REQUEST['idreporte'];

$download = false;
if(isset($_REQUEST['download'])){
	$download = true;
}


//define nombre de arrays
$reporte = get_reporte($idreporte);
$reportedata = $reporte['reporte'];
$reporteequipos = $reporte['equipos'];
$reporteasistentes = $reporte['asistentes'];
$reportedocumentos = $reporte['documentos'];
$reportependientes = $reporte['pendientes'];
$reportefotografias = $reporte['fotografias'];

//Datos del Contacto
$contacto = $reportedata[0]->nombre;
$telefono = $reportedata[0]->telefono;
$cargo = $reportedata[0]->cargo;

//Datos del Evento
$fechainicio = date('d/m/Y', strtotime($reportedata[0]->HoraInicio));
$fechatermino = date('d/m/Y', strtotime($reportedata[0]->HoraTermino));
$orden = $reportedata[0]->orden_compra;
$proyecto = $reportedata[0]->nombre_proyecto;
$proveedor = $reportedata[0]->proveedor;
$comprador = $reportedata[0]->comprador;
$componente = $reportedata[0]->componente;

//Datos del Reporte
$fecha = date('d/m/Y', strtotime($reportedata[0]->fecha));
$jornada = jornada($reportedata[0]->horario_trabajado);
$inspeccion = $reportedata[0]->tipo_inspeccion;
$resumen = $reportedata[0]->resumen;
$subcontratista = $reportedata[0]->subcontratista;

$version = $reportedata[0]->version;

//Datos del Inspector
$inspector = $reportedata[0]->user_first_name." ".$reportedata[0]->user_last_name;

//Datos de la Empresa
$cliente = $reportedata[0]->empresa; //nombre de la empresa
$imgempresa = $reportedata[0]->imgempresa;

//Datos del Centro
$direccion = $reportedata[0]->lugar; // se puede poner mas de una direccion

//variables del header
$title = "REPORTE DE INSPECCIÓN RI- ". $version;
$subtitle = "ORDEN DE COMPRA ". $orden_compra ." ". $componente ." – ". $proveedor;

// initiate FPDI
$pdf = new FPDI();
//$pdf->SetAutoPageBreak(true, 40);

//first page (form)
add_page($pdf, 1, $title, $subtitle, $imgempresa);
fill_form($pdf, $comprador, $cliente, $orden, $direccion, $contacto, $telefono, $fecha, $proveedor, $proyecto, $cargo, $subcontratista, $inspector, $fechainicio, $fechatermino, $jornada, $inspeccion, $resumen);

//second page (resumen)
add_page($pdf, 2, $title, $subtitle, $imgempresa);
$pdf = fill_resumen($pdf, $reportedata);
$pdf = fill_alertas($pdf, $reportedata[0]->alertas);
$pdf = fill_alcances($pdf, $reportedata[0]->alcances);
$pdf = fill_equipos($pdf, $reporteequipos);

//third page (asistentes, documentos)
add_page($pdf, 2, $title, $subtitle, $imgempresa);
$pdf = fill_asistentes($pdf, $reporteasistentes);
$pdf = fill_documentos($pdf, $reportedocumentos);

//fourth page (pendientes, registro fotografico)
add_page($pdf, 2, $title, $subtitle, $imgempresa);
$pdf = fill_pendientes($pdf, $reportependientes);
$pdf = fill_fotografias($pdf, $reportefotografias, $title, $subtitle, $imgempresa);

//show pdf
if($download){
	$pdf->Output('D', 'reporte'.$idreporte.'.pdf');	
}
else{
	$pdf->Output();	
}