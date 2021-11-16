<?php
require_once '_verificar_tec.php';
require_once '../../Controller/UsuarioCTRL.php';
require_once '../../VO/UsuarioVO.php';

if (isset($_POST['btnGravar'])) {

    $vo = new UsuarioVO();
    $ctrl = new UsuarioCTRL();

    $vo->setSenha($_POST['nsenha']);
    

    $ctrl->AlterarSenha($vo);
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
                            <h1><strong>Mudar Senha</strong> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Técnico</a></li>
                                <li class="breadcrumb-item active">Mudar Senha</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Altere sua senha aqui</h3>
                    </div>

                    <div class="card-body">


                        <div id="passo1">
                            <div class="form-group">
                                <label>Senha Atual</label>
                                <input name="senhaatual" id="senhaatual" type="password" class="form-control" placeholder="Digite Aqui..">
                            </div>

                            <button class="btn btn-success" onclick="VerificarSenhaAtual()">Verificar</button>
                        </div>

                        <div id="passo2" style="display: none;">
                            <form method="POST" action="alterar_senha.php">
                                <div class="form-group">
                                    <label>Nova Senha</label>
                                    <input name="nsenha" id="nsenha" type="password" class="form-control" placeholder="Digite Aqui...">
                                </div>

                                <div class="form-group">
                                    <label>Repetir Senha</label>
                                    <input name="rsenha" id="rsenha" type="password" class="form-control" placeholder="Digite Aqui...">
                                </div>

                                <button name="btnGravar" onclick="return ValidarNovaSenha()" class="btn btn-success">Gravar</button>
                            </form>
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
        require_once '../../Template/_msg.php';
        ?>
</body>

</html>