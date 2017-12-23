<?php
session_start();
if(isset($_REQUEST['id'])) {
  $userid = $_REQUEST['id'];
}
else {
  $userid = $_SESSION['user_id'];
}
include_once dirname(__FILE__).'/../include/lib.php'; // archivo de conexion local
?>
        <!--start container-->
        <div class="container">
          <div id="profile-page" class="section">
            <!-- profile-page-header -->
            <?php 
            	$user = get_users($userid);
            echo '<div class="row">
    	<div class="col s12">
  			<div class="card white"> 
  				<div class="card-content black-text">                  
					<figure class="card-profile-image center-align">
				    	<img src="images/avatar.jpg" alt="profile image" class="circle z-depth-2 responsive-img activator">
				    </figure>   
  					<div class="col s6 offset-s3 center-align">                        
		            	<h1 class="card-title title-text text-darken-4" style="font-size:250%">'.$user[0]->nombre.'</h1>
		                <p class="medium grey-text">'.$user[0]->user_title.'</p>                        
	            	</div>
	                <div class="col s1 right-align offset-s2">
	                	<a class="btn-floating waves-effect waves-light darken-2 right">
	                    	<i class="mdi-editor-mode-edit"></i>
	                   	</a>
	             	</div>
				</div>
	 		</div>
		</div>
	</div>
	<div class="col s12">
	    <div class="card white">
	    	<div class="card-content black-text">
	            <div class="col s3 offset-s2 center-align">
	            	<h4 class="card-title grey-text text-darken-4" style="font-size:150%">Teléfono</h4>
	               	<p class="medium-small grey-text"><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i>  '.$user[0]->user_phone.'</p>
	            </div>
           		<div class="col s3 offset-s2 center-align">
	              	<h4 class="card-title grey-text text-darken-4" style="font-size:150%">Email</h4>
	             	<p class="medium-small grey-text"><i class="mdi-communication-email cyan-text text-darken-2"></i>  '.$user[0]->user_email.'</p>	                  
	            </div>
	        </div>
	  	</div>
	</div>';
            ?>
            
          </div>
        </div>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--prism-->