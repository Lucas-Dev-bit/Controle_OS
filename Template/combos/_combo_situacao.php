<select name="situacao" id="situacao" class="form-control" placeholder="Digite Aqui">
    <option value="0" <?= isset($situacao) ? ($situacao == 0 ? 'selected' : '') : '' ?>>Todos</option>
    <option value="1" <?= isset($situacao) ? ($situacao == 1 ? 'selected' : '') : '' ?>>Aguardando atendimento</option>
    <option value="2" <?= isset($situacao) ? ($situacao == 2 ? 'selected' : '') : '' ?>>Atendido</option>
    <option value="3" <?= isset($situacao) ? ($situacao == 3 ? 'selected' : '') : '' ?>>Finalizado</option>
</select>