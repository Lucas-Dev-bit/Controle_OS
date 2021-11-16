<?php

require_once '_verificar_adm.php';
require_once '../../Controller/EquipamentoCTRL.php';
require_once '../../Controller/SetorCTRL.php';
require_once '../../VO/alocarequipamentoVO.php';

$ctrl_set = new SetorCTRL();
$ctrl_equ = new EquipamentoCRTL();


if (isset($_POST['btnSalvar'])) {
    
    $vo = new AlocarEquipamentoVO();
    
    $vo->setidEquipamento($_POST['equipamento']);
    $vo->setidSetor($_POST['setor']);
    
    $ret = $ctrl_equ->AlocarEquipamento($vo);
}
$eqs = $ctrl_equ->FiltrarEquipamentoNaoAlocados();
$sets = $ctrl_set->ConsultarSetor();
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
                            <h1><strong>Alocar Equipamento</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Alocar Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você aloca um equipamento ao setor específico</h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="alocar_equipamento.php">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Setor</label>
                                    <select name="setor" id="setor" class="form-control">
                                        <option value="">Selecione...</option>
                                        <?php foreach ($sets as $item) { ?>
                                        <option value="<?= $item['id_setor']?>"><?= $item['nome_setor'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Equipamento</label>
                                    <select name="equipamento" id="equipamento" class="form-control">
                                        <option value="">Selecione...</option>
                                        <?php foreach ($eqs as $item) { ?>
                                            <option value="<?= $item['id_equipamento'] ?>"><?= $item['nome_tipo'] . ' | ' .  $item['nome_modelo'] . ' | ' . $item['ident_equip'] ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <center>
                            <button name="btnSalvar" onclick="return ValidarTela(2)" class="btn btn-info">Alocar</button>
                            </center>

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