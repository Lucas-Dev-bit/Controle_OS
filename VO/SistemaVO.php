<?php

class SistemaVO{


    private $idUserLogado;
    private $DataErro;
    private $HoraErro;
    private $funcaoErro;
    private $MsgErro;

    public function setIdUserErro($id){
        $this->idUserLogado = $id;
    }
    public function getIdUserErro(){
        return $this->idUserLogado;
    }
    //-------------------------------
    public function setDataErro($data){
        $this->DataErro = $data;
    }
    public function getDataErro(){
        return $this->DataErro;
    }
    //---------------------------------
    public function setHoraErro($HoraErro){
        $this->HoraErro = $HoraErro;
    }
    public function getHoraErro(){
        return $this->HoraErro;
    }
    //---------------------------------
    public function setFuncaoErro($funcaoErro){
        $this->funcaoErro = $funcaoErro;
    }
    public function getFuncaoErro(){
        return $this->funcaoErro;
    }
    //----------------------------------
    public function setMsgErro($MsgErro){
        $this->MsgErro = $MsgErro;
    }
    public function getMsgErro(){
        return $this->MsgErro;
    }












}