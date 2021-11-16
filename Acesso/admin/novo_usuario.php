<?php

require_once '_verificar_adm.php';
require_once '../../Controller/UsuarioCTRL.php';
require_once '../../Controller/SetorCTRL.php';
require_once '../../VO/usuarioVO.php';
require_once '../../VO/funcionarioVO.php';
require_once '../../VO/tecnicoVO.php';

$tipo_tela = 'NOVO_USUARIO';

if (isset($_POST['btnSalvar'])) {

    $tipo = $_POST['tipo'];
    $ctrl = new UsuarioCTRL();


    switch ($tipo) {

        case 1:
            $vo = new UsuarioVO();

            $vo->setTipo($tipo);
            $vo->setCpf($_POST['cpf']);
            $vo->setNome($_POST['nome']);

            $ret = $ctrl->CadastrarUserAdm($vo);

            break;

        case 2:
            $vo = new FuncionarioVO();

            //Setar as propriedades referente ao USUARIO
            $vo->setTipo($tipo);
            $vo->setCpf($_POST['cpf']);
            $vo->setNome($_POST['nome']);

            //Setar as propriedades referente ao FUNCIONARIO
            $vo->setEndereco($_POST['endereco']);
            $vo->setTel($_POST['telefone']);
            $vo->setEmail($_POST['email']);
            $vo->setidSetor($_POST['setor']);

            $ret = $ctrl->CadastrarUserFuncionario($vo);

            break;

        case 3:
            $vo = new TecnicoVO();

            //Setar as propriedades referente ao USUARIO
            $vo->setTipo($tipo);
            $vo->setCpf($_POST['cpf']);
            $vo->setNome($_POST['nome']);

            //Setar as propriedades referente ao FUNCIONARIO
            $vo->setEndereco($_POST['endereco']);
            $vo->setTel($_POST['telefone']);
            $vo->setEmail($_POST['email']);

            $ret = $ctrl->CadastrarUserTecnico($vo);

            break;
        default:
            $ret = 0;
            break;
    }
}

$ctrl = new SetorCTRL();
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
                            <h1><strong>Novo Usuário</strong> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Novo Usuário</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você cadastra um novo usuário</h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="novo_usuario.php">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Tipo</label>
                                    <?php include_once '../../Template/combos/_combo_tipouser.php'; ?>
                                </div>
                            </div>

                            <div id="div123" style="display: none;">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>CPF</label>
                                        <input name="cpf" onchange="ValidarCPF(this.value, 0)" id="cpf" class="form-control num cpf" placeholder="Digite Aqui...">
                                        <label id="lblCpfVal" style="color: red;"></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Nome</label>
                                        <input name="nome" id="nome" class="form-control" placeholder="Digite Aqui..">
                                    </div>
                                </div>
                            </div>


                            <div id="div2" style="display: none;">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Setor</label>
                                        <select name="setor" id="setor" class="form-control">
                                            <option value="">Selecione...</option>
                                            <?php foreach ($setores as $item) { ?>
                                                <option value="<?= $item['id_setor'] ?>">
                                                    <?= $item['nome_setor'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="div23" style="display: none;">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>E-mail</label>
                                        <input name="email" onchange='ValidarEMAIL(this.value, $("#tipo").val())' id="email" class="form-control" placeholder="Digite Aqui...">
                                        <label id="lblEmailVal" style="color: red;"></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Telefone</label>
                                        <input name="telefone" id="telefone" class="form-control num tel" placeholder="Digite Aqui...">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Endereço</label>
                                        <input name="endereco" id="endereco" class="form-control" placeholder="Digite Aqui...">
                                    </div>
                                </div>
                            </div>

                            <button id="btnSalvar" name="btnSalvar" onclick="return ValidarTela(4)" style="display: none;" class="btn btn-success">Gravar</button>

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