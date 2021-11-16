<?php
require_once '_verificar_adm.php';
require_once '../../Controller/EquipamentoCTRL.php';
require_once '../../Controller/TipoEquipCTRL.php';
require_once '../../VO/equipamentoVO.php';

$tipo_filtro = '';
$ctrl_tipo = new TipoEquipamentoCTRL();

if(isset($_GET['tipo']) && is_numeric($_GET['tipo'])){
    $ctrl_equip = new EquipamentoCRTL();
    $tipo_filtro = $_GET['tipo'];
    $eqs = $ctrl_equip->FiltrarEquipamento($tipo_filtro);
}
if (isset($_POST['btnBuscar'])) {
    $ctrl_equip = new EquipamentoCRTL();
    $tipo_filtro = $_POST['tipoequip'];

    $eqs = $ctrl_equip->FiltrarEquipamento($tipo_filtro);

    if (count($eqs) == 0) {
        $ret = 2;
    }
} else if(isset($_POST['btnExcluir'])){
    $ctrl_equip = new EquipamentoCRTL();
    $tipo_filtro = $_POST['tipo_filtro'];
    $vo = new EquipamentoVO();
    $vo->setidEquip($_POST['id_excluir']);

    $ret = $ctrl_equip->ExcluirEquipamento($vo);
    $eqs = $ctrl_equip->FiltrarEquipamento($tipo_filtro);
}

$tipos = $ctrl_tipo->ConsultarTipo();

//$ctrl = new EquipamentoCRTL();
//if (isset($_POST['btnBuscar'])) {

//$vo = new EquipamentoVO();

//$vo->setidTipoEquip($_POST['nome']);

//$ret = $ctrl->ConsultarEquipamento($vo);
//}

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
                            <h1><strong>Consultar Equipamento</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Consultar Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Consulte Todos os Equipamentos Aqui</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="consultar_equipamento.php">
                            <div class="form-group">
                                <label>Pesquisar por Tipo</label>
                                <select name="tipoequip" id="tipo" class="form-control">
                                    <option value="">Selecione...</option>
                                    <?php foreach ($tipos as $item) { ?>
                                        <option value="<?= $item['id_tipoequip'] ?>" <?= $item['id_tipoequip'] == $tipo_filtro ? 'selected' : '' ?>><?= $item['nome_tipo'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button name="btnBuscar" onclick="return ValidarTela(10)" class="btn btn-info">Buscar</button>
                        </form>
                    </div>
                </div>

                <?php if (isset($eqs) && count($eqs) > 0) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Equipamentos Cadastrados</h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Modelo</th>
                                                <th>Identificação</th>
                                                <th>Descrição</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($eqs as $item) { ?>
                                                <tr>
                                                    <td><?= $item['nome_tipo'] ?></td>
                                                    <td><?= $item['nome_modelo'] ?></td>
                                                    <td><?= $item['ident_equip'] ?></td>
                                                    <td><?= $item['desc_equip'] ?></td>
                                                    <td>
                                                        <a href="equipamento.php?cod=<?= $item['id_equipamento']?>" name="btnAlterar" id="btnAlterar" class="btn btn-warning btn-xs">Alterar</a>
                                                        <a href="#" name="btnExcluir" id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $item['id_equipamento']?>', '<?= $item['ident_equip'] .' / '. $item['desc_equip']?>')">Excluir</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <form method="post" action="consultar_equipamento.php">
                                        <input type="hidden" name="tipo_filtro" value="<?= $tipo_filtro ?>">
                                    
                                    <?php 

                                     include_once 'modal/_modal_excluir.php';
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