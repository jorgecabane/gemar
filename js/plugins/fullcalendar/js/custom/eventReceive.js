var eventReceive = function(event) {
    if (event.start.hasTime()) {
        //se verifica si el evento es dropped desde la vista mesual
        //no tiene hora asignada sino que es solo fecha
        saveBD(event);
    }
    else {
        $('#modalEvento').modal('show');
        $('#eventDate').html('<div class="alert alert-sm alert-info">' + event.start.format() + '</div>');
        $('#eventTitle').html('<div class="alert alert-sm alert-info">' + event.description + ' <strong>(' + event.title + ')</strong></div>');
        $('#evento')
                .attr('start', event.start.format())
                .attr('end', event.end.format())
                .attr('idtm', event.idTM)
                .attr('ideco', event.idEco)
                .attr('color', event.color)
                .attr('title', event.title)
                .attr('description', event.description);
    }
};


