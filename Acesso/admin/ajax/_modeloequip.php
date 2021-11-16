<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/ModeloCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/VO/modeloeequipamentoVO.php';
//require_once '../../Controller/ModeloCTRL.php';
//require_once '../../VO/modeloeequipamentoVO.php';

$ctrl = new ModeloEquipCTRL();

if (isset($_POST['nome']) && $_POST['acao'] == 1) {

    $vo = new ModeloEquipamentoVO();

    $vo->setnomeModelo($_POST['nome']);

    $ret = $ctrl->CadastrarModelo($vo);

    echo $ret;
} else if ($_POST['acao'] == 2) {

    $modelos = $ctrl->ConsultarModelo(); ?>

    <table class="table table-hover">
        <thead>

            <tr>
                <th>Nome do Modelo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modelos as $item) { ?>
                <tr>
                    <td><?= $item['nome_modelo'] ?></td>
                    <td>
                        <a href="#" name="btnAlterar" id="btnAlterar" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar-modelo" onclick="CarregarDadosModeloEquip('<?= $item['id_modeloequip'] ?>', '<?= $item['nome_modelo'] ?>')">Alterar</a>
                        <a href="#" name="btnExcluir" id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $item['id_modeloequip'] ?>', '<?= $item['nome_modelo'] ?>')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } ?>