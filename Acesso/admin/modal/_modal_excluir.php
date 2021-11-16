<div class="modal fade" id="modal-excluir">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Confirmação de Exclusão</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id_excluir" id="id_excluir">
                <label>Deseja excluir o item:<b> <span id="nome_excluir"> </span> ? </b></label>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-outline-dark" name="btnExcluir">Sim</button>
            </div>

        </div>
    </div>
</div>