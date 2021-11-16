<?php
require_once '_verificar_adm.php';
require_once '../../Controller/UtilCTRL.php';
require_once '../../Controller/UsuarioCTRL.php';
require_once '../../VO/usuarioVO.php';

//$ctrl = new UsuarioCTRL();
$tipo_tela = 'CONSULTAR_USUARIO';
$tipo_pesq = '';
$nome_pesq = '';

if (isset($_POST['btnBuscar'])) {

    $tipo_pesq = $_POST['tipo'];
    $nome_pesq = $_POST['nome_pesq'];

    $ctrl = new UsuarioCTRL();
    $users = $ctrl->FiltrarUsuario($nome_pesq, $tipo_pesq);

    if (count($users) == 0) {
        $ret = 2;
    }
    //$vo = new UsuarioVO();
    //$vo->setNome($_POST['nome']);
    //$ret = $ctrl->CadastrarUserAdm($vo);
    }else if(isset($_POST['btnExcluir'])){
        $dados = explode('-', $_POST['id_excluir']);

        $id = $dados[0];
        $tipo = $dados[1];

        $vo = new UsuarioVO();

        $vo->setIdUser($id);
        $vo->setTipo($tipo);

        $ctrl = new UsuarioCTRL();

        $ret = $ctrl->ExcluirUsuario($vo);
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
                            <h1><strong>Consultar Usuário</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Consultar Usuário</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Consulte Todos os Usuários Aqui</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="consultar_usuario.php">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Pesquisar pelo Tipo</label>
                                    <?php include_once '../../Template/combos/_combo_tipouser.php' ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pesquisar pelo Nome</label>
                                    <input class="form-control" name="nome_pesq" id="nome_pesq" value="<?= $nome_pesq ?>">
                                </div>
                            </div>
                            <button name="btnBuscar" onclick="return ValidarTela(1)" class="btn btn-info">Buscar</button>
                        </form>
                    </div>
                </div>

                <?php if (isset($users) && count($users) > 0) { ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Usuários Cadastrados</h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Tipo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $item) { ?>
                                                <tr>
                                                    <td><?= $item['nome_usuario'] ?></td>
                                                    <td><?= UtilCTRL::NomeTipoUser($item['tipo_usuario']) ?></td>
                                                    <td>
                                                        <a href="alterar_usuario.php?tipo=<?= $item['tipo_usuario'] ?>&cod=<?= $item['id_usuario'] ?>" name="btnAlterar" id="btnAlterar" class="btn btn-warning btn-xs">Alterar</a>
                                                        <a href="#" name="btnExcluir" id="btnExcluir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarDadosExcluir('<?= $item['id_usuario'] .'-'. $item['tipo_usuario']?>', '<?= $item['nome_usuario']?>')">Excluir</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <form method="POST" action="consultar_usuario.php">
                                        <?php
                                        include_once 'modal/_modal_excluir.php';
                                        ?>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

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