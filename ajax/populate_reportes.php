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
                  <a class="col s10 offset-s1 waves-effect waves-light btn editreport" rehacer="1" reportid="'.$evento->reporte_id.'" eventoid="'. $evento->evento_id .'"><i class="mdi-editor-mode-edit"></i>Ver/Editar Reporte</a>
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
	                  <a class="col s10 offset-s1 waves-effect waves-light btn editreport" reportid="null" eventoid="'. $evento->evento_id .'" rehacer="0"><i class="mdi-editor-mode-edit"></i>Entregar Reporte</a>
	                </div>
	              </div>';
		}
		elseif($evento->status == 1){
	        echo '<br><br>
	              <div class="row">
	                <div class="col s6 offset-s3">
	                  <a class="col s10 offset-s1 waves-effect waves-light btn editreport" reportid="'.$evento->reporte_id.'" eventoid="'. $evento->evento_id .'" rehacer="'. $evento->status .'"><i class="mdi-editor-mode-edit"></i>Actualizar Reporte</a>
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
      filldata($(this).attr("reportid"));
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
						$("label[for='fecha_inspeccion active']").addClass('active');
					},
					error: function(e){
						alert("error");
					}
				});
				$.ajax({
					url: "query/get_extrasjson.php", 
					type: "POST",            
					data: {"idreporte": idreporte},
					success: function(response)   
					{
						response = JSON.parse(response);
						response["equipos"].forEach(function(element){
							fillEquipos(element);
						});
						response["asistentes"].forEach(function(element){
							fillAsistente(element);
						});
						response["documentos"].forEach(function(element){
							fillDocumento(element);
						});
						response["pendientes"].forEach(function(element){
							fillPendiente(element);
						});
						var countInsp = 0;
						response["inspeccion"].forEach(function(element){
							if(countInsp == 0){
								$('#reporte_fechainspeccion').val(element.fecha);
								$('#reporte_fechainspeccion').attr("inspeccionId",element.inspeccion_id);
							}
							else
								fillFecha(element);
							countInsp++;
						});
						response["fotografias"].forEach(function(element){
							fillFotos(element);
						});
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
	          'idreporte': idreporte,
	          'idevento': idevento
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

 // ADD EXTRA DATA
	function fillEquipos(equipo){
		var html =  '<div class="insertEquipo" updateEquipo="1" equipoId="'+equipo.equipos_id+'">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Listado de Equipos</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">' +
            			'<input class="equipo_tag" type="text" value="'+equipo.tag+'">' +
            			'<label class="active">Tag</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="equipo_descripcion" type="text" value="'+equipo.descripcion+'">' +
            			'<label class="active">Descripción</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="equipo_proveedor" type="text" value="'+equipo.proveedor+'">' +
            			'<label class="active">Proveedor</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
			            '<textarea class="materialize-textarea equipo_comentario">'+equipo.comentario+'</textarea>' +
			            '<label class="active">Comentarios</label>'+
			        '</div>' +
			        '</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});


	}
	function fillAsistente(asistente){

		var html = 	'<div class="insertAsistente" updateAsistente="1" asistenteId="'+asistente.asistentes_id+'">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Asistentes</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">' +
            			'<input class="asistente_nombre" type="text" value="'+asistente.nombre+'">' +
            			'<label class="active">Nombre</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="asistente_company" type="text" value="'+asistente.compa+'">' +
            			'<label class="active">Compañía</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="asistente_cargo" type="text" value="'+asistente.cargo+'">' +
            			'<label class="active">Cargo</label>' +
       				'</div>' + 
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});

	}
	function fillDocumento(documento){

		var html = 	'<div class="insertDocumento" updateDocumento="1" documentoId="'+documento.documentos_id+'">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Documentos Utilizados</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">' +
            			'<input class="documento_numero" type="text" value="'+documento.numero+'">' +
            			'<label class="active">N° del documento</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="documento_revision" type="text" value="'+documento.revision+'">' +
            			'<label class="active">Revisión</label>' +
       				'</div>' +
					'<div class="input-field row">' +
            			'<input class="documento_nombre" type="text" value="'+documento.nombre+'">' +
            			'<label class="active">Nombre</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="documento_status" type="text" value="'+documento.status+'">' +
            			'<label class="active">Status de aprobación</label>' +
       				'</div>' +
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});

	}
	function fillPendiente(pendiente){

		var html = 	'<div class="insertPendiente" updatePendiente="1" pendienteId="'+pendiente.pendientes_id+'">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Listado de Pendientes</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">' +
            			'<input class="pendiente_numero" type="text" value="'+pendiente.numero+'">' +
            			'<label class="active">N° de documento</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="pendiente_descripcion" type="text" value="'+pendiente.descripcion+'">' +
            			'<label class="active">Descripción</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="pendiente_pendiente" type="text" value="'+pendiente.pendientes+'">' +
            			'<label class="active">Pendientes</label>' +
       				'</div>'+
       				'<div class="input-field row">' +
            			'<input class="pendiente_comentarios" type="text" value="'+pendiente.comentarios+'">' +
            			'<label class="active">Comentarios</label>' +
       				'</div>' +
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});

	}
	function fillFecha(inspeccion){

		var html = 	'<div class="insertFecha" inspeccionId="'+inspeccion.inspeccion_id+'">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Fecha de inspección</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">'+
            			'<input type="text" class="datepicker active" id="reporte_fechainspeccion" value="'+inspeccion.fecha+'">'+
            			'<label class="active" for="fecha_inspeccion active">Fecha de inspección</label>'+
        			'</div>'+
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});

	}
	function fillFotos(foto){
		var path =  "/gemar/images/reportes/";
		console.log(path);
		var html = 	'<div class="insertFotos" rehacer="1">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Registro Fotográfico</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<form action="" method="post" enctype="multipart/form-data" class="imagesubmitform center">'+
        			'<div class="progress loadingbarform" style="display:none">' +
      				'<div class="indeterminate"></div>' +
  					'</div>' +
		    		'<input type="file" name="pictures" accept="image/*" id="file" class="dropify" data-default-file="'+path+foto.imagen_path+'"/>' +
		    		'<button class="center btn waves-effect waves-light submitpicture" type="submit" name="action" style="display:none">' +
		    		'Guardar' +
    				'<i class="mdi-file-cloud-upload right"></i>' +
  					'</button>' +
					'</form>' +
					'<div class="input-field row">' +
            			'<input class="fotografias_elemento" type="text" value="'+foto.elemento+'">' +
            			'<label class="active">Elemento</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="fotografias_observaciones" type="text" value="'+foto.observaciones+'">' +
            			'<label class="active">Observaciones</label>' +
       				'</div>' +
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
			$('.dropify').dropify();
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    		//refreshfunctions();
    	});

	}

  });
</script>