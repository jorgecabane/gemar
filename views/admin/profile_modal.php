<div id="modal5" class="modal bottom-sheet">
	<div class="modal-content">
		<div class="row">
			<div class="col s4">
				<h4>Usuarios</h4>
			</div>
			<div class="col s4 offset-s4 align-right">
				<div class="dataTables_filter">
				<label>Filtrar:<input type="search" id="profile-filter" placeholder=""></label>
				</div>
			</div>
		</div>
		
		<ul class="collection" id="profle-ul-filter">
			<li class="collection-item avatar waves-effect waves-block waves-teal load-content" what="views/user_profile_page.php?id=1" where="content">
				<img src="images/avatar.jpg" alt=""	class="circle"> 
				<span class="title profile-name">Jorge Cabané</span>
				<p>
					First Line <br> Second Line
				</p> 
<!--  <i class="mdi-action-open-in-browser circle green" style="position:relative; float:right; vertical-align: middle;"></i> -->
				<a href="#!" class="secondary-content">
					<i class="mdi-action-open-in-browser"></i>
				</a>
			</li>
			<li class="collection-item avatar waves-effect waves-block waves-teal load-content" what="views/user_profile_page.php?id=2" where="content">
				<i class="mdi-file-folder circle"></i>
				<span class="title profile-name">Francisco Torres</span>
				<p>
					First Line <br> Second Line
				</p> 
				<a href="#!" class="secondary-content">
					<i class="mdi-action-open-in-browser"></i>
				</a>
			</li>
			<li class="collection-item avatar waves-effect waves-block waves-teal load-content" what="views/user_profile_page.php?id=3" where="content">
				<i class="mdi-action-assessment circle green"></i> 
				<span class="title profile-name">Sofia Veragua</span>
				<p>
					First Line <br> Second Line
				</p> 
				<a href="#!" class="secondary-content">
					<i class="mdi-action-open-in-browser"></i>
				</a>
			</li>
			<li class="collection-item avatar waves-effect waves-block waves-teal load-content" what="views/user_profile_page.php?id=4" where="content">
			<i class="mdi-av-play-arrow circle red"></i> 
				<span class="title profile-name">Roberta Martinez</span>
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
		$('#profile-filter').focus();
	});

});
</script>