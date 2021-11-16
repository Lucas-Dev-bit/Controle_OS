<?php
require_once '_verificar_func.php';
require_once '../../Controller/ChamadoCTRL.php';
require_once '../../VO/chamadoVO.php';

$ctrl = new ChamadoCTRL();

if (isset($_POST['btnSalvar'])) {
    $vo = new ChamadoVO();

    $ids = explode('-', $_POST['equip']);

    $vo->setdescCha($_POST['desc']);
    $vo->setidEquip($ids[0]);
    $vo->setidAlocarEquip($ids[1]);

    $ret = $ctrl->AbrirChamado($vo);
}

$eqs = $ctrl->FiltrarEquipamentosChamado();

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
                            <h1><strong>Novo Chamado</strong> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                                <li class="breadcrumb-item active">Novo Chamado</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Realize aberturas de chamados aqui</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="novo_chamado.php">
                            <div class="form-group">
                                <label>Escolha o Equipamento</label>
                                <select name="equip" id="equip" class="form-control">
                                    <option value="">Selecione</option>
                                    <?php for ($i = 0; $i < count($eqs); $i++) { ?>
                                        <option value="<?= $eqs[$i]['id_equipamento'] . '-' . $eqs[$i]['id_alocarequip'] ?>"><?= $eqs[$i]['ident_equip'] . ' / ' . $eqs[$i]['desc_equip'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Descreva o Problema</label>
                                <textarea name="desc" id="desc" class="form-control" placeholder="Digite Aqui..."></textarea>
                            </div>

                            <button name="btnSalvar" class="btn btn-success" onclick="return ValidarTela(14)">Salvar</button>
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