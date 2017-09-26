
<div id="modal_calendario" class="modal bottom-sheet">
	<div class="modal-content">
		<div class="row">
			<div class="col s4">
				<h4>Centros</h4>
			</div>
			<div class="col s4 offset-s4 align-right">
				<div class="dataTables_filter">
				<label>Filtrar:<input type="search" id="centros-filter" placeholder=""></label>
				</div>
			</div>
		</div>
		
		<ul class="collection" id="profle-ul-filter">
			<li class="collection-item avatar waves-effect waves-block waves-teal load-content" what="views/app_calendar.php?idcentro=1&centro=Centro1" where="content">
				<i class="mdi-editor-insert-emoticon circle"></i>
				<span class="title profile-name">Centro 1</span>
				<p>
					First Line <br> Second Line
				</p> 
<!--  <i class="mdi-action-open-in-browser circle green" style="position:relative; float:right; vertical-align: middle;"></i> -->
				<a href="#!" class="secondary-content">
					<i class="mdi-action-open-in-browser"></i>
				</a>
			</li>
			<li class="collection-item avatar waves-effect waves-block waves-teal load-content" what="views/app_calendar.php?idcentro=2&centro=Centro2" where="content">
				<i class="mdi-editor-insert-emoticon circle"></i>
				<span class="title profile-name">Centro 2</span>
				<p>
					First Line <br> Second Line
				</p> 
				<a href="#!" class="secondary-content">
					<i class="mdi-action-open-in-browser"></i>
				</a>
			</li>
			<li class="collection-item avatar waves-effect waves-block waves-teal load-content" what="views/app_calendar.php?idcentro=3&centro=Centro3" where="content">
				<i class="mdi-editor-insert-emoticon circle"></i>
				<span class="title profile-name">Centro 3</span>
				<p>
					First Line <br> Second Line
				</p> 
				<a href="#!" class="secondary-content">
					<i class="mdi-action-open-in-browser"></i>
				</a>
			</li>
			<li class="collection-item avatar waves-effect waves-block waves-teal load-content" what="views/app_calendar.php?idcentro=4&centro=Centro4 where="content">
			<i class="mdi-editor-insert-emoticon circle"></i>
				<span class="title profile-name">Centro 4</span>
				<p>
					First Line <br> Second Line
				</p> 
				<a href="#!" class="secondary-content">
				<i class="mdi-action-open-in-browser"></i>
				</a>
			</li>
		</ul>
	</div>
</div>

<script>
$( document ).ready(function() {
	$( "#profile-filter" ).on('keyup', function() {
		  $("#profle-ul-filter").find('.profile-name').parent().show();
		  var filter = $("#profile-filter").val();
		  if ( filter.length > 1 ){

				var lis = $("#profle-ul-filter").find('.profile-name');
				$.each( lis, function( key, value ) {
					 var here = $(this);
					 var text = here.text().toLowerCase();
					 var index = text.indexOf(filter.toLowerCase());

					 if( parseFloat(index) == -1){
						 here.parent().hide();
					 }
				});
		  }
	});

	$( ".modal-profile-trigger" ).on('click', function() {
		$('#centros-filter').focus();
	});

});
</script>