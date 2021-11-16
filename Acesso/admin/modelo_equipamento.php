<?php
require_once '_verificar_adm.php';
require_once '../../Controller/ModeloCTRL.php';
require_once '../../VO/modeloeequipamentoVO.php';

$ctrl = new ModeloEquipCTRL();

if (isset($_POST['btnSalvar'])) {

    $vo = new ModeloEquipamentoVO();

    $vo->setnomeModelo($_POST['nome']);

    $ret = $ctrl->CadastrarModelo($vo);
} else if (isset($_POST['btnAlterar'])) {

    $vo = new ModeloEquipamentoVO();

    $vo->setnomeModelo($_POST['nome_modelo_alt']);
    $vo->setidModelo($_POST['id_modelo_alt']);

    $ret = $ctrl->AlterarModelo($vo);
} else if (isset($_POST['btnExcluir'])) {

    $vo = new ModeloEquipamentoVO();

    $vo->setidModelo($_POST['id_excluir']);

    $ret = $ctrl->ExcluirModelo($vo);
}

$modelos = $ctrl->ConsultarModelo();

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
                            <h1><strong>Gerenciar Modelo de Equipamento</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Gerenciar Modelo Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você gerencia todos os modelos de equipamentos cadastrados</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="modelo_equipamento.php">
                            <div class="form-group">

                                <label>Nome do Modelo</label>
                                <input name="nome" id="nome" class="form-control" placeholder="Digite Aqui">
                            </div>
                            <button name="btnSalvar" onclick="return InserirModelo()" class="btn btn-success">Salvar</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Modelos Cadastrados</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" id="resultadoTable">
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

                                <form method="post" action="modelo_equipamento.php">
                                    <?php
                                    include_once 'modal/_alterar_modeloequip.php';
                                    include_once 'modal/_modal_excluir.php';
                                    ?>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php
        include_once '../../Template/_footer.php';
        ?>

        <?php
        include_once '../../Template/_scripts.php';
        include_once '../../Template/_msg.php'
        ?>
        <script src="../../Template/js/ajx_modelo.js"></script>
</body>

</html>