<?php

$admin = $_REQUEST['role'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];

include_once dirname(__FILE__) . '/../query/get_logs.php';

  if($admin == 1){

      echo '<div class="row">
            <br>
            <div class="col s10">';

    $logs = get_logs($start, $end);
    if (count($logs) >= 1){
      foreach($logs as $log){

        //Cuerpo
        echo '<table class="bordered responsive-table centered">
                <thead>
                  <tr>
                    <th data-field="activador">Activador</th>
                    <th data-field="informe">Informe</th>
                    <th data-field="inspector">Inspector</th>
                    <th data-field="activador">Activador/Comprador</th>
                    <th data-field="proyecto">Proyecto</th>
                    <th data-field="po">PO</th>
                    <th data-field="descripcion">Descripción</th>
                    <th data-field="provedor">Proveedor</th>
                    <th data-field="inicio">Fecha Inicio</th>
                    <th data-field="termino">Fecha Término</th>
                    <th data-field="dias">Días en fabricación</th>
                    <th data-field="nivel">Nivel verificación</th>
                    <th data-field="avance">Avance</th>
                    <th data-field="entrega">Fecha entrega</th>
                    <th data-field="comentario">Comentario</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>'.$log->activador.'</td>
                    <td>'.$log->informe.'</td>
                    <td>'.$log->inspector.'</td>
                    <td>'.$log->activador.'</td>
                    <td>'.$log->proyecto.'</td>
                    <td>'.$log->po.'</td>
                    <td>'.$log->descripcion.'</td>
                    <td>'.$log->proveedor.'</td>
                    <td>'.date("d/m/Y", (int)$log->inicio).'</td>
                    <td>'.date("d/m/Y", (int)$log->termino).'</td>
                    <td>'.$log->dias.'</td>
                    <td>'.$log->nivel.'</td>
                    <td>'.$log->avance.'</td>
                    <td>'.date("d/m/Y", strtotime($log->fecha)).'</td>
                    <td>'.$log->comentario.'</td>
                  </tr>
                </tbody>
              </table>';


      }   
    }
    echo '</div>
          </div>';
}