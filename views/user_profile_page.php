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
            echo '<div id="profile-page-header" class="card">
	                <div class="card-image waves-effect waves-block waves-light">
	                    <img class="background" src="images/user-profile-bg.jpg" alt="user background">                    
	                </div>
	                <figure class="card-profile-image">
	                    <img src="images/avatar.jpg" alt="profile image" class="circle z-depth-2 responsive-img activator">
	                </figure>
	  				<div class="card-content">
	                  <div class="row">                    
	                    <div class="col s3 offset-s2">                        
	                        <h4 class="card-title grey-text text-darken-4">'.$user[0]->nombre.'</h4>
	                        <p class="medium-small grey-text">'.$user[0]->user_title.'</p>                        
	                    </div>
	                    <div class="col s2 center-align">
	                    	<h4 class="card-title grey-text text-darken-4">Teléfono</h4>
	                    	<p class="medium-small grey-text"><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i>  '.$user[0]->user_phone.'</p>
	                    </div>
                        <div class="col s2 center-align">
	                        <h4 class="card-title grey-text text-darken-4">Email</h4>
	                    	<p class="medium-small grey-text"><i class="mdi-communication-email cyan-text text-darken-2"></i>  '.$user[0]->user_email.'</p>	                  
	                    </div>
	                     <div class="col s1 right-align offset-s2">
	                      <a class="btn-floating waves-effect waves-light darken-2 right">
	                          <i class="mdi-editor-mode-edit"></i>
	                      </a>
	                    </div>
	                  </div>
	                </div>
	            </div>';
            ?>
            <!--/ profile-page-header -->

            <!-- profile-page-content -->
            <div id="profile-page-content" class="row">
              <!-- profile-page-sidebar-->
              <div id="profile-page-sidebar" class="col s12 m4">
                <!-- Profile About  -->
                <div class="card light-blue">
                  <div class="card-content white-text">
                    <span class="card-title">About Me!</span>
                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                  </div>                  
                </div>
                <!-- Profile About  -->            
                                
                <!-- task-card -->
                <ul id="task-card" class="collection with-header">
                  <li class="collection-header cyan">
                      <h4 class="task-card-title">My Task</h4>
                      <p class="task-card-date">March 26, 2015</p>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task1" />
                      <label for="task1">Create Mobile App UI. <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                      </label>
                      <span class="task-cat teal">Mobile App</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task2" />
                      <label for="task2">Check the new API standerds. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                      </label>
                      <span class="task-cat purple">Web API</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task3" checked="checked" />
                      <label for="task3">Check the new Mockup of ABC. <a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                      </label>
                      <span class="task-cat pink">Mockup</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task4" checked="checked" disabled="disabled" />
                      <label for="task4">I did it !</label>
                      <span class="task-cat cyan">Mobile App</span>
                  </li>
                </ul>
                <!-- task-card -->

              </div>
              <!-- profile-page-sidebar-->

              <!-- profile-page-wall -->
              <div id="profile-page-wall" class="col s12 m8">
                <!-- profile-page-wall-share -->
                <div id="profile-page-wall-share" class="row">
                  <div class="col s12">
                    <ul class="tabs tab-profile z-depth-1 light-blue">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light active" href="#UpdateStatus"><i class="mdi-editor-border-color"></i> Update Status</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#AddPhotos"><i class="mdi-image-camera-alt"></i> Add Photos</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#CreateAlbum"><i class="mdi-image-photo-album"></i> Create Album</a>
                      </li>                      
                    </ul>
                    <!-- UpdateStatus-->
                    <div id="UpdateStatus" class="tab-content col s12  grey lighten-4">
                      <div class="row">
                        <div class="col s2">
                          <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image-post">
                        </div>
                        <div class="input-field col s10">
                          <textarea id="textarea" row="2" class="materialize-textarea"></textarea>
                          <label for="textarea" class="">What's on your mind?</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12 m6 share-icons">
                          <a href="#"><i class="mdi-image-camera-alt"></i></a>
                          <a href="#"><i class="mdi-action-account-circle"></i></a>
                          <a href="#"><i class="mdi-hardware-keyboard-alt"></i></a>
                          <a href="#"><i class="mdi-communication-location-on"></i></a>
                        </div>
                        <div class="col s12 m6 right-align">
                           <!-- Dropdown Trigger -->
                            <a class='dropdown-button btn' href='#' data-activates='profliePost'><i class="mdi-action-language"></i> Public</a>

                            <!-- Dropdown Structure -->
                            <ul id='profliePost' class='dropdown-content'>
                              <li><a href="#!"><i class="mdi-action-language"></i> Public</a></li>
                              <li><a href="#!"><i class="mdi-action-face-unlock"></i> Friends</a></li>                              
                              <li><a href="#!"><i class="mdi-action-lock-outline"></i> Only Me</a></li>
                            </ul>

                            <a class="waves-effect waves-light btn"><i class="mdi-maps-rate-review left"></i>Post</a>
                        </div>
                      </div>
                    </div>
                    <!-- AddPhotos -->
                    <div id="AddPhotos" class="tab-content col s12  grey lighten-4">
                      <div class="row">
                        <div class="col s2">
                          <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image-post">
                        </div>
                        <div class="input-field col s10">
                          <textarea id="textarea" row="2" class="materialize-textarea"></textarea>
                          <label for="textarea" class="">Share your favorites photos!</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12 m6 share-icons">
                          <a href="#"><i class="mdi-image-camera-alt"></i></a>
                          <a href="#"><i class="mdi-action-account-circle"></i></a>
                          <a href="#"><i class="mdi-hardware-keyboard-alt"></i></a>
                          <a href="#"><i class="mdi-communication-location-on"></i></a>
                        </div>
                        <div class="col s12 m6 right-align">
                           <!-- Dropdown Trigger -->
                            <a class='dropdown-button btn' href='#' data-activates='profliePost2'><i class="mdi-action-language"></i> Public</a>

                            <!-- Dropdown Structure -->
                            <ul id='profliePost2' class='dropdown-content'>
                              <li><a href="#!"><i class="mdi-action-language"></i> Public</a></li>
                              <li><a href="#!"><i class="mdi-action-face-unlock"></i> Friends</a></li>                              
                              <li><a href="#!"><i class="mdi-action-lock-outline"></i> Only Me</a></li>
                            </ul>

                            <a class="waves-effect waves-light btn"><i class="mdi-maps-rate-review left"></i>Post</a>
                        </div>
                      </div>
                    </div>
                    <!-- CreateAlbum -->
                    <div id="CreateAlbum" class="tab-content col s12  grey lighten-4">
                      <div class="row">
                        <div class="col s2">
                          <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image-post">
                        </div>
                        <div class="input-field col s10">
                          <textarea id="textarea" row="2" class="materialize-textarea"></textarea>
                          <label for="textarea" class="">Create awesome album.</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12 m6 share-icons">
                          <a href="#"><i class="mdi-image-camera-alt"></i></a>
                          <a href="#"><i class="mdi-action-account-circle"></i></a>
                          <a href="#"><i class="mdi-hardware-keyboard-alt"></i></a>
                          <a href="#"><i class="mdi-communication-location-on"></i></a>
                        </div>
                        <div class="col s12 m6 right-align">
                           <!-- Dropdown Trigger -->
                            <a class='dropdown-button btn' href='#' data-activates='profliePost3'><i class="mdi-action-language"></i> Public</a>

                            <!-- Dropdown Structure -->
                            <ul id='profliePost3' class='dropdown-content'>
                              <li><a href="#!"><i class="mdi-action-language"></i> Public</a></li>
                              <li><a href="#!"><i class="mdi-action-face-unlock"></i> Friends</a></li>                              
                              <li><a href="#!"><i class="mdi-action-lock-outline"></i> Only Me</a></li>
                            </ul>

                            <a class="waves-effect waves-light btn"><i class="mdi-maps-rate-review left"></i>Post</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ profile-page-wall-share -->
              </div>
              <!--/ profile-page-wall -->

            </div>
          </div>
        </div>
        </div>

    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--prism-->