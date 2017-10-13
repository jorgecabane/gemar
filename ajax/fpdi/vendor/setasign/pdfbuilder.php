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

//variables del header
$title = "REPORTE DE INSPECCIÓN RI- XX";
$subtitle = "ORDEN DE COMPRA  X00XXX COMPONENTE – PROVEEDOR";

//define nombre de arrays
$reporte = get_reporte($idreporte);
$reportedata = $reporte['reporte'];
$reporteequipos = $reporte['equipos'];
$reporteasistentes = $reporte['asistentes'];
$reportedocumentos = $reporte['documentos'];
$reportependientes = $reporte['pendientes'];
$reportefotografias = $reporte['fotografias'];

//define variables para llenar form 1
$comprador = "Pepito Pereira";
$cliente = "Juan Rodriguez";
$orden = $reportedata[0]->orden_compra;
$direccion = $reportedata[0]->direccion;
$contacto = $reportedata[0]->nombre;
$telefono = $reportedata[0]->telefono;
$fecha = date('d/m/Y', strtotime($reportedata[0]->fecha));
$proveedor = "Empresa Provedora";
$proyecto = $reportedata[0]->nombre_proyecto;
$cargo = $reportedata[0]->cargo;
$subcontratista = "Empresa subcontratista";
$inspector = $reportedata[0]->user_first_name." ".$reportedata[0]->user_last_name;
$fechainicio = date('d/m/Y', strtotime($reportedata[0]->HoraInicio));
$fechatermino = date('d/m/Y', strtotime($reportedata[0]->HoraTermino));
$jornada = jornada($reportedata[0]->horario_trabajado);
$inspeccion = $reportedata[0]->tipo_inspeccion;
$resumen = $reportedata[0]->resumen;



// initiate FPDI
$pdf = new FPDI();
//$pdf->SetAutoPageBreak(true, 40);

//first page (form)
add_page($pdf, 1, $title, $subtitle);
fill_form($pdf, $comprador, $cliente, $orden, $direccion, $contacto, $telefono, $fecha, $proveedor, $proyecto, $cargo, $subcontratista, $inspector, $fechainicio, $fechatermino, $jornada, $inspeccion, $resumen);

//second page (resumen)
add_page($pdf, 2, $title, $subtitle);
$pdf = fill_resumen($pdf, $reportedata);
$pdf = fill_alertas($pdf, $reportedata[0]->alertas);
$pdf = fill_alcances($pdf, $reportedata[0]->alcances);
$pdf = fill_equipos($pdf, $reporteequipos);

//second page (asistentes, documentos)
add_page($pdf, 2, $title, $subtitle);
$pdf = fill_asistentes($pdf, $reporteasistentes);
$pdf = fill_documentos($pdf, $reportedocumentos);

//second page (pendientes, registro fotografico)
add_page($pdf, 2, $title, $subtitle);
$pdf = fill_pendientes($pdf, $reportependientes);
//$pdf = fill_fotografias($pdf, $reportefotografias);

//show pdf
if($download){
	$pdf->Output('D', 'reporte'.$idreporte.'.pdf');	
}
else{
	$pdf->Output();	
}