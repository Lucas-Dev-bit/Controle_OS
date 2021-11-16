<?php
require_once '_verificar_adm.php';
require_once '../../Controller/SetorCTRL.php';
require_once '../../VO/setorVO.php';

$ctrl = new SetorCTRL();

if (isset($_POST['btnSalvar'])) {

    $vo = new SetorVO();

    $vo->setnomeSetor($_POST['nome']);

    $ret = $ctrl->CadastrarSetor($vo);
} else if (isset($_POST['btnAlterar'])) {

    $vo = new SetorVO();

    $vo->setnomeSetor($_POST['nome_setor_alt']);
    $vo->setidSetor($_POST['id_setor_alt']);

    $ret = $ctrl->AlterarSetor($vo);
} else if (isset($_POST['btnExcluir'])) {

    $vo = new SetorVO();

    $vo->setidSetor($_POST['id_excluir']);

    $ret = $ctrl->ExcluirSetor($vo);
}

$setores = $ctrl->ConsultarSetor();

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
                            <h1><strong>Gerenciar Setor</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Setor</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gerencie Todos os Setores Aqui</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="setor.php">
                            <div class="form-group">
                                <label>Nome do Setor</label>
                                <input name="nome" id="nome" class="form-control" placeholder="Digite Aqui">
                            </div>
                            <button name="btnSalvar" onclick="return InserirSetor()" class="btn btn-success">Gravar</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Setores Cadastrados</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" id="resultadoTable">
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
                                <form method="POST" action="setor.php">
                                    <?php
                                    include_once 'modal/_alterar_setor.php';
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
        include_once '../../Template/_msg.php';
        ?>
        <script src="../../Template/js/ajx_setor.js"></script>
</body>

</html>