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
                            <h1><strong>Gerenciar Tipo Equipamento</strong></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                                <li class="breadcrumb-item active">Gerenciar Tipo Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você gerencia todos os tipos de equipamentos cadastrados</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">

                            <label>Nome do Tipo</label>
                            <input name="tipo" id="tipo" class="form-control" placeholder="Digite Aqui">
                        </div>
                        <button name="btnBuscar" class="btn btn-info">Buscar</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tipos de Equipamentos</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>(Nome)</td>
                                            <td>
                                                <a href="#" name="btnAlterar" id="btnAlterar" class="btn btn-warning btn-xs">Alterar</a>
                                                <a href="#" name="btnExcluir" id="btnExcluir" class="btn btn-danger btn-xs">Excluir</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
        ?>
</body>

</html>