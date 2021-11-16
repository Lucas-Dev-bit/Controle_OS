<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/UsuarioCTRL.php';

if (isset($_POST['senha'])) {

    $ctrl = new UsuarioCTRL();
    $ret = $ctrl->VerificarSenhaAtual($_POST['senha']);
    echo $ret == true ? 1 : 0;
}
    