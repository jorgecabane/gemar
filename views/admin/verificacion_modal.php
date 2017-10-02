<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Advertencia!</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="undoEvent">Eliminar evento</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function() {
        $('#undoEvent').click(function() {
            var idEvent = $('#undoEvent').attr('idEvent');
            console.log(idEvent);
            $.ajax({
                url: 'Include/eliminarEvento.php',
                async: true,
                data: {"idEvento": idEvent},
                method: 'POST',
                success: function(output) {
                    if (output === '1') {
                        $('#calendar').fullCalendar('removeEvents', idEvent);
                        getCupos();
                    }//si se borro de la base de datos
                }//success
            });//ajax */

        });
    });

</script>