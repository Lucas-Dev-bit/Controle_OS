<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/UsuarioCTRL.php';


if (isset($_POST['email_digitado']) && isset($_POST['tipo_escolhido'])) {

    $ctrl = new UsuarioCTRL();

    $ret = $ctrl->VerificarEMAIL($_POST['email_digitado'], $_POST['tipo_escolhido']);

    echo $ret;
}
