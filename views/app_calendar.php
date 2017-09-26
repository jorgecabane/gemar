<?php
require_once dirname(__FILE__) . "/../include/lib.php";
$centro = $_REQUEST['centro'];
$idcentro = $_REQUEST['idcentro'];
?>
  <link href="js/plugins/fullcalendar/css/fullcalendar.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        
        <!--start container-->
        <div class="container">
          <div class="section">
            <div id="full-calendar">              
              <div class="row">
                <div class="col s12 m2 l2">
                 
                 <!-- Header Centro Nombre -->
                  <div id="card-alert" class="card cyan  z-depth-1">
                    <div class="card-content white-text">
                      <p><?php echo $centro; ?></p>
                    </div>
                  </div>

                  <!-- Container -->
                  <div class="center white z-depth-1 card"> 
                    <!-- Select de Criticidad -->
                    <div class="col l12">
                      <h5 class="header"></h5>
                      <select class="browser-default" id="criticidad" name="criticidad"> 
                        <option value="0" event-color="#59f442" selected>No Crítico</option>
                        <option value="1" event-color="#f4424e">Crítico</option>
                      </select>
                    </div>
                    <!-- Fin Select de Criticidad -->
                    
                    <!-- Pills Inspectores -->
                    <div id='external-events' class="col l12">    
                      <!--<h5 class="header">Inspectores</h5>-->
                    <!-- Filtro de Pills -->

                    <div class="dataPills_filter">
                      <input type="search" id="profile-filter" placeholder="Filtro Inspectores">
                    </div>

                    <!-- Fin Filtro de Pills -->
                      <?php

                      $users = get_users();
                  
                      foreach($users as $user){
                        echo "<a class='label fc-event' role='button' data-toggle='collapse' href='#user ".$user->user_id."' aria-expanded='false' aria-controls='user" .$user->user_id . "' event-color='#59f442' userid='" . $user->user_id  . "' style='background-color: #59f442; border-color: #59f442;'>" . $user->user_name . "</a>";
                      }

                      ?>

                    </div>
                    <!-- Fin Pills Inspectores -->  
                  </div>
                  <!-- Fin Container -->
                </div>
                <div class="col s12 m8 l9">
                  <div id='calendar'></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end container-->
    <!-- Calendar Script -->
    <script type="text/javascript" src="js/plugins/fullcalendar/lib/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="js/plugins/fullcalendar/lib/moment.min.js"></script>
    <script type="text/javascript" src="js/plugins/fullcalendar/js/fullcalendar.min.js"></script>
    <script type="text/javascript" src="js/plugins/fullcalendar/fullcalendar-script.js"></script>

    <!-- CUSTOM -->
    <script src="js/plugins/fullcalendar/js/custom/saveBD.js"></script><!-- SAVE Event to BD -->
    <script src="js/plugins/fullcalendar/js/custom/eventReceive.js"></script><!-- eventReceive -->
    <script src="js/plugins/fullcalendar/js/custom/updateEvent.js"></script><!-- updateEvent -->
    <script src="js/plugins/fullcalendar/js/custom/verifyEvent.js"></script><!-- verifyEvent -->
    <script src="js/plugins/fullcalendar/js/custom/deleteEvent.js"></script><!-- deleteEvent -->
    <script src="js/plugins/fullcalendar/js/custom/renderEvent.js"></script><!-- renderEvent -->