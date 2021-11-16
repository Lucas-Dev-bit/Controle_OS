<?php
require_once '_verificar_adm.php';
require_once '../../Controller/EquipamentoCTRL.php';
require_once '../../VO/equipamentoVO.php';

require_once '../../DAO/ModeloDAO.php';
require_once '../../DAO/TipoEquipDAO.php';

$dao_mod = new ModeloDAO();
$dao_tipo = new TipoEquipDao();

$cod = '';

if(isset($_GET['cod']) && is_numeric($_GET['cod'])){

    $ctrl = new EquipamentoCRTL();
    $cod = $_GET['cod'];
    $dados = $ctrl->DetalharEquipamento($cod);
    if(count($dados) == 0){
        header('location: consultar_equipamento.php');
    }

}

if (isset($_POST['btnSalvar'])) {

    $vo = new EquipamentoVO();
    $ctrl = new EquipamentoCRTL();

    $vo->setidEquip($_POST['cod']);
    $vo->setidTipoEquip($_POST['tipo']);
    $vo->setidModeloEquip($_POST['modelo']);
    $vo->setIdentEquip($_POST['ident']);
    $vo->setDescEquip($_POST['desc']);

    $ret = $ctrl->GravarEquipamento($vo);

    if($_POST['cod'] != ''){
        header('location: consultar_equipamento.php?ret=' . $ret . '&tipo' . $_POST['tipo']);
    }
}

$modelos = $dao_mod->ConsultarModelo();
$tipos = $dao_tipo->ConsultarTipo();

//$equip = $ctrl->ConsultarEquipamento();

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
        include_once '../../template/_topo.php';
        include_once '../../Template/_menu.php';
        ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><strong><?= $cod != '' ? 'Alterar' : 'Novo' ?> Equipamento</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gerencie Todos os Equipamentos Aqui</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="equipamento.php">
                            <input type="hidden" name="cod" value="<?= $cod ?>">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="">Selecione...</option>
                                        <?php for ($i=0; $i<count($tipos); $i++) { ?>
                                            <option value="<?= $tipos[$i]['id_tipoequip'] ?>" <?= $cod != '' ? ($tipos[$i]['id_tipoequip'] == $dados[0]['id_tipoequip'] ? 'selected' : '') : '' ?>>
                                                <?= $tipos[$i]['nome_tipo'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Modelo</label>
                                    <select name="modelo" id="modelo" class="form-control">
                                        <option value="">Selecione...</option>
                                        <?php for ($i=0; $i<count($modelos); $i++) { ?>
                                            <option value="<?= $modelos[$i]['id_modeloequip'] ?>" <?= $cod != '' ? ($modelos[$i]['id_modeloequip'] == $dados[0]['id_modeloequip'] ? 'selected' : '') : '' ?> >
                                                <?= $modelos[$i]['nome_modelo'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Identificação</label>
                                <input name="ident" id="ident" class="form-control" placeholder="Digite Aqui" value="<?= $cod != '' ? $dados[0]['ident_equip'] : '' ?>">
                            </div>

                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea name="desc" id="desc" class="form-control" placeholder="Digite Aqui..."><?= $cod != '' ? $dados[0]['desc_equip'] : '' ?></textarea>
                            </div>
                            <button name="btnSalvar" onclick="return ValidarTela(3)" class="btn btn-success"><?= $cod != '' ? 'Alterar' : 'Cadastrar' ?></button>
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