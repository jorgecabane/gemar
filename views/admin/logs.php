<?php
  session_start();
  require_once dirname(__FILE__) . "/../../include/lib.php";
  if($_SESSION['user_role'] == 1){
?>

<link href="js/plugins/monthpicker/MonthPicker.css" type="text/css" rel="stylesheet"
  media="screen,projection">
<link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

<!--start container-->
<div class="container">
  <div class="section">
    <div class="col s12">
      <ul id="task-card" class="collection with-header">
          <li class="collection-header cyan">
              <div class="row">
                <h4 class="col task-card-title">Reporte de Status Semanal</h4>

                <div class="header-search-wrapper white-text">
                  <i class="mdi-action-today"></i>
                  <input id="weekPicker" type="text" class="header-search-input"/>
                </div>

              </div>
          </li>
      </ul>
      <div id="appendLogs">



      </div>

    </div>
  </div>
</div>
<?php   
  }
?> 


<script type="text/javascript" src="js/plugins/jquery-ui.js"></script> 
<script type="text/javascript" src="js/plugins/weekpicker/src/weekPicker.js"></script>
<script>
$( document ).ready(function() {
  function weekchange(startDate, endDate){
    jQuery.ajax({
      method: "POST",
      url: "ajax/populate_logs.php",
      data: {
        'start': startDate,
        'end': endDate,
        'role': <?php echo $_SESSION['user_role']; ?>
      },
      error: function(response) {
        //console.log(response);
      },
      success: function(response)
      {
        $('#appendLogs').html(response);
      }
    });
  };

  convertToWeekPicker($("#weekPicker"));

  function getWeekNumber(d) {
    d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
    d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay()||7));
    var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
    var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
    return [d.getUTCFullYear(), weekNo];
  }

  var result = getWeekNumber(new Date());

  $('#weekPicker').val(result[0]+'-'+result[1]);

  //populate hojas de tiempo
  var datepickerValue = new Date();
  startDate = new Date(datepickerValue.getFullYear(), datepickerValue.getMonth(), datepickerValue.getDate() - datepickerValue.getDay()).getTime();
  endDate = new Date(datepickerValue.getFullYear(), datepickerValue.getMonth(), datepickerValue.getDate() - datepickerValue.getDay() + 6).getTime();
  weekchange(startDate, endDate);
});
</script>