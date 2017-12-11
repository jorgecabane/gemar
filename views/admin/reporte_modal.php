<!--dropify-->
<link href="js/plugins/dropify/css/dropify.min.css" type="text/css" rel="stylesheet" media="screen,projection">

<div id="reportemodal" class="modal modal-fixed-footer" style="overflow-y: hidden; overflow-x: hidden; ">
    <div class="modal-content">

        <!-- Accion -->
        <div id="card-alert" class="card cyan">
            <div class="card-content white-text">
                <p id="reporte_modal_accion" rehacer="" reporteid="" eventoid="">Editar Reporte</p>
            </div>
        </div>
        <br>

        <!-- Horario Trabajado -->
        <div class="input-field row">
            <label class="active" for="reporte_horario">Horario Trabajado</label> 
            <select class="browser-default active" id="reporte_horario">
                <option value="" disabled selected>Elegir horario</option>
                <option value="1">Jornada Completa</option>
                <option value="0.5">Media Jornada</option>
				<option value="0">Residente</option>
            </select>
        </div>

        <!-- Tipo Inspeccion -->
        <div class="input-field row">
            <label class="active" for="reporte_inspeccion">Tipo de Inspección</label> 
            <select class="browser-default active" id="reporte_inspeccion">
                <option value="" disabled selected>Elegir inspeccion</option>
                <option value="1">Visita Semanal</option>
                <option value="2">Visita Spot</option>
				<option value="3">Inspección Residente</option>
				<option value="4">Inspección Final y Despacho</option>
            </select>
        </div>

        <!-- Subcontratista -->
        <div class="input-field row">
            <input id="reporte_subcontratista" type="text">
            <label for="reporte_subcontratista">Subcontratista</label>
        </div>

        <!-- Avance Proyecto -->
        <div class="input-field row">
            <input id="reporte_avance" type="number" placeholder="Ingresar solo número, ej: 80">
            <label class="active" for="reporte_avance">Avance del Proyecto</label>
        </div>

        <!-- Resumen Actividad -->
        <div class="input-field row">
            <input id="reporte_resumen" type="text" maxlength="40">
            <label for="reporte_resumen">Actividad Resumida</label>
        </div>

        <!-- Fecha Estimada Cierre -->
        <div class="input-field row">
            <input type="text" class="datepicker active" id="reporte_fechacierre">
            <label for="fecha_cierre active">Fecha Estimada de Cierre</label>
        </div>

         <!-- Comentarios Proyecto -->
        <div class="input-field row">
            <textarea id="reporte_comentarios" class="materialize-textarea"></textarea>
            <label for="reporte_comentarios">Comentarios del Proyecto</label>
        </div>

         <!-- Alertas Proyecto -->
        <div class="input-field row">
            <textarea id="reporte_alertas" class="materialize-textarea"></textarea>
            <label for="reporte_alertas">Alertas del Proyecto</label>
        </div>

         <!-- Alcances Proyecto -->
        <div class="input-field row">
            <textarea id="reporte_alcances" class="materialize-textarea"></textarea>
            <label for="reporte_alcances">Alcances del Proyecto</label>
        </div>

         <!-- Conclusiones Proyecto -->
        <div class="input-field row">
            <textarea id="reporte_conclusiones" class="materialize-textarea"></textarea>
            <label for="reporte_conclusiones">Conclusiones del Proyecto</label>
        </div>

    </div>

    <!-- Footer -->
    <div class="modal-footer">
        <div class="row">
        	<!-- Extras -->
		    <select class="browser-default active col s2" id="addextraval">
				<option value="1">Equipos</option>
				<option value="2">Asistente</option>
				<option value="3">Documento Utilizado</option>
		        <option value="4">Pendiente</option>
		        <option value="5">Registro Fotográfico</option>
		    </select>

	       	<button class="center btn waves-effect waves-light left" id="addextra">
		    	Añadir Extra
    			<i class="mdi-content-add right"></i>
  			</button>

	        <!-- Acciones -->
	        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close" id="cancelReporte">Cancelar</a>
	        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close cyan" id="saveReporte">Aceptar</a>
        		</div>
    </div>

</div>

<!-- dropify -->
<script type="text/javascript" src="js/plugins/dropify/js/dropify.js"></script>

<script>
$(document).ready(function (e) {

 	$('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 4, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true, // Close upon selecting a date,
        autoclose: true
    });

	//$('.dropify').dropify();

	$(document).on('click', '.deleteextra', function(){
		$(this).parent().parent().remove();
	});

	$('#saveReporte').click( function(e){
		e.preventDefault();

		if($('#reporte_modal_accion').attr("rehacer") == 1){
			var ifrehacer = 1;
		}
		else{
			var ifrehacer = 0;
		}

		var reporte = {
		rehacer: ifrehacer,
		reporteid: $('#reporte_modal_accion').attr("reporteid"),
		evento: $('#reporte_modal_accion').attr("eventoid"),
		resumen: $('#reporte_resumen').val(),
		horario : $('#reporte_horario').val(),
		inspeccion : $('#reporte_inspeccion').val(),
		avance : $('#reporte_avance').val(),
		fechacierre : new Date($('#reporte_fechacierre').val()).toISOString().slice(0, 10),
		comentarios : $('#reporte_comentarios').val(),
		alertas : $('#reporte_alertas').val(),
		alcances : $('#reporte_alcances').val(),
		conclusiones : $('#reporte_conclusiones').val(),
		subcontratista: $('#reporte_subcontratista').val()
		};

		$.ajax({
			url: "query/insert_reporte.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: {"reporte": reporte},       // To send DOMDocument or non processed data file it is set to false

		}).done(function( reporteid ) {
			//data has the recent inserted report id
			var reporteid = reporteid;

			// save insert Equipo
			$.each( $('.insertEquipo') , function( key, value ) {
			  	var equipo = {
				  	reporte: reporteid,
				  	tag: $(this).find('.equipo_tag').val(),
				  	descripcion: $(this).find('.equipo_descripcion').val(),
				  	proveedor: $(this).find('.equipo_proveedor').val(),
				  	comentario: $(this).find('.equipo_comentario').val()
			  	};

				$.ajax({
					url: "query/insert_equipo.php", 
					type: "POST",            
					data: {"equipo": equipo},       
					success: function(equipoid)   
					{
						console.log(equipoid);
					}
				});
			});

			// save insert Asistente
			$.each( $('.insertAsistente') , function( key, value ) {
			  	var asistente = {
				  	reporte: reporteid,
			  		nombre: $(this).find('.asistente_nombre').val(),
				  	company: $(this).find('.asistente_company').val(),
				  	cargo: $(this).find('.asistente_cargo').val()
			  	};

				$.ajax({
					url: "query/insert_asistente.php", 
					type: "POST",            
					data: {"asistentes": asistente},       
					success: function(asistenteid)   
					{
						console.log(asistenteid);
					}
				});
			});

			// save insert Documento
			$.each( $('.insertDocumento') , function( key, value ) {
			  	var documento = {
				  	reporte: reporteid,
			  		numero: $(this).find('.documento_numero').val(),
			  		nombre: $(this).find('.documento_nombre').val(),
				  	revision: $(this).find('.documento_revision').val(),
				  	status: $(this).find('.documento_status').val()
			  	};

				$.ajax({
					url: "query/insert_documento.php", 
					type: "POST",            
					data: {"documento": documento},       
					success: function(documentoid)   
					{
						console.log(documentoid);
					}
				});
			});

			// save insert Pendiente
			$.each( $('.insertPendiente') , function( key, value ) {
			  	var pendiente = {
				  	reporte: reporteid,
			  		numero: $(this).find('.pendiente_numero').val(),
			  		descripcion: $(this).find('.pendiente_descripcion').val(),
				  	pendiente: $(this).find('.pendiente_pendiente').val(),
				  	comentarios: $(this).find('.pendiente_comentarios').val()
			  	};

				$.ajax({
					url: "query/insert_pendiente.php", 
					type: "POST",            
					data: {"pendientes":pendiente},       
					success: function(pendienteid)   
					{
						console.log(pendienteid);
					}
				});
			});

			// save insert Fotos
			$.each( $('.insertFotos') , function( key, value ) {


				var herefoto = $(this);
				//save img first, so you can save the full path to db too
				send = new FormData();
				send.append( 'pictures', $( this ).find('.dropify')[0].files[0] );

				$.ajax({
					url: "ajax/save_img.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: send, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(imgpath)   // A function to be called if request succeeds
					{

						var foto = {
				  			reporte: reporteid,
				  			imagenpath: imgpath,
					  		elemento: herefoto.find('.fotografias_elemento').val(),
					  		observaciones: herefoto.find('.fotografias_observaciones').val()
				  		};

						$.ajax({
							url: "query/insert_fotos.php", 
							type: "POST",            
							data: {"foto": foto},       
							success: function(fotoid)   
							{
								console.log(fotoid);
							}
						});

					}
				});

			});

		$('#reportemodal').closeModal();
		Materialize.toast("Reporte Ingresado", 3000);
		//end de add extra (ajax done)
	  	});




		//$(".imagesubmitform").trigger('submit');
	});

	$(document).on('submit', '.imagesubmitform', (function(e) {
		e.preventDefault();

		var button = $(this).find('.submitpicture');
		var loadingbar = $(this).find('.loadingbarform');
		loadingbar.show();

		send = new FormData();
		send.append( 'pictures', $( this ).find('.dropify')[0].files[0] );

		$.ajax({
			url: "ajax/save_img.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: send, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{

				setTimeout(function(){ 
					loadingbar.hide(); 
				}, 1000);
				button.hide();
				Materialize.toast(data, 3000);
			}
		});
	}));

	// ADD EXTRA DATA
	function appendEquipos(){
		var html =  '<div class="insertEquipo">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Listado de Equipos</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">' +
            			'<input class="equipo_tag" type="text">' +
            			'<label>Tag</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="equipo_descripcion" type="text">' +
            			'<label>Descripción</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="equipo_proveedor" type="text">' +
            			'<label>Proveedor</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
			            '<textarea class="materialize-textarea equipo_comentario"></textarea>' +
			            '<label>Comentarios</label>'+
			        '</div>' +
			        '</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});


	}
	function appendAsistente(){

		var html = 	'<div class="insertAsistente">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Asistentes</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">' +
            			'<input class="asistente_nombre" type="text">' +
            			'<label>Nombre</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="asistente_company" type="text">' +
            			'<label>Compañía</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="asistente_cargo" type="text">' +
            			'<label>Cargo</label>' +
       				'</div>' + 
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});

	}
	function appendDocumento(){

		var html = 	'<div class="insertDocumento">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Documentos Utilizados</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">' +
            			'<input class="documento_numero" type="text">' +
            			'<label>N° del documento</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="documento_revision" type="text">' +
            			'<label>Revisión</label>' +
       				'</div>' +
					'<div class="input-field row">' +
            			'<input class="documento_nombre" type="text">' +
            			'<label>Nombre</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="documento_status" type="text">' +
            			'<label>Status de aprobación</label>' +
       				'</div>' +
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});

	}
	function appendPendiente(){

		var html = 	'<div class="insertPendiente">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Listado de Pendientes</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<div class="input-field row">' +
            			'<input class="pendiente_numero" type="text">' +
            			'<label>N° de documento</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="pendiente_descripcion" type="text">' +
            			'<label>Descripción</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="pendiente_pendiente" type="text">' +
            			'<label>Pendientes</label>' +
       				'</div>'+
       				'<div class="input-field row">' +
            			'<input class="pendiente_comentarios" type="text">' +
            			'<label>Comentarios</label>' +
       				'</div>' +
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    	});

	}
	function appendFotos(){

		var html = 	'<div class="insertFotos">' +
					'<div class="divider"></div><br><div class="row"><h4 class="col s8">Registro Fotográfico</h4><a class="col s4 waves-effect waves-light btn deleteextra"><i class="mdi-action-delete right"></i>Eliminar</a></div>' +
					'<form action="" method="post" enctype="multipart/form-data" class="imagesubmitform center">'+
        			'<div class="progress loadingbarform" style="display:none">' +
      				'<div class="indeterminate"></div>' +
  					'</div>' +
		    		'<input type="file" name="pictures" accept="image/*" id="file" class="dropify"/>' +
		    		'<button class="center btn waves-effect waves-light submitpicture" type="submit" name="action" style="display:none">' +
		    		'Guardar' +
    				'<i class="mdi-file-cloud-upload right"></i>' +
  					'</button>' +
					'</form>' +
					'<div class="input-field row">' +
            			'<input class="fotografias_elemento" type="text">' +
            			'<label>Elemento</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="fotografias_observaciones" type="text">' +
            			'<label>Observaciones</label>' +
       				'</div>' +
       				'</div>';

		
		$.when($('#reportemodal').find('.modal-content').append(html)).then(function( value ) {
			$('.dropify').dropify();
    		$('#reportemodal').find('.modal-content').animate({scrollTop: $('#reportemodal').find('.modal-content').prop("scrollHeight")}, 'slow');
    		//refreshfunctions();
    	});

	}

	function addDataExtra(selected){
		switch(selected) {
		    case 1:
		        appendEquipos();
		        break;
		    case 2:
		        appendAsistente();
		        break;
		    case 3:
		        appendDocumento();
		        break;		        		        
		    case 4:
		        appendPendiente();
		        break;
		    case 5:
		        appendFotos();
		}
	};


	$('#addextra').on('click', function(){
		var selected = parseFloat($('#addextraval option:selected').val());
		addDataExtra(selected);
	});

});	
</script>