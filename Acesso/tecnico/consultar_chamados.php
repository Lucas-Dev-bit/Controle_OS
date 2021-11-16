<?php

require_once '../../Controller/ChamadoCTRL.php';
require_once '_verificar_tec.php';
require_once '../../VO/chamadoVO.php';


if (isset($_POST['btnBuscar'])) {

    $ctrl = new ChamadoCTRL();

    $situacao = $_POST['situacao'];

    $chs = $ctrl->FiltrarChamado($situacao, UtilCTRL::SetorLogado());

    if (count($chs) == 0) {
        $ret = 2;
    }
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
                            <h1><strong>Consultar Chamados</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Chamados realizados</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Consulte todos chamados e acompanhe os atendimentos</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="consultar_chamados.php">
                            <div class="form-group">
                                <label>Escolha a Situação</label>
                                <?php include_once '../../Template/combos/_combo_situacao.php' ?>
                            </div>
                            <button name="btnBuscar" class="btn btn-info">Buscar</button>
                        </form>
                    </div>
                </div>


                <?php if (isset($chs) && count($chs) > 0) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Resultados Encontrados</h3>
                                </div>

                                <div class="card-body table-responsive">
                                    <table class="table table-bordered .naoQuebraTable">
                                        <thead>
                                            <tr>
                                                <th>Ação</th>
                                                <th>Data Abertura</th>
                                                <th>Funcionário</th>
                                                <th>Equipamento</th>
                                                <th>Problema</th>
                                                <th>Situação</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($chs as $item) { ?>
                                                <tr>
                                                <td>
                                                    
                                                    <a href="atender_chamado.php?id=<?= $item['id_chamado']?>" class="btn btn-warning btn-xs">Ver Mais</a>
                                                    
                                                </td>
                                                    <td><?= UtilCTRL::DataExibir($item['data_chamado']) ?></td>
                                                    <td><?= $item['funcionario'] ?></td>
                                                    <td><?= $item['ident_equip'] . ' / ' . $item['desc_equip'] ?></td>
                                                    <td><?= $item['desc_chamado'] ?></td>
                                                    <td><?= UtilCTRL::SituacaoChamado($item['data_atendimento'], $item['data_atendimento'], $item['data_encerramento']) ?></td>
                                                    
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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