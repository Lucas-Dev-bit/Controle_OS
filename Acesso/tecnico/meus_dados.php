<?php

require_once '../../Controller/UsuarioCTRL.php';
require_once '_verificar_tec.php';
require_once '../../VO/tecnicoVO.php';

$ctrl = new UsuarioCTRL();

if (isset($_POST['btnSalvar'])) {

    $vo = new TecnicoVO();

    $vo->setIdUser(UtilCTRL::CodigoLogado());
    $vo->setNome($_POST['nome']);
    $vo->setCpf($_POST['cpf']);
    $vo->setTel($_POST['telefone']);
    $vo->setEndereco($_POST['endereco']);
    $vo->setEmail($_POST['email']);

    $ret = $ctrl->AlterarUsuarioTec($vo);
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
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
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

                    <div class="card-body">
                        <form method="post" action="meus_dados.php">
                            <div class="row">
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
                                    <input name="email" id="email" class="form-control" value="<?= $dados[0]['email_tec'] ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Telefone</label>
                                    <input name="telefone" id="telefone" class="form-control tel" value="<?= $dados[0]['tel_tec'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Endereço</label>
                                <input name="endereco" id="endereco" class="form-control" value="<?= $dados[0]['end_tec'] ?>">
                            </div>

                            <button name="btnSalvar" class="btn btn-success">Gravar</button>
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