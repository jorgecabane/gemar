<div id="reportemodal" class="modal modal-fixed-footer">
    <div class="modal-content">

        <!-- Accion -->
        <div id="card-alert" class="card cyan">
            <div class="card-content white-text">
                <p id="contacto_modal_accion">Editar Reporte</p>
            </div>
        </div>

        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
		    <input type="hidden" name="MAX_FILE_SIZE" value="100000000"/>
		    <input type="file" name="pictures" accept="image/*" id="file"/>
		    <input type="submit" value="upload" class="submit"/>
		</form>

		<div id="message"></div>

		<div id="loadingbar" class="progress" style="display:none">
      		<div class="indeterminate"></div>
  		</div>

    </div>

    <!-- Footer -->
    <div class="modal-footer">
        <div id="evento"></div>
        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close" id="cancelContacto">Cancelar</a>
        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close cyan" id="saveContacto">Aceptar</a>
    </div>

</div>

<script>
	$(document).ready(function (e) {
		$("#uploadimage").on('submit',(function(e) {
			e.preventDefault();
			$("#message").empty();
			$('#loadingbar').show();

			send = new FormData();
    		send.append( 'pictures', $( '#file' )[0].files[0] );

			$.ajax({
				url: "ajax/save_img.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: send, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{

					setTimeout(function(){ 
						$('#loadingbar').hide(); 
					}, 1000);

					$("#message").html(data);
					console.log(data);
				}
			});
		}));
	});
</script>