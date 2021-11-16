<?php

require_once 'SistemaVO.php';


class AlocarEquipamentoVO extends SistemaVO
{

    private $idAlocar;
    private $sitAlocar;
    private $dataAlocar;
    private $dataRemover;
    private $idSetor;
    private $idEquipamento;

    public function setidAlocar($idAlocar)
    {
        $this->idAlocar = trim(ltrim($idAlocar));
    }
    public function getidAlocar()
    {
        return $this->idAlocar;
    }
    //---------------------------
    public function setsitAlocar($sitAlocar){
        $this->sitAlocar = trim(ltrim($sitAlocar));
    }
    public function getsitAlocar(){
        return $this->sitAlocar;
    }
    //----------------------------
    public function setdataAlocar($dataAlocar)
    {
        $this->dataAlocar = trim(ltrim($dataAlocar));
    }
    public function getdataAlocar()
    {
        return $this->dataAlocar;
    }
    //---------------------------
    public function setdataRemover($dataRemover)
    {
        $this->dataRemover = trim(ltrim($dataRemover));
    }
    public function getdataRemover()
    {
        return $this->dataRemover;
    }
    //---------------------------
    public function setidSetor($idSetor)
    {
        $this->idSetor = $idSetor;
    }
    public function getidSetor()
    {
        return $this->idSetor;
    }
    //---------------------------
    public function setidEquipamento($idEquipamento)
    {
        $this->idEquipamento = $idEquipamento;
    }
    public function getidEquipamento()
    {
        return $this->idEquipamento;
    }
}
