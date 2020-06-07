$(document).ready(function (){
    $("#btnDeletar").click(function (event){
        event.preventDefault();
        if(!$("#modalConfirmDelete").length){
            $('body').append('  <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\n\
                                    <div class="modal-dialog" role="document">\n\
                                        <div class="modal-content">\n\
                                            <div class="modal-header bg-danger">\n\
                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle">&nbsp;</i>Aviso!</h5>\n\
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">\n\
                                                    <span aria-hidden="true">&times;</span>\n\
                                                </button>\n\
                                            </div>\n\
                                            <div class="modal-body text-center">\n\
                                                Deseja confirmar a deleção deste item?<br>\n\
                                                Essa operação não poderar ser desfeita!\n\
                                            </div>\n\
                                            <div class="modal-footer">\n\
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>\n\
                                                <button type="button" class="btn btn-danger" id="btnConfirmDelete">Deletar</button>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>');
        }
        
        $("#btnConfirmDelete").click(function(event){
            $("#formDestroy").submit();
        });
        $("#modalConfirmDelete").modal({shwon: true});
    });
});