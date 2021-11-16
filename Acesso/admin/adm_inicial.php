<?php

require_once '../../Controller/ChamadoCTRL.php';
require_once '_verificar_adm.php';

$ctrl = new ChamadoCTRL();
$dados = $ctrl->GerarGraficoInicial();

?>

<!DOCTYPE html>
<html>

<head>
    <?php
    require_once '../../Template/_head.php';
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load("current", {
                                packages: ['corechart']
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ["Element", "qtd", {
                                        role: "style"
                                    }],
                                    ["Aguardando", <?= $dados[0]['aguardando']?>, "yellow"],
                                    ["Em Atendimento", <?= $dados[0]['atendimento'] ?>, "blue"],
                                    ["Finalizado", <?= $dados[0]['encerrado'] ?>, "green"]
                        
                                ]);

                                var view = new google.visualization.DataView(data);
                                view.setColumns([0, 1,
                                    {
                                        calc: "stringify",
                                        sourceColumn: 1,
                                        type: "string",
                                        role: "annotation"
                                    },
                                    2
                                ]);

                                var options = {
                                    title: "Totais Situações",
                                    width: 800,
                                    height: 600,
                                    bar: {
                                        groupWidth: "95%"
                                    },
                                    legend: {
                                        position: "none"
                                    },
                                };
                                var chart = new google.visualization.ColumnChart(document.getElementById("grafico_tempo_real"));
                                chart.draw(view, options);
                            }
                        </script>
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
                            <h1><strong>Página Inicial</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Grafico</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dados em tempo real</h3>
                    </div>
                    <div class="card-body">
                        
                        <div id="grafico_tempo_real" style="width: 900px; height: 700px;"></div>
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