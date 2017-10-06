<!--dropify-->
<link href="js/plugins/dropify/css/dropify.min.css" type="text/css" rel="stylesheet" media="screen,projection">

<div id="reportemodal" class="modal modal-fixed-footer" style="overflow-y: hidden; overflow-x: hidden; ">
    <div class="modal-content">

        <!-- Accion -->
        <div id="card-alert" class="card cyan">
            <div class="card-content white-text">
                <p id="contacto_modal_accion">Editar Reporte</p>
            </div>
        </div>


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
                <option value="0.5">Visita Spot</option>
				<option value="0">Inspección Residente</option>
				<option value="0">Inspección Final y Despacho</option>
            </select>
        </div>

         <!-- Avance Proyecto -->
        <div class="input-field row">
            <input id="reporte_avance" type="text">
            <label for="reporte_avance">Avance del Proyecto</label>
        </div>

        <!-- Fecha Estimada Cierre -->
        <div class="input-field row">
            <input type="text" class="datepicker active" id="reporte-fechacierre">
            <label for="fecha-cierre active">Fecha Estimada de Cierre</label>
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
            <textarea id="reporte_conclusiones" class="materialize-textarea"><?php echo str_replace("<br>", "\n", "asdasd<br>holo<br>potatoasdasdasdas<br>dasdasdasdadsasdasdasdadasdasd"); ?></textarea>
            <label for="reporte_conclusiones">Conclusiones del Proyecto</label>
        </div>



        <form action="" method="post" enctype="multipart/form-data" class="imagesubmitform center">
        	<div class="progress loadingbarform" style="display:none">
      			<div class="indeterminate"></div>
  			</div>
		    <input type="hidden" name="MAX_FILE_SIZE" value="100000000"/>
		    <input type="file" name="pictures" accept="image/*" id="file" class="dropify" data-default-file="images/reportes/59d68892ad6b01.27347415_oihngkfqjmple.jpeg"/>
		    <button class="center btn waves-effect waves-light submitpicture" type="submit" name="action" style="display:none">
		    	Guardar
    			<i class="mdi-file-cloud-upload right"></i>
  			</button>
		</form>

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
<script type="text/javascript" src="js/plugins/dropify/js/dropify.min.js"></script>

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

		$('.dropify').dropify();

		$(document).on('change', '.dropify', function(){
			$(this).parent().parent().find('.submitpicture').show();
		});

		$(".imagesubmitform").on('submit',(function(e) {
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
	});
</script>

<script>
$(document).ready(function (e) {

	function appendEquipos(){
		var html = '<div class="divider"></div><br><h4>Listado de Equipo</h4>' +
					'<div class="input-field row">' +
            			'<input class="equipo_tag" type="text">' +
            			'<label>Tag</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="equipo_tag" type="text">' +
            			'<label>Descripción</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
            			'<input class="equipo_tag" type="text">' +
            			'<label>Proveedor</label>' +
       				'</div>' +
       				'<div class="input-field row">' +
			            '<textarea class="materialize-textarea equipo_comentario"></textarea>' +
			            '<label>Comentarios</label>'+
			        '</div>';

		
		$.when($('.modal-content').append(html)).then(function( value ) {
    		$('.modal-content').animate({scrollTop: $('.modal-content').prop("scrollHeight")}, 'slow');
    	});


	}
	function appendAsistente(){

		
      	$('.modal-content').animate({ scrollTop: $('.modal-content').height() }, 0);
	}
	function appendDocumento(){

		
      	$('.modal-content').animate({ scrollTop: $('.modal-content').height() }, 0);
	}
	function appendPendiente(){

		
      	$('.modal-content').animate({ scrollTop: $('.modal-content').height() }, 0);
	}
	function appendFotos(){

		
      	$('.modal-content').animate({ scrollTop: $('.modal-content').height() }, 0);
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