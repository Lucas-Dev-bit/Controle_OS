<?php

require_once 'UtilCTRL.php';
//require_once UtilCTRL::RetornarCaminho() . 'DAO/TipoEquipDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ControleOS/DAO/TipoEquipDAO.php';


define('CadastrarTipo', 'CadastrarTipo');
define('AlterarTipo', 'AlterarTipo');
define('ExcluirTipo', 'ExcluirTipo');

class TipoEquipamentoCTRL{

    public function CadastrarTipoEquip(TipoEquipamentoVO $vo){

        if($vo->getnomeTipo() == ''){
            return 0;
        }

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(CadastrarTipo);

        $dao = new TipoEquipDao();

        return $dao->CadastrarTipo($vo);

    }

    public function AlterarTipo(TipoEquipamentoVO $vo){

        if($vo->getnomeTipo() == ''){
            return 0;
        }

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AlterarTipo);

        $dao = new TipoEquipDao();
    
        return $dao->AlterarTipo($vo);

    }

    public function ExcluirTipo(TipoEquipamentoVO $vo){

        if($vo->getidTipo() == ''){
            return 0;
        }

          //Preenchimento do sistemaVO para erro
          $vo->setIdUserErro(UtilCTRL::CodigoLogado());
          $vo->setHoraErro(UtilCTRL::HoraAtual());
          $vo->setDataErro(UtilCTRL::DataAtualExibir());
          $vo->setFuncaoErro(ExcluirTipo);

        $dao = new TipoEquipDao();

        return $dao->ExcluirTipo($vo);

    }

    public function ConsultarTipo(){

        $dao = new TipoEquipDao();

        return $dao->ConsultarTipo();
    }

}