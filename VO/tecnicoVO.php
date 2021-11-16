<?php

require_once 'usuarioVO.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/UtilCTRL.php';

class TecnicoVO extends UsuarioVO
{

    private $tel;
    private $endereco;
    private $email;

    public function setTel($tel)
    {
        $this->tel = UtilCTRL::TirarCaracteresEspeciais(trim(ltrim($tel)));
    }
    public function getTel()
    {
        return $this->tel;
    }
    //--------------------
    public function setEndereco($endereco)
    {
        $this->endereco = trim(ltrim($endereco));
    }
    public function getEndereco()
    {
        return $this->endereco;
    }
    //--------------------
    public function setEmail($email)
    {
        $this->email = trim(ltrim($email));
    }
    public function getEmail()
    {
        return $this->email;
    }
}
