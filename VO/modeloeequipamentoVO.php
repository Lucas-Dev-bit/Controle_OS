<?php

require_once 'SistemaVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/Controller/UtilCTRL.php';

class ModeloEquipamentoVO extends SistemaVO
{

    private $idModelo;
    private $nomeModelo;

    public function setidModelo($idModelo)
    {
        $this->idModelo = trim(ltrim($idModelo));
    }
    public function getidModelo()
    {
        return $this->idModelo;
    }
    //-----------------------------
    public function setnomeModelo($nomeModelo)
    {
        $this->nomeModelo = UtilCTRL::TirarScriptsMaliciosos(trim(ltrim($nomeModelo)));
    }
    public function getnomeModelo()
    {
        return $this->nomeModelo;
    }
}
