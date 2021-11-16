<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/UtilCTRL.php';

if(isset($_GET['close']) && $_GET['close'] == '1')
    UtilCTRL::Deslogar();
    $tipo = UtilCTRL::TipoLogado();
    $nome = UtilCTRL::NomeLogado();

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <!--<img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <center>
            <h3><span class="brand-text font-weight-dark"><?= UtilCTRL::NomeTipoUser($tipo) ?></span></h3>
        </center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            
            <div class="info">
                <a href="#" class="d-block"><?= $nome ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if ($tipo == 1) { ?>
                    
                    <li class="nav-item">
                        <a href="novo_usuario.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Novo Usuário
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="consultar_usuario.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Consultar Usuário
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="equipamento.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Novo Equipamento
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="tipo_equipamento.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Tipo de Equipamento
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="modelo_equipamento.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Modelo de Equipamento
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="alocar_equipamento.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Alocar Equipamento
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="consultar_equipamento.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Consultar Equipamento
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="remover_equipamento.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Remover Equipamento
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="setor.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Setor
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="adm_rel_chamados.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                               Relatório Chamados
                            </p>
                        </a>
                    </li>

                <?php } else if ($tipo == 2) { ?>
                    <!-- MENU FUNCIONÁRIO -->
                    <li class="nav-item">
                        <a href="novo_chamado.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Novo Chamado
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="consultar_chamados.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Consultar Chamados
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="meus_dados.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Meus Dados
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="alterar_senha.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Alterar Senha
                            </p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="meus_chamados.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Meus Chamados
                            </p>
                        </a>
                    </li>
                    -->
                <?php  } else if ($tipo == 3) { ?>
                    <!-- MENU TECNICO -->
                
                    <li class="nav-item">
                        <a href="consultar_chamados.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Consultar Chamado
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="meus_dados.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Meus Dados
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="alterar_senha.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Alterar Senha
                            </p>
                        </a>
                    </li>
                <?php } ?>
                
                <li class="nav-item">
                    <a href=" http://localhost/ControleOS/template/_menu.php?close=1" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Sair
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>