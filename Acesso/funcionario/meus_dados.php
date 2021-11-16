<?php

require_once '../../Controller/UsuarioCTRL.php';
require_once '_verificar_func.php';
require_once '../../VO/funcionarioVO.php';

$ctrl = new UsuarioCTRL();

if (isset($_POST['btnGravar'])) {

    $vo = new FuncionarioVO();

    $vo->setIdUser(UtilCTRL::CodigoLogado());
    $vo->setNome($_POST['nome']);
    $vo->setCpf($_POST['cpf']);
    $vo->setEmail($_POST['email']);
    $vo->setTel($_POST['telefone']);
    $vo->setEndereco($_POST['endereco']);
    $vo->setidSetor(UtilCTRL::SetorLogado());

    $ret = $ctrl->AlterarUsuarioFunc($vo);
}

$dados = $ctrl->DetalharUsuario(UtilCTRL::CodigoLogado());

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
                            <h1><strong>Meus Dados</strong> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                                <li class="breadcrumb-item active">Meus Dados</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você poderá cadastrar seus dados</h3>
                    </div>
                    <form method="POST" action="meus_dados.php">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" id="setor" value="<?= $dados[0]['id_setor'] ?>">
                                <input type="hidden" id="tipo" value="<?= $dados[0]['tipo_usuario'] ?>">
                                <div class="form-group col-md-6">
                                    <label>Nome</label>
                                    <input readonly name="nome" id="nome" class="form-control" value="<?= $dados[0]['nome_usuario'] ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>CPF</label>
                                    <input readonly name="cpf" id="cpf" class="form-control cpf" value="<?= $dados[0]['cpf_usuario'] ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>E-mail</label>
                                    <input name="email" id="email" class="form-control" value="<?= $dados[0]['email_func'] ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Telefone</label>
                                    <input name="telefone" id="telefone" class="form-control num cel" value="<?= $dados[0]['tel_func'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Endereço</label>
                                <input name="endereco" id="endereco" class="form-control" placeholder="Digite aqui..." value="<?= $dados[0]['end_func'] ?>">
                            </div>

                            <button name="btnGravar" onclick="return ValidarTela(4)" class="btn btn-success">Gravar</button>

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