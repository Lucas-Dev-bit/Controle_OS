<?php
require_once '_verificar_adm.php';
require_once '../../Controller/TipoEquipCTRL.php';
require_once '../../VO/tipoequipamentoVO.php';

$ctrl = new TipoEquipamentoCTRL;

if (isset($_POST['btnSalvar'])) {

    $vo = new TipoEquipamentoVO();

    $vo->setnomeTipo($_POST['nome']);

    $ret = $ctrl->CadastrarTipoEquip($vo);
    
}else if(isset($_POST['btnAlterar'])){

    $vo = new TipoEquipamentoVO();

    $vo->setnomeTipo($_POST['nome_tipo_alt']);
    $vo->setidTipo($_POST['id_tipo_alt']);

    $ret = $ctrl->AlterarTipo($vo);

}else if(isset($_POST['btnExcluir'])){

    $vo = new TipoEquipamentoVO();

    $vo->setidTipo($_POST['id_excluir']);

    $ret = $ctrl->ExcluirTipo($vo);
}

$tipos = $ctrl->ConsultarTipo();

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
                            <h1><strong>Gerenciar Tipo de Equipamento</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Gerenciar Tipo Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gerencie Todos os Tipos de Equipamentos Aqui</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="tipo_equipamento.php">
                            <div class="form-group">
                                <label>Nome do Tipo</label>
                                <input name="nome" id="nome" class="form-control" placeholder="Digite Aqui">
                            </div>
                            <button name="btnSalvar" onclick="return InserirTipo()" class="btn btn-success">Gravar</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tipos Cadastrados</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" id="resultadoTable">
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
                                                    <a href="#" name="btnAlterar" id="btnAlterar" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar-tipo" onclick="CarregarDadosTipoEquip('<?= $item['id_tipoequip']?>', '<?= $item['nome_tipo']?>')">Alterar</a>
                                                    <a href="#" name="btnExcluir" id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $item['id_tipoequip']?>', '<?= $item['nome_tipo']?>')">Excluir</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <form method="post" action="tipo_equipamento.php">
                                    <?php 
                                     include_once 'modal/_alterar_tipoequip.php'; 
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
        <script src="../../Template/js/ajx_tipo.js"></script>
</body>

</html>