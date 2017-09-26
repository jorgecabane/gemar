
  $(document).ready(function() {
    

    /* initialize the external events
    -----------------------------------------------------------------*/

    /*cuando se cambia la criticidad se "instancia" nuevamente los pills pero con el color de la ésta
     */
    $('#criticidad').change(function () {
        color = $('#criticidad option:selected').attr('event-color');
        criticidadtext = $('#criticidad option:selected').text();
        idcriticidad = $('#criticidad').val();

        $('#external-events .fc-event, .medico').each(function () {
            $(this).css('background', color).css('border', color).css("line-height", "1.45");
            $(this).attr('event-color', color); // se asigna el color de la criticidad correspondiente a cada elemento

            userid = $(this).attr('userid');
            $(this).data('event', {
                title: criticidadtext, // use the element's text as the event title
                description: $.trim($(this).text()),
                //stick: true, // maintain when user navigates (see docs on the renderEvent method)
                color: color, //cambia el color al color asignado
                editable: true,
                criticidad: idcriticidad,
                userid: userid,
                fromBD: 0,
                saved: 0
            });
        });// each
    });


    $('#external-events .fc-event').each(function () {
      /*
       * funcion que asigna el event a un pill de usuarios la primera vez
       * que se crean los pills
       */
      color = $(this).attr('event-color');
      idcriticidad = $('#criticidad').val();
      criticidadtext = $('#criticidad option:selected').text();
      userid = $(this).attr('userid');
      // store data so the calendar knows to render an event upon drop
      $(this).data('event', {
          title: criticidadtext, // use the element's text as the event title
          description: $.trim($(this).text()),
          //stick: true, // maintain when user navigates (see docs on the renderEvent method)
          color: color, //cambia el color al color asignado
          editable: true,
          criticidad: idcriticidad,  
          userid: userid,
          fromBD: 0,
          saved: 0
      });

      // make the event draggable using jQuery UI
      $(this).draggable({
          zIndex: 999,
          revert: true, // will cause the event to go back to its original position after the drag
          revertDuration: 0
      });
    });//each


    /* initialize the calendar
    -----------------------------------------------------------------*/
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
//      defaultDate: '2015-05-12',
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar
      eventLimit: true, // allow "more" link when too many events
      events: [
      ]
    });
    
  });