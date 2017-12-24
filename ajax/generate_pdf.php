<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$idreporte = $_REQUEST["idreporte"];

use setasign\Fpdi;

// setup the autoload function
require_once dirname(__FILE__) . "/fpdi/src/autoload.php";
require_once dirname(__FILE__) . "/fpdf/fpdf.php";
require_once dirname(dirname(__FILE__)) . "/query/get_pdfdata.php";
require_once dirname(dirname(__FILE__)) . "/query/get_extras.php";

$data = getPdfData($idreporte)[0]; //$data[0]->resumen
$extras = getExtras($idreporte);
$fechaInicio = explode("-",explode(" ",$data->HoraInicio)[0]);
$fechaTermino = explode("-", explode(" ",$data->HoraTermino)[0]);
$horarioTrabajado = (($data->horario_trabajado == 1) ? "Jornada Completa" : ($data->horario_trabajado == 0.5 ? "Media jornada" : "Residente"));
$tipoVisita = ["","","",""];
$tipoVisita[$data->tipo_inspeccion-1] = "X";
$fechaEstimadaCierre = explode("-", explode(" ",$data->fecha_estimada_cierre)[0]);
$logo = dirname(dirname(__FILE__)) . "/images/login-logo.png";
$logo2 = dirname(dirname(__FILE__)) . "/images/empresas/Collahuasi.jpg";
$fotos_path = dirname(dirname(__FILE__)) . "/images/reportes/";

$pdf = new Fpdi\Fpdi();

//Page 1
newPage($pdf, $data, $logo, $logo2);

$heigth = $pdf->GetPageHeight();
$width = $pdf->GetPageWidth();
//Tabla inicial - cabeceras
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0);
$pdf->SetXY(20,50);
$pdf->MultiCell(($width-40)/6,5,"Comprador \n Activador",1,"C");
$pdf->SetXY(20,60);
$pdf->MultiCell(($width-40)/6,5,"Cliente \n Final",1,"C");
$pdf->SetXY(20,70);
$pdf->MultiCell(($width-40)/6,5,"Orden de \n Compra",1,"C");
$pdf->SetXY(20,80);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Dirección"),1,"C");
$pdf->SetXY(20,90);
$pdf->MultiCell(($width-40)/6,10,"Contacto",1,"C");
$pdf->SetXY(20,100);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Teléfono"),1,"C");
$pdf->SetXY(20+($width-40)/2,100);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Cargo"),1,"C");
$pdf->SetXY(20,110);
$pdf->MultiCell(($width-40)/6,5,utf8_decode("Subcontratista del proveedor"),1,"C");
$pdf->SetXY(20,120);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Inspector"),1,"C");
$pdf->SetXY(20,130);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Fecha inicio"),1,"C");
$pdf->SetXY(20+($width-40)/3,130);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Fecha Término"),1,"C");
$pdf->SetXY(20+($width-40)*2/3,120);
$pdf->MultiCell(($width-40)/3,10,utf8_decode("Resumen"),1,"C");
$pdf->SetXY(20,140);
$pdf->MultiCell(($width-40)/6,5,utf8_decode("Horario de \n Trabajo"),1,"C");
$pdf->SetXY(20+($width-40)/2,50);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Fecha"),1,"C");
$pdf->SetXY(20+($width-40)/2,60);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Proveedor"),1,"C");
$pdf->SetXY(20+($width-40)/2,70);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("Proyecto"),1,"C");
$pdf->SetXY(20+($width-40)*5/6,70);
$pdf->MultiCell(($width-40)/6,5,utf8_decode("Tipo de \n inspección"),1,"C");
$pdf->SetFont('Arial','',10);
$pdf->SetXY(20+($width-40)*5/6,80);
$pdf->MultiCell(($width-40)*2/15,5,utf8_decode("Visita \n Semanal"),1,"C");
$pdf->SetXY(20+($width-40)*29/30,80);
$pdf->MultiCell(($width-40)/30,10,utf8_decode($tipoVisita[0]),1,"C");
$pdf->SetXY(20+($width-40)*5/6,90);
$pdf->MultiCell(($width-40)*2/15,5,utf8_decode("Visita \n Spot"),1,"C");
$pdf->SetXY(20+($width-40)*29/30,90);
$pdf->MultiCell(($width-40)/30,10,utf8_decode($tipoVisita[1]),1,"C");
$pdf->SetXY(20+($width-40)*5/6,100);
$pdf->MultiCell(($width-40)*2/15,5,utf8_decode("Inspección \n Residente"),1,"C");
$pdf->SetXY(20+($width-40)*29/30,100);
$pdf->MultiCell(($width-40)/30,10,utf8_decode($tipoVisita[2]),1,"C");
$pdf->SetXY(20+($width-40)*5/6,110);
$pdf->MultiCell(($width-40)*2/15,5,utf8_decode("Final \n y despacho"),1,"C");
$pdf->SetXY(20+($width-40)*29/30,110);
$pdf->MultiCell(($width-40)/30,10,utf8_decode($tipoVisita[3]),1,"C");
//Tabla inicial - datos
$pdf->SetXY(20+($width-40)/6,50);
$pdf->MultiCell(($width-40)/3,10,utf8_decode($data->comprador),1,"C");
$pdf->SetXY(20+($width-40)/6,60);
$pdf->MultiCell(($width-40)/3,10,utf8_decode($data->nombre),1,"C");
$pdf->SetXY(20+($width-40)/6,70);
$pdf->MultiCell(($width-40)/3,10,utf8_decode($data->orden_compra),1,"C");
$pdf->SetXY(20+($width-40)/6,80);
$pdf->MultiCell(($width-40)*2/3,10,utf8_decode($data->direccion.", ".$data->comuna.", ".$data->ciudad),1,"C");
$pdf->SetXY(20+($width-40)/6,90);
$pdf->MultiCell(($width-40)*2/3,10,utf8_decode($data->contacto_centro),1,"C");
$pdf->SetXY(20+($width-40)/6,100);
$pdf->MultiCell(($width-40)/3,10,utf8_decode($data->telefono_contacto),1,"C");
$pdf->SetXY(20+($width-40)*4/6,100);
$pdf->MultiCell(($width-40)/6,5,utf8_decode($data->cargo_contacto),1,"C");
$pdf->SetXY(20+($width-40)/6,110);
$pdf->MultiCell(($width-40)*2/3,10,utf8_decode($data->subcontratista),1,"C");
$pdf->SetXY(20+($width-40)/6,120);
$pdf->MultiCell(($width-40)/2,10,utf8_decode($data->user_first_name." ".$data->user_last_name),1,"C");
$pdf->SetXY(20+($width-40)/6,130);
$pdf->MultiCell(($width-40)/6,10,utf8_decode($fechaInicio[2]."/".$fechaInicio[1]."/".$fechaInicio[0]),1,"C");
$pdf->SetXY(20+($width-40)/2,130);
$pdf->MultiCell(($width-40)/6,10,utf8_decode($fechaTermino[2]."/".$fechaTermino[1]."/".$fechaTermino[0]),1,"C");
$pdf->SetXY(20+($width-40)*2/3,130);
$pdf->MultiCell(($width-40)/3,20,utf8_decode($data->resumen),1,"C");
$pdf->SetXY(20+($width-40)/6,140);
$pdf->MultiCell(($width-40)/2,10,utf8_decode($horarioTrabajado),1,"C");
$pdf->SetXY(20+($width-40)*2/3,50);
$pdf->MultiCell(($width-40)/3,10,utf8_decode(""),1,"C"); //fecha
$pdf->SetXY(20+($width-40)*2/3,60);
$pdf->MultiCell(($width-40)/3,10,utf8_decode($data->proveedor),1,"C");
$pdf->SetXY(20+($width-40)*2/3,70);
$pdf->MultiCell(($width-40)/6,10,utf8_decode($data->nombre_proyecto),1,"C");
//Indice
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(($width/2)-25,160);
$pdf->Cell(0,10,utf8_decode("TABLA DE CONTENIDOS"),0,0,"L");
$pdf->SetXY(20,170);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("1.\n2.\n3.\n4.\n5.\n6.\n7.\n8."),0,"L");
$pdf->SetXY(40,170);
$pdf->MultiCell(0,10,utf8_decode("Resumen:\nAlertas:\nAlcances de la inspección:\nAsistentes:\nDocumentos utilizados:\nListado de pendientes, deficiencias notadas - No comformidades:\nResultados finales/Conclusiones:\nRegistro fotográfico:"),0,"L");
$pdf->SetXY(190,170);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("1\n2\n3\n4\n5\n6\n7\n8"),0,"L");

//Pagina 2
newPage($pdf, $data, $logo, $logo2);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$pdf->SetXY(20,50);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("1. Resumen:"),0,"L");
$pdf->SetXY(20,110);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("2. Alertas:"),0,"L");
$pdf->SetXY(20,150);
$pdf->MultiCell(($width-40)/6,10,utf8_decode("3. Alcances:"),0,"L");
$pdf->SetFont('Arial','',10);
$pdf->SetXY(20,60);
$pdf->MultiCell($width-40,5,utf8_decode("En este cuadro deben indicar el porcentaje de avance del proyecto de acuerdo a vuestra evaluación. Fecha de término de orden de compra estimada por ustedes y comentarios generales resumen de actividades de esta orden de compra."),0,"J");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$pdf->SetXY(20,80);
$pdf->MultiCell(($width-40)/6,5,utf8_decode("Avance\nFabricación"),1,"C",1);
$pdf->SetXY(20+($width-40)/6,80);
$pdf->MultiCell(($width-40)/6+5,3.33,utf8_decode("Fecha estimada de\ncierre de orden\nde compra"),1,"J",1);
$pdf->SetXY(25+($width-40)/3,80);
$pdf->MultiCell(($width-40)*2/3-5,10,utf8_decode("Comentarios"),1,"C",1);
$pdf->SetFillColor(235);
$pdf->SetTextColor(0);
$pdf->SetXY(20,90);
$pdf->MultiCell(($width-40)/6,10,utf8_decode($data->avance."%"),1,"C",1);
$pdf->SetXY(20+($width-40)/6,90);
$pdf->MultiCell(($width-40)/6+5,10,utf8_decode($fechaEstimadaCierre[2]."/".$fechaEstimadaCierre[1]."/".$fechaEstimadaCierre[0]),1,"C",1);
$pdf->SetXY(25+($width-40)/3,90);
$pdf->MultiCell(($width-40)*2/3-5,10,utf8_decode($data->comentarios),1,"C",1);
$pdf->SetXY(20,120);
$pdf->MultiCell($width-40,10,utf8_decode($data->alertas),0,"J");
$pdf->SetXY(20,160);
$pdf->MultiCell($width-40,10,utf8_decode($data->alcances),0,"J");

//Pagina 3
newPage($pdf, $data, $logo, $logo2);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$pdf->SetXY(20,50);
$pdf->MultiCell(($width-40),5,utf8_decode("2.1.- SUMINISTRO INTEGRACIÓN EQUIPO / AVANCE DE FABRICACIÓN: DE ACUERDO AL ITEMNIZADO DE LA,PO"),0,"L");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(20,70);
$pdf->MultiCell(($width-40),10,utf8_decode("Listado de equipos"),1,"C", 1);
$pdf->SetXY(20,80);
$pdf->MultiCell(($width-40)/15,10,utf8_decode("Nº"),1,"C", 1);
$pdf->SetXY(20+($width-40)/15,80);
$pdf->MultiCell(($width-40)*2/15,10,utf8_decode("Tag"),1,"C", 1);
$pdf->SetXY(20+($width-40)*3/15,80);
$pdf->MultiCell(($width-40)*4/15,10,utf8_decode("Descripción"),1,"C", 1);
$pdf->SetXY(20+($width-40)*7/15,80);
$pdf->MultiCell(($width-40)*3/15,10,utf8_decode("Proveedor"),1,"C", 1);
$pdf->SetXY(20+($width-40)*10/15,80);
$pdf->MultiCell(($width-40)*5/15,10,utf8_decode("Comentarios"),1,"C", 1);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0);
$x = 20;
$y = 90;
$count = 1;
foreach($extras["equipos"] as $equipo){
	if($y>$heigth-50){
		newPage($pdf, $data, $logo, $logo2);
		$pdf->SetFont('Arial','',10);
		$pdf->SetTextColor(0);
		$y = 50;
	}
	$pdf->SetXY(20,$y);
	$pdf->MultiCell(($width-40)/15,10,utf8_decode($count),1,"C");
	$pdf->SetXY(20+($width-40)/15,$y);
	$pdf->MultiCell(($width-40)*2/15,10,utf8_decode($equipo->tag),1,"C");
	$pdf->SetXY(20+($width-40)*3/15,$y);
	$pdf->MultiCell(($width-40)*4/15,10,utf8_decode($equipo->descripcion),1,"C");
	$pdf->SetXY(20+($width-40)*7/15,$y);
	$pdf->MultiCell(($width-40)*3/15,10,utf8_decode($equipo->proveedor),1,"C");
	$pdf->SetXY(20+($width-40)*10/15,$y);
	$pdf->MultiCell(($width-40)*5/15,10,utf8_decode($equipo->comentario),1,"C");
	$y+=10;
	$count++;
}
//Asistente
if($y>$heigth-50){
	newPage($pdf, $data, $logo, $logo2);
	$y=40;
}
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("4. Asistentes"),0,"L");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$pdf->SetFont('Arial','B',10);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40)/3,5,utf8_decode("Nombre"),1,"C", 1);
$pdf->SetXY(20+($width-40)/3,$y);
$pdf->MultiCell(($width-40)/3,5,utf8_decode("Compañia"),1,"C", 1);
$pdf->SetXY(20+($width-40)*2/3,$y);
$pdf->MultiCell(($width-40)/3,5,utf8_decode("Cargo"),1,"C", 1);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0);
$y+=5;
foreach($extras["asistentes"] as $asistente){
	if($y>$heigth-50){
		newPage($pdf, $data, $logo, $logo2);
		$pdf->SetFont('Arial','',10);
		$pdf->SetTextColor(0);
		$y = 50;
	}
	$pdf->SetXY(20,$y);
	$pdf->MultiCell(($width-40)/3,10,utf8_decode($asistente->nombre),1,"C");
	$pdf->SetXY(20+($width-40)/3,$y);
	$pdf->MultiCell(($width-40)/3,10,utf8_decode($asistente->compa),1,"C");
	$pdf->SetXY(20+($width-40)*2/3,$y);
	$pdf->MultiCell(($width-40)/3,10,utf8_decode($asistente->cargo),1,"C");
	$y+=10;
	$count++;
}
//Documentos utilizados
if($y>$heigth-50){
	newPage($pdf, $data, $logo, $logo2);
	$y=40;
}
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("5. Documentos utilizados"),0,"L");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$pdf->SetFont('Arial','B',10);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40)*3/10,10,utf8_decode("Nº de documento"),1,"C", 1);
$pdf->SetXY(20+($width-40)*3/10,$y);
$pdf->MultiCell(($width-40)/10,10,utf8_decode("Revisión"),1,"C", 1);
$pdf->SetXY(20+($width-40)*4/10,$y);
$pdf->MultiCell(($width-40)*4/10,10,utf8_decode("Nombre del documento"),1,"C", 1);
$pdf->SetXY(20+($width-40)*8/10,$y);
$pdf->MultiCell(($width-40)*2/10,5,utf8_decode("Status de aprobación"),1,"C", 1);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0);
$y+=10;
foreach($extras["documentos"] as $documento){
	if($y>$heigth-50){
		newPage($pdf, $data, $logo, $logo2);
		$pdf->SetFont('Arial','',10);
		$pdf->SetTextColor(0);
		$y = 50;
	}
	$pdf->SetXY(20,$y);
	$pdf->MultiCell(($width-40)*3/10,10,utf8_decode($documento->numero),1,"C");
	$pdf->SetXY(20+($width-40)*3/10,$y);
	$pdf->MultiCell(($width-40)/10,10,utf8_decode($documento->revision),1,"C");
	$pdf->SetXY(20+($width-40)*4/10,$y);
	$pdf->MultiCell(($width-40)*4/10,10,utf8_decode($documento->nombre),1,"C");
	$pdf->SetXY(20+($width-40)*8/10,$y);
	$pdf->MultiCell(($width-40)*2/10,10,utf8_decode($documento->status),1,"C");
	$y+=10;
	$count++;
}
//Listado de pendientes
if($y>$heigth-50){
	newPage($pdf, $data, $logo, $logo2);
	$y=40;
}
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40),5,utf8_decode("6. Listado de pendientes"),0,"L");
$pdf->SetFillColor(60,135,200);
$pdf->SetTextColor(255);
$pdf->SetFont('Arial','B',10);
$y+=10;
$pdf->SetXY(20,$y);
$pdf->MultiCell(($width-40)/15,10,utf8_decode("Nº"),1,"C", 1);
$pdf->SetXY(20+($width-40)/15,$y);
$pdf->MultiCell(($width-40)*2/15,5,utf8_decode("Nº documento"),1,"C", 1);
$pdf->SetXY(20+($width-40)*3/15,$y);
$pdf->MultiCell(($width-40)*4/15,10,utf8_decode("Descripción"),1,"C", 1);
$pdf->SetXY(20+($width-40)*7/15,$y);
$pdf->MultiCell(($width-40)*3/15,5,utf8_decode("Pendientes\nNCR-Deficiencias"),1,"C", 1);
$pdf->SetXY(20+($width-40)*10/15,$y);
$pdf->MultiCell(($width-40)*5/15,10,utf8_decode("Comentarios/status/fechas"),1,"C", 1);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0);
$y+=10;
$count = 1;
foreach($extras["pendientes"] as $pendiente){
	if($y>$heigth-50){
		newPage($pdf, $data, $logo, $logo2);
		$pdf->SetFont('Arial','',10);
		$pdf->SetTextColor(0);
		$y = 50;
	}
	$pdf->SetXY(20,$y);
	$pdf->MultiCell(($width-40)/15,10,utf8_decode($count),1,"C");
	$pdf->SetXY(20+($width-40)/15,$y);
	$pdf->MultiCell(($width-40)*2/15,5,utf8_decode($pendiente->numero),1,"C");
	$pdf->SetXY(20+($width-40)*3/15,$y);
	$pdf->MultiCell(($width-40)*4/15,10,utf8_decode($pendiente->descripcion),1,"C");
	$pdf->SetXY(20+($width-40)*7/15,$y);
	$pdf->MultiCell(($width-40)*3/15,5,utf8_decode($pendiente->pendientes),1,"C");
	$pdf->SetXY(20+($width-40)*10/15,$y);
	$pdf->MultiCell(($width-40)*5/15,10,utf8_decode($pendiente->comentarios),1,"C");
	$y+=10;
	$count++;
}
$y+=10;
//Resultados finales y conclusiones
if($y>$heigth-70){
	newPage($pdf, $data, $logo, $logo2);
	$y=40;
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
	newPage($pdf, $data, $logo, $logo2);
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
		newPage($pdf, $data, $logo, $logo2);
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

function newPage($pdf, $data, $logo, $logo2){
	$heigth = $pdf->GetPageHeight();
	$width = $pdf->GetPageWidth();
	$pdf->AddPage();
	//Header
	$pdf->SetFont('Arial','B',12);
	$pdf->SetFillColor(204,204,255);
	$pdf->SetXY(20,10);
	$pdf->MultiCell($width-40,15,utf8_decode("Reporte de inspección RI-XX \n"."Orden de compra ".$data->orden_compra." ".$data->componente." - ".$data->proveedor),1,"C",true);
	$pdf->SetFillColor(255,255,255);
	$pdf->Rect(20,10, 30, 30, "DF");
	$pdf->Image($logo, 22, 12, 26);
	$pdf->Rect($width-50,10, 30, 30, "DF");
	$pdf->Image($logo2, $width-48, 12, 26, 26);
	//Footer
	$pdf->SetFont('Arial','',7);
	$pdf->SetXY(20,$heigth-30);
	$pdf->MultiCell(0,3,utf8_decode("La emisión del Reporte de inspección, no libera al Proveedor de sus responsabilidades y obligaciones bajo contrato o la ley, con respecto a los materiales y equipo descritos en este reporte de inspección. Esto no implica la aceptación de estos materiales y equipos por el comprador o Dueño."),0,"C");
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(0,0,110);
	$pdf->SetXY(20,$heigth-23);
	$pdf->MultiCell(0,2,utf8_decode("GEMAR Ingeniería y asesorías técnicas. Vespucio Sur 1117 Las Condes Celular: +56 989210647 www.gemaringenieria.cl"),0,"C");
	$pdf->SetTextColor(0);
}
