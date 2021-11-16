<?php

require_once 'SistemaVO.php';

class EquipamentoVO extends SistemaVO{

    private $idEquip;
    private $idtipoEquip;
    private $idmodeloEquip;
    private $identEquip;
    private $descEquip;

    public function setidEquip($idEquip){
        $this->idEquip = $idEquip;
    }
    public function getidEquip(){
        return $this->idEquip;
    }
    //------------------------
    public function setidTipoEquip($idtipoEquip){
        $this->idtipoEquip = $idtipoEquip;
    }   
    public function getidTipoEquip(){
        return $this->idtipoEquip;
    } 
    //-----------------------
    public function setidModeloEquip($idmodeloEquip){
        $this->idmodeloEquip = $idmodeloEquip;
    }
    public function getidModeloEquip(){
        return $this->idmodeloEquip;
    }
    //------------------------
    public function setIdentEquip($identEquip){
        $this->identEquip = trim(ltrim($identEquip));
    }
    public function getIdentEquip(){
        return $this->identEquip;
    }
    //------------------------
     public function setDescEquip($descEquip){
         $this->descEquip = trim(ltrim($descEquip));
     }
     public function getDescEquip(){
         return $this->descEquip;
     }
}