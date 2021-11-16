<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/SetorCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/VO/setorVO.php';
//require_once '../../Controller/SetorCTRL.php';
//require_once '../../VO/setorVO.php';

$ctrl = new SetorCTRL();

if (isset($_POST['nome']) && $_POST['acao'] == 1) {

    $vo = new SetorVO();

    $vo->setnomeSetor($_POST['nome']);

    $ret = $ctrl->CadastrarSetor($vo);

    echo $ret;
} else if ($_POST['acao'] == 2) {

    $setores = $ctrl->ConsultarSetor(); ?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Setor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php foreach ($setores as $item) { ?>
            <tbody>
                <tr>
                    <td><?= $item['nome_setor'] ?></td>
                    <td>
                        <a href="#" name="btnAlterar" id="btnAlterar" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar-setor" onclick="CarregarDadosSetor('<?= $item['id_setor'] ?>', '<?= $item['nome_setor'] ?>')">Alterar</a>
                        <a href="#" name="btnExcluir" id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $item['id_setor'] ?>', '<?= $item['nome_setor'] ?>')">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>

<?php } ?>