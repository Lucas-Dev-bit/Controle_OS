<?php

require_once '_verificar_adm.php';
require_once '../../Controller/UsuarioCTRL.php';
require_once '../../Controller/SetorCTRL.php';
require_once '../../VO/usuarioVO.php';
require_once '../../VO/funcionarioVO.php';
require_once '../../VO/tecnicoVO.php';

$ctrl = new UsuarioCTRL();

if (
    isset($_GET['tipo']) && is_numeric($_GET['tipo']) &&
    isset($_GET['cod']) && is_numeric($_GET['cod'])

) {
    $tipo = $_GET['tipo'];
    $cod = $_GET['cod'];

    $dados = $ctrl->DetalharUsuario($cod);

    if (count($dados) == 0) {
        header('location: consultar_usuario.php');
        exit;
    } else {
        //verifica se é um funcionario para carregar os setores
        if ($dados[0]['tipo_usuario'] == 2) {
            $ctrl = new SetorCTRL();
            $setores = $ctrl->ConsultarSetor();
        }
    }
} 

else if (isset($_POST['btnSalvar'])) {

    $tipo = $_POST['tipo'];

    switch ($tipo) {

        case 1:
            $vo = new UsuarioVO();

            $vo->setIdUser($_POST['cod']);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);
            
            $ret = $ctrl->AlterarUsuarioAdm($vo);

            break;

        case 2:
            $vo = new FuncionarioVO();

            //Setar as propriedades referente ao USUARIO
            $vo->setIdUser($_POST['cod']);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);
            
            //Setar as propriedades referente ao FUNCIONARIO
            $vo->setEndereco($_POST['endereco']);
            $vo->setTel($_POST['telefone']);
            $vo->setEmail($_POST['email']);
            $vo->setidSetor($_POST['setor']);

            $ret = $ctrl->AlterarUsuarioFunc($vo);

            break;

        case 3:
            $vo = new TecnicoVO();

            //Setar as propriedades referente ao USUARIO
            $vo->setIdUser($_POST['cod']);
            $vo->setNome($_POST['nome']);
            $vo->setCpf($_POST['cpf']);
            
            //Setar as propriedades referente ao FUNCIONARIO
            $vo->setEndereco($_POST['endereco']);
            $vo->setTel($_POST['telefone']);
            $vo->setEmail($_POST['email']);

            $ret = $ctrl->AlterarUsuarioTec($vo);

            break;
        default:
            $ret = 0;
            break;
    }

    header('location: consultar_usuario.php?ret=' . $ret);
    exit;

}else {
    header('location: consultar_usuario.php');
    exit;
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
                            <h1><strong>Alterar Usuário</strong> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Alterar Usuário</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você poderá alterar o usuário</h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="alterar_usuario.php">
                            <div class="row">
                                <input type="hidden" name="tipo" value="<?= $dados[0]['tipo_usuario'] ?>">
                                <input type="hidden" name="cod" value="<?= $dados[0]['id_usuario'] ?>">
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>CPF</label>
                                    <input name="cpf" onchange="ValidarCPF(this.value, '<?= $dados[0]['id_usuario'] ?>')" id="cpf" class="form-control num cpf" placeholder="Digite Aqui..." value="<?= $dados[0]['cpf_usuario'] ?>">
                                        <label id="lblCpfVal" style="color: red;"></label>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Nome</label>
                                    <input name="nome" id="nome" class="form-control" placeholder="Digite Aqui.." value="<?= $dados[0]['nome_usuario'] ?>">
                                </div>
                            </div>

                            <?php if ($dados[0]['tipo_usuario'] == 2) {  ?>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Setor</label>
                                        <select name="setor" id="setor" class="form-control">
                                            <option value="">Selecione...</option>
                                            <?php foreach ($setores as $item) { ?>
                                                <option value="<?= $item['id_setor'] ?>" <?= $item['id_setor'] == $dados[0]['id_setor'] ? 'selected' : '' ?>>
                                                    <?= $item['nome_setor'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if ($dados[0]['tipo_usuario'] != 1) { ?>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>E-mail</label>
                                        <input name="email" onchange='ValidarEMAIL(this.value, $("#tipo").val())' id="email" class="form-control" placeholder="Digite Aqui..." value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['email_func'] : $dados[0]['email_tec'] ?>">
                                        <label id="lblEmailVal" style="color: red;"></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Telefone</label>
                                        <input name="telefone" id="telefone" class="form-control num tel" placeholder="Digite Aqui..." value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['tel_func'] : $dados[0]['tel_tec'] ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Endereço</label>
                                        <input name="endereco" id="endereco" class="form-control" placeholder="Digite Aqui..." value="<?= $dados[0]['tipo_usuario'] == 2 ? $dados[0]['email_func'] : $dados[0]['email_tec'] ?>">
                                    </div>
                                </div>
                            <?php } ?>

                            <button id="btnSalvar" name="btnSalvar" onclick="return ValidarTela(4)" class="btn btn-success">Gravar</button>

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