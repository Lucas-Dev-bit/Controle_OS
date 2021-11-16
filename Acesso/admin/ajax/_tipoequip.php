<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/TipoEquipCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/VO/tipoequipamentoVO.php';
//require_once '../../Controller/TipoEquipCTRL.php';
//require_once '../../VO/tipoequipamentoVO.php';

$ctrl = new TipoEquipamentoCTRL;

if (isset($_POST['nome']) && $_POST['acao'] == 1) {

    $vo = new TipoEquipamentoVO();

    $vo->setnomeTipo($_POST['nome']);

    $ret = $ctrl->CadastrarTipoEquip($vo);

    echo $ret;
} else if ($_POST['acao'] == 2) {

    $tipos = $ctrl->ConsultarTipo(); ?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tipos as $item) { ?>
                <tr>
                    <td><?= $item['nome_tipo'] ?></td>
                    <td>
                        <a href="#" name="btnAlterar" id="btnAlterar" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar-tipo" onclick="CarregarDadosTipoEquip('<?= $item['id_tipoequip'] ?>', '<?= $item['nome_tipo'] ?>')">Alterar</a>
                        <a href="#" name="btnExcluir" id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $item['id_tipoequip'] ?>', '<?= $item['nome_tipo'] ?>')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } ?>