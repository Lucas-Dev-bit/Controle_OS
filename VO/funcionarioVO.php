<?php

require_once 'usuarioVO.php';

class FuncionarioVO extends UsuarioVO
{

    private $tel;
    private $endereco;
    private $email;
    private $idSetor;

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
        $this->email = UtilCTRL::TirarCaracteresEspeciais(trim(ltrim($email)));
    }
    public function getEmail()
    {
        return $this->email;
    }
    //--------------------
    public function setidSetor($idSetor)
    {
        $this->idSetor = trim(ltrim($idSetor));
    }
    public function getidSetor()
    {
        return $this->idSetor;
    }
}
