<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/UsuarioCTRL.php';


if (isset($_POST['cpf'])){

    $id = $_POST['id_user'] == 0 ? '' : $_POST['id_user'];

    $ctrl = new UsuarioCTRL();
    $ret = $ctrl->VerificarCPF($_POST['cpf'], $id);

    echo $ret;
} //else (isset($_POST['email'])){

//     $ctrl = new UsuarioCTRL();

//     $ret = $ctrl->VerificarEMAIL($_POST['email']);

//     echo $ret;
// }
