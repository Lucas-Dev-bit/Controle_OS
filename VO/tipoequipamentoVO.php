<?php

require_once 'SistemaVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/UtilCTRL.php';

class TipoEquipamentoVO extends SistemaVO
{

    private $idTipo;
    private $nomeTipo;

    public function setidTipo($idTipo)
    {
        $this->idTipo = trim(ltrim($idTipo));
    }
    public function getidTipo()
    {
        return $this->idTipo;
    }
    //----------------------------
    public function setnomeTipo($nomeTipo)
    {
        $this->nomeTipo = UtilCTRL::TirarScriptsMaliciosos(trim(ltrim($nomeTipo)));
    }
    public function getnomeTipo()
    {
        return $this->nomeTipo;
    }
}
