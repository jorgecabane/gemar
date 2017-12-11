<?php

$admin = $_REQUEST['admin'];
$userid = $_REQUEST['userid'];
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];

include_once dirname(__FILE__) . '/../query/get_eventos.php';

  if($admin){
    //Admin ve todos los eventos
    $eventos = get_eventos(null, $month, $year);
    foreach($eventos as $evento){

      if($evento->criticidad == 1){
        //Evento Critico
        echo '<li>
            <div class="collapsible-header red white-text"><i class="mdi-device-access-alarms"></i>'.$evento->nombre_proyecto.' ('.$evento->orden_compra.') - '. $evento->user_first_name .' '. $evento->user_last_name . '</div>
            <div class="collapsible-body red lighten-5">';
      }
      else{
        //Evento No Critico
        echo '<li>
            <div class="collapsible-header"><i class="mdi-social-notifications-off"></i>'.$evento->nombre_proyecto.' ('.$evento->orden_compra.') - '. $evento->user_first_name .' '. $evento->user_last_name . '</div>
            <div class="collapsible-body">';
      }

      //Cuerpo del Evento
      echo '<div class="row">
            <br>
            <div class="col s10 offset-s1 ">

            <table class="bordered responsive-table centered">
            <thead>
              <tr>
                <th data-field="version">Versión</th>
                <th data-field="centro">Centro</th>
                <th data-field="inicio">Inicio</th>
                <th data-field="termino">Término</th>
                <th data-field="descripcion">Descripción</th>
                <th data-field="visitas">Visitas Agendadas</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>'.$evento->version.'</td>
                <td>'.$evento->nombre.'</td>
                <td>'.date("d/m/Y", strtotime($evento->HoraInicio)).'</td>
                <td>'.date("d/m/Y", strtotime($evento->HoraTermino)).'</td>
                <td>'.$evento->descripcion.'</td>
                <td>'.$evento->visitas_agendadas.'</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>';

      //si es que tiene un reporte asociado
//              if($evento->reporte_id != null){
        echo '<br><br>
              <div class="row">
                <div class="col s4">
                  <a class="col s10 offset-s1 waves-effect waves-light btn editreport" reportid="'.$evento->reporte_id.'" eventoid="'. $evento->evento_id .'"><i class="mdi-editor-mode-edit"></i>Ver/Editar Reporte</a>
                </div>
                <div class="col s4">
                  <a class="col s10 offset-s1 waves-effect waves-light btn generatepdf" reportid="'.$evento->reporte_id.'" eventoid="'. $evento->evento_id .'"><i class="mdi-editor-attach-file"></i>Generar PDF</a>
                </div>
                <div class="col s4">
                  <a class="col s10 offset-s1 waves-effect waves-light btn doreportagain" reportid="'.$evento->reporte_id.'" eventoid="'. $evento->evento_id .'"><i class="mdi-av-replay"></i>Enviar a Rehacer</a>
                </div>
              </div>';
//             }

      //end of evento
      echo '<br>
            </div>
            </li>';
    }
  }
  else{
    //Ingreso desde usuario básico, solo ve sus eventos
    $eventos = get_eventos($userid, $month, $year);
    foreach($eventos as $evento){

      if($evento->status == 1)
      {
      	$status = "Rehacer reporte";
      }
      else {
      	$status = "Reporte Inicial";
      }
	 
      if($evento->criticidad == 1){
        //Evento Critico
        echo '<li>
            <div class="collapsible-header red white-text"><i class="mdi-device-access-alarms"></i>'.$evento->nombre_proyecto.' ('.$evento->orden_compra.')</div>
            <div class="collapsible-body red lighten-5">';
      }
      elseif($evento->status == 1){
      	echo '<li>
            <div class="collapsible-header yellow lighten-1 white-text"><i class="mdi-av-replay"></i>'.$evento->nombre_proyecto.' ('.$evento->orden_compra.')</div>
            <div class="collapsible-body yellow lighten-4">';
      }
      else{
        //Evento No Critico
        echo '<li>
            <div class="collapsible-header"><i class="mdi-social-notifications-off"></i>'.$evento->nombre_proyecto.' ('.$evento->orden_compra.')</div>
            <div class="collapsible-body">';
      }

      //Cuerpo del Evento
      echo '<div class="row">
            <br>
            <div class="col s10 offset-s1 ">

            <table class="bordered responsive-table centered">
            <thead>
              <tr>
                <th data-field="estado">Estado</th>
                <th data-field="centro">Centro</th>
                <th data-field="inicio">Inicio</th>
                <th data-field="termino">Término</th>
                <th data-field="descripcion">Descripción</th>
                <th data-field="visitas">Visitas Agendadas</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>'.$status.'</td>
                <td>'.$evento->nombre.'</td>
                <td>'.date("d/m/Y", strtotime($evento->HoraInicio)).'</td>
                <td>'.date("d/m/Y", strtotime($evento->HoraTermino)).'</td>
                <td>'.$evento->descripcion.'</td>
                <td>'.$evento->visitas_agendadas.'</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>';

      //si es que tiene un reporte asociado
//              if($evento->reporte_id != null){
		if($evento->status == null){
	        echo '<br><br>
	              <div class="row">
	                <div class="col s6 offset-s3">
	                  <a class="col s10 offset-s1 waves-effect waves-light btn editreport" reportid="" eventoid="'. $evento->evento_id .'" rehacer="'. $evento->status .'"><i class="mdi-editor-mode-edit"></i>Entregar Reporte</a>
	                </div>
	              </div>';
		}
		elseif($evento->status == 1){
	        echo '<br><br>
	              <div class="row">
	                <div class="col s6 offset-s3">
	                  <a class="col s10 offset-s1 waves-effect waves-light btn editreport" reportid="" eventoid="'. $evento->evento_id .'" rehacer="'. $evento->status .'"><i class="mdi-editor-mode-edit"></i>Actualizar Reporte</a>
	                </div>
	              </div>';
		}
//             }

      //end of evento
      echo '<br>
            </div>
            </li>';
    }
  }
?>

<script>
  $(document).ready(function(){
	 $('.editreport').on('click', function(event){
      $('#reporte_modal_accion').attr("reporteid", $(this).attr("reportid"));
      $('#reporte_modal_accion').attr("eventoid", $(this).attr("eventoid"));
      $('#reporte_modal_accion').attr("rehacer", $(this).attr("rehacer"));
      $('#reportemodal').openModal();
      filldata(1);
      //$( this ).off( event );
    });  

	//fill data if report is going to be updated
	function filldata(idreporte){
			if($('#reporte_modal_accion').attr("rehacer") == "1"){
				$.ajax({
					url: "query/get_reporte.php", 
					type: "POST",            
					data: {"idreporte": idreporte},
					success: function(response)   
					{
						response = JSON.parse(response);
						$("#reporte_horario").val(response[0]["horario_trabajado"]);
						$("#reporte_inspeccion").val(response[0]["tipo_inspeccion"]);
						$('#reporte_subcontratista').val(response[0]["subcontratista"]);
						$('#reporte_avance').val(response[0]["avance"]); 
						$('#reporte_resumen').val(response[0]["resumen"]);
						$('#reporte_fechacierre').val(response[0]["fecha_estimada_cierre"]);
						$('#reporte_comentarios').val(response[0]["comentarios"]);	
						$('#reporte_alertas').val(response[0]["alertas"]);
						$('#reporte_alcances').val(response[0]["alcances"]);
						$('#reporte_conclusiones').val(response[0]["conclusiones"]);						
						$("label[for='reporte_subcontratista']").addClass('active');
						$("label[for='reporte_avance']").addClass('active');
						$("label[for='reporte_resumen']").addClass('active');
						$("label[for='fecha_cierre active']").addClass('active');
						$("label[for='reporte_comentarios']").addClass('active');
						$("label[for='reporte_alertas']").addClass('active');
						$("label[for='reporte_alcances']").addClass('active');
						$("label[for='reporte_conclusiones']").addClass('active');
					},
					error: function(e){
						alert("error");
					}
				});
			}
	};
		
    $('.generatepdf').on('click', function(event){
      var idreporte = $(this).attr("reportid");
      var idevento = $(this).attr("eventoid");
      $('#downloadreport').attr("idreporte", idreporte);
      $('#generatepdfmodal').find('.modal-content').html('<iframe src="ajax/generate_pdf.php?idreporte='+ idreporte +'" style="width: 100%; height: 100%; border: none; margin: 0; padding: 0; display: block;"></iframe>');
      $('#generatepdfmodal').openModal();
    }); 

    $('#downloadreport').on('click', function(e){
      e.preventDefault();  //stop the browser from following
      var idreporte = $(this).attr("idreporte");
      window.location.href = 'ajax/generate_pdf.php?idreporte='+ idreporte +'&download=true';
    });

    $('.doreportagain').on('click', function(event){
      var idreporte = $(this).attr("reportid");
      var idevento = $(this).attr("eventoid");
      var li = $(this).parent().parent().parent().parent();
      var quereporte = li.find('.collapsible-header').text();
      var r = confirm("Está seguro que quiere mandar a rehacer el reporte: "+ quereporte);
	  if (r == true) {
        jQuery.ajax({
	        method: "POST",
	        url: "query/rehacer_reporte.php",
	        data: {
	          'reporte': idreporte,
	          'evento': idevento
	        },
	        error: function(response) {
	          console.log(response);
	        },
	        success: function(response)
	        {
	          li.remove();
	          Materialize.toast("Reporte enviado a rehacer", 3000);
	        }
        });
	  }
    }); 

  });
</script>