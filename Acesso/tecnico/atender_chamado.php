<?php

require_once '../../Controller/ChamadoCTRL.php';
require_once '_verificar_tec.php';
require_once '../../VO/chamadoVO.php';

$ctrl = new ChamadoCTRL();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $dados = $ctrl->DetalharChamado($_GET['id']);

    if (count($dados) == 0) {
        header('location: consultar_chamados.php');
        exit;
    }
} else if (isset($_POST['btnAtender'])) {

    $vo = new ChamadoVO();
    $vo->setidCha($_POST['id']);

    $ret = $ctrl->AtenderChamado($vo);

    header('location: atender_chamado.php?id=' . $_POST['id'] . '&ret=' . $ret);
    exit;
} else if (isset($_POST['btnFinalizar'])) {
    $vo = new ChamadoVO();
    $vo->setidCha($_POST['id']);
    $vo->setidAlocarEquip($_POST['idAlocar']);
    $vo->setlaudoTec($_POST['laudo']);

    $ret = $ctrl->FinalizarChamado($vo);

    header('location: atender_chamado.php?id=' . $_POST['id'] . '&ret=' . $ret);
    exit;
} else {
    header('location: consultar_chamados.php');
    exit;
}

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
                            <h1><strong>Atender Chamado</strong> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Atender Chamado</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Faça os atendimentos aqui</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Data</label>
                                <input disabled name="data" id="data" class="form-control" value="<?= UtilCTRL::DataExibir($dados[0]['data_chamado']) ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Funcionário</label>
                                <input disabled name="funcionario" id="funcionario" class="form-control" value="<?= $dados[0]['funcionario'] ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Setor</label>
                                <input disabled name="setor" id="setor" class="form-control" placeholder="Digite Aqui..." value="<?= $dados[0]['nome_setor'] ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Equipamento</label>
                                <input disabled name="equipamento" id="equipamento" class="form-control" placeholder="Digite Aqui..." value="<?= $dados[0]['ident_equip'] . ' / ' . $dados[0]['desc_equip'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Descrição do problema</label>
                            <textarea disabled name="desc" id="desc" class="form-control" placeholder="Digite Aqui..."><?= $dados[0]['desc_chamado'] ?> </textarea>
                        </div>

                        <form method="post" action="atender_chamado.php">

                            <input type="hidden" name="id" value="<?= $dados[0]['id_chamado'] ?>">
                            <input type="hidden" name="idAlocar" value="<?= $dados[0]['id_alocarequip'] ?>" > 
                            <?php if ($dados[0]['data_atendimento'] != '') { ?> 
                                <div class="form-group">
                                <label>Laudo</label>
                                <textarea name="laudo" id="laudo" readonly class="form-control" placeholder="Digite Aqui..." > <?= $dados[0]['data_encerramento'] != '' ? 'reandonly' : '' ?> <?= $dados[0]['laudo_tecnico'] ?></textarea>
                            </div>
                <?php } ?>

                <?php if ($dados[0]['data_atendimento'] == '') { ?>

                    <button name="btnAtender" class="btn btn-success">Atender</button>

                <?php } else if ($dados[0]['data_atendimento'] != '' && $dados[0]['data_encerramento'] == '') { ?>

                    <button name="btnFinalizar" onclick="return ValidarTela(15)" class="btn btn-success">Finalizar</button>
                <?php } else { ?>
                    <i>Finalizado no dia <?= UtilCTRL::DataExibir($dados[0]['data_encerramento']) ?> às <?= $dados[0]['hora_encerramento'] ?> </i>
                <?php } ?>

                </form>
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
</body>

</html>