<?php
  session_start();
  require_once dirname(__FILE__) . "/../include/lib.php";
  if($_SESSION['user_role'] == 1){
    $admin = true;
  }
  else{
    $admin = false;
    $userid = $_SESSION['user_id'];
  }
?>

<!--start container-->
<div class="container">
  <div class="section">
    <div class="col s12">
      <ul id="task-card" class="collection with-header">
          <li class="collection-header cyan">
              <h4 class="task-card-title">Reportes</h4>
              <p class="task-card-date">Sept 20, 2017</p>
          </li>
      </ul>
      <ul class="collapsible collapsible-accordion" data-collapsible="accordion">

        <?php
          if($admin){
            //Admin ve todos los eventos
            $eventos = get_eventos();
            foreach($eventos as $evento){
              if($evento->criticidad == 1){
                //Evento Critico
                echo '<li>
                    <div class="collapsible-header red white-text"><i class="mdi-device-access-alarms"></i>'.$evento->nombre_proyecto.' '.$evento->orden_compra.'</div>
                    <div class="collapsible-body red lighten-5">';
              }
              else{
                //Evento No Critico
                echo '<li>
                    <div class="collapsible-header"><i class="mdi-social-notifications-off"></i>'.$evento->nombre_proyecto.' '.$evento->orden_compra.'</div>
                    <div class="collapsible-body">';
              }

              //Cuerpo del Evento
              echo '<div class="row">
                    <br>
                    <div class="col s10 offset-s1 ">

                    <table class="bordered responsive-table centered">
                    <thead>
                      <tr>
                        <th data-field="id">Inicio</th>
                        <th data-field="name">Término</th>
                        <th data-field="price">Descripción</th>
                        <th data-field="price">Visitas Agendadas</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
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
            $eventos = get_eventos($userid);
          }
        ?>

      </ul>

    </div>
  </div>
</div>
<?php   
  if($admin){
    include_once dirname(__FILE__) . '/admin/reporte_modal.php';
    include_once dirname(__FILE__) . '/admin/generatepdf_modal.php';
  }
?> 


    <script type="text/javascript" src="js/plugins/jquery-ui.js"></script> 
<!--end container-->
  
<script>
  $(document).ready(function(){
    $('.collapsible').collapsible();

    $('.editreport').on('click', function(event){
      $('#reporte_modal_accion').attr("reporteid", $(this).attr("reportid"));
      $('#reporte_modal_accion').attr("eventoid", $(this).attr("eventoid"));
      $('#reportemodal').openModal();
      var here = $(this);
      $(document).on('click', '#saveReporte', function(e){
        here.off( ".editreport" );
      });
      $( this ).off( event );
    });   

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

  });
</script>