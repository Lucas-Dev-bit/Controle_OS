<?php

require_once 'UtilCTRL.php';
//require_once UtilCTRL::RetornarCaminho() . 'DAO/EquipamentoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/EquipamentoDAO.php';

define('CadastrarEquipamento', 'CadastrarEquipamento');
define('ExcluirEquipamento', 'ExcluirEquipamento');
define('AlocarEquipamento', 'AlocarEquipamento');
define('RemoverEquipamentoSetor', 'RemoverEquipamentoSetor');

class EquipamentoCRTL
{

    public function GravarEquipamento(EquipamentoVO $vo)
    {

        if ($vo->getidTipoEquip() == '' || $vo->getidModeloEquip() == '' || $vo->getIdentEquip() == '' || $vo->getDescEquip() == '')
            return 0;


        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(CadastrarEquipamento);

        $dao = new EquipamentoDAO();

        return $vo->getidEquip() != '' ? $dao->AlterarEquipamento($vo) : $dao->CadastrarEquipamento($vo);
    }

    public function FiltrarEquipamento($idTipo)
    {

        $dao = new EquipamentoDAO();
        return $dao->FiltrarEquipamento($idTipo);
    }

    public function DetalharEquipamento($id)
    {

        $dao = new EquipamentoDAO();
        return $dao->DetalharEquipamento($id);
    }

    public function SelecionarEquipamentosAlocados($idSetor){

        $dao = new EquipamentoDAO();
        return $dao->SelecionarEquipamentosAlocados($idSetor);
    }

    public function ConsultarEquipamento(EquipamentoVO $vo)
    {

        if ($vo->getidTipoEquip() == '') {
            return 0;
        }
    }

    public function FiltrarEquipamentoNaoAlocados()
    {

        $dao = new EquipamentoDAO();
        return $dao->FiltrarEquipamentoNaoAlocados();
    }

    public function RemoverEquipamento(EquipamentoVO $vo)
    {

        if ($vo->getidTipoEquip() == '') {
            return 0;
        }
    }

    public function ExcluirEquipamento(EquipamentoVO $vo)
    {

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(ExcluirEquipamento);

        $dao = new EquipamentoDAO();

        return $dao->ExcluirEquipamento($vo);
    }

    public function AlocarEquipamento(AlocarEquipamentoVO $vo)
    {
        if($vo->getidEquipamento() == '' || $vo->getidSetor() == '')
        return 0;

        $vo->setdataAlocar(UtilCTRL::DataAtual());
        $vo->setsitAlocar(1); //Alocar

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AlocarEquipamento);

        $dao = new EquipamentoDAO();

        return $dao->AlocarEquipamento($vo);
    }

    public function RemoverEquipamentoSetor(AlocarEquipamentoVO $vo){

        $vo->setdataRemover(UtilCTRL::DataAtual());
        $vo->setsitAlocar(2);

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(RemoverEquipamentoSetor);

        $dao = new EquipamentoDAO();

        return $dao->RemoverEquipamentoSetor($vo);
    }
}
