<?php

require_once '../../Controller/UtilCTRL.php';

require_once 'SistemaVO.php';

class ChamadoVO extends SistemaVO
{

    private $idCha;
    private $idAlocarEquip;
    private $dataCha;
    private $horaCha;
    private $descCha;
    private $dataatenCha;
    private $horaatenCha;
    private $dataenceCha;
    private $horaenceCha;
    private $laudoTec;
    private $idUserFunc;
    private $idUserTec;
    private $idEquip;

    public function setidCha($idCha)
    {
        $this->idCha = trim(ltrim($idCha));
    }
    public function getidCha()
    {
        return $this->idCha;
    }
    //-------------------------
    public function setidAlocarEquip($idAlocarEquip)
    {
        $this->idAlocarEquip = trim(ltrim($idAlocarEquip));
    }
    public function getidAlocarEquip()
    {
        return $this->idAlocarEquip;
    }
    //-------------------------
    public function setdataCha($dataCha)
    {
        $this->dataCha = trim(ltrim($dataCha));

    }
    public function getdataCha()
    {
        return $this->dataCha;
    }
    //--------------------------
    public function sethoraCha($horaCha)
    {
        $this->horaCha = trim(ltrim($horaCha));
    }
    public function gethoraCha()
    {
        return $this->horaCha;
    }
    //--------------------------
    public function setdescCha($descCha)
    {
        $this->descCha = UtilCTRL::TirarScriptsMaliciosos(trim(ltrim($descCha)));
    }
    public function getdescCha()
    {
        return $this->descCha;
    }
    //--------------------------
    public function setdataatenCha($dataatenCha)
    {
        $this->dataatenCha = trim(ltrim($dataatenCha));
    }
    public function getdataatenCha()
    {
        return $this->dataatenCha;
    }
    //--------------------------
    public function sethoraatenCha($horaatenCha)
    {
        $this->horaatenCha = trim(ltrim($horaatenCha));
    }
    public function gethoraatenCha()
    {
        return $this->horaatenCha;
    }
    //--------------------------
    public function setdataenceCha($dataenceCha)
    {
        $this->dataenceCha = trim(ltrim($dataenceCha));
    }
    public function getdataenceCha()
    {
        return $this->dataenceCha;
    }
    //---------------------------
    public function sethoraenceCha($horaenceCha)
    {
        $this->horaenceCha = trim(ltrim($horaenceCha));
    }
    public function gethoraenceCha()
    {
        return $this->horaenceCha;
    }
    //--------------------------
    public function setlaudoTec($laudoTec)
    {
        $this->laudoTec = UtilCTRL::TirarScriptsMaliciosos($laudoTec);
    }
    public function getlaudoTec()
    {
        return $this->laudoTec;
    }
    //--------------------------
    public function setidUserFunc($idUserFunc)
    {
        $this->idUserFunc = trim(ltrim($idUserFunc));
    }
    public function getidUserFunc()
    {
        return $this->idUserFunc;
    }
    //--------------------------
    public function setidUserTec($idUserTec)
    {
        $this->idUserTec = trim(ltrim($idUserTec));
    }
    public function getidUserTec()
    {
        return $this->idUserTec;
    }
    //-------------------------
    public function setidEquip($idEquip)
    {
        $this->idEquip = trim(ltrim($idEquip));
    }
    public function getidEquip()
    {
        return $this->idEquip;
    }
}
