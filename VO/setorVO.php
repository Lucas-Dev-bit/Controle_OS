<?php

require_once 'SistemaVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/UtilCTRL.php';

class SetorVO extends SistemaVO
{

    private $idSetor;
    private $nomeSetor;

    public function setidSetor($idSetor)
    {
        $this->idSetor = trim(ltrim($idSetor));
    }
    public function getidSetor()
    {
        return $this->idSetor;
    }
    //--------------------
    public function setnomeSetor($nomeSetor)
    {
        $this->nomeSetor = UtilCTRL::TirarScriptsMaliciosos(trim(ltrim($nomeSetor)));
    }
    public function getnomeSetor()
    {
        return $this->nomeSetor;
    }
}
