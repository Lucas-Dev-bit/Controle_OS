<?php
require_once '_verificar_adm.php';
require_once '../../Controller/NovoEquipCTRL.php';
require_once '../../VO/quipamentoVO.php';

$ctrl = new EquipamentoCRTL();

if (isset($_POST['btnSalvar'])) {

    $vo = new EquipamentoVO();

    $vo->setidTipoEquip($_POST['tipo']);
    $vo->setidModeloEquip($_POST['modelo']);
    $vo->setIdentEquip($_POST['ident']);
    $vo->setDescEquip($_POST['desc']);


    $ret = $ctrl->GravarEquipamento($vo);
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
                            <h1><strong>Novo Equipamento</strong> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Novo Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você poderá cadastrar seus equipamentos</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="novo_equipamento.php">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="1">teste</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Modelo</label>
                                    <select name="modelo" id="modelo" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="1">teste</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Identificação</label>
                                <input name="ident" id="ident" class="form-control" placeholder="Digite Aqui">
                            </div>

                            <div class="form-group">

                                <label>Descrição</label>
                                <textarea name="desc" id="desc" class="form-control" placeholder="Digite Aqui..."></textarea>
                            </div>
                            <button name="btnSalvar" onclick="return ValidarTela(3)" class="btn btn-success">Gravar</button>
                    </div>
                    </form>
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