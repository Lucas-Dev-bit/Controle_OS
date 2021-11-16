<?php
require_once '_verificar_adm.php';
require_once '../../Controller/EquipamentoCTRL.php';
require_once '../../Controller/SetorCTRL.php';
require_once '../../VO/equipamentoVO.php';
require_once '../../VO/alocarequipamentoVO.php';

$ctrl_set = new SetorCTRL();
$idSetor = '';

if (isset($_POST['btnExcluir'])) {

    $vo = new AlocarEquipamentoVO();
    $ctrl_eq = new EquipamentoCRTL();
    $vo->setidAlocar($_POST['id_excluir']);
    
    $ret = $ctrl_eq->RemoverEquipamentoSetor($vo);

} else if (isset($_POST['btnProcurar'])) {

    $idSetor = $_POST['idSetor'];
    $ctrl_eq = new EquipamentoCRTL();
    $eqs = $ctrl_eq->SelecionarEquipamentosAlocados($idSetor);

    if (count($eqs) == 0) {
        $ret = 2;
    }
    //$ret = $ctrl->ExcluirEquipamento($vo);

}



$setores = $ctrl_set->ConsultarSetor();
?>




<!DOCTYPE html>
<html>

<head>
    <?php
    require_once '../../Template/_head.php';
    ?>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <?php
        include_once '../../Template/_topo.php';
        include_once '../../Template/_menu.php';
        ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><strong>Remover Equipamento</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Remover Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você poderá remover seus equipamentos</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="remover_equipamento.php">
                            <div class="form-group">

                                <label>Setor</label>
                                <select name="idSetor" id="idSetor" class="form-control">
                                    <option value="">Selecione...</option>
                                    <?php foreach ($setores as $item) { ?>
                                        <option value="<?= $item['id_setor'] ?>" <?= $idSetor == $item['id_setor'] ? 'selected' : '' ?>><?= $item['nome_setor'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button name="btnProcurar" onclick="return ValidarTela(11)" class="btn btn-info">Procurar</button>
                        </form>
                    </div>
                </div>

                <?php if (isset($eqs) && count($eqs) > 0) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de Equipamentos do Setor</h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Equipamento</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <?php foreach($eqs as $item) { ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $item['nome_tipo'] . ' / ' . $item['nome_modelo'] . ' / ' . $item['ident_equip'] ?></td>

                                                <td>
                                                <a href="#" name="btnExcluir" id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $item['id_alocarequip']?>', '<?= $item['nome_tipo'] . ' / ' . $item['nome_modelo'] . ' / ' . $item['ident_equip']?>')">Remover</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                    <form method="POST" action="remover_equipamento.php">
                                        <?php 
                                        require_once 'modal/_modal_excluir.php';
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </div>

        <?php
        include_once '../../Template/_footer.php';
        ?>

        <?php
        include_once '../../Template/_scripts.php';
        include_once '../../Template/_msg.php';
        ?>
</body>

</html>