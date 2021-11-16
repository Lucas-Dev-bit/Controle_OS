<?php

require_once 'UtilCTRL.php';
require_once UtilCTRL::RetornarCaminho() . 'dao/ChamadoDAO.php';

define('AbrirChamado', 'AbrirChamado');
define('AtenderChamado', 'AtenderChamado');

class ChamadoCTRL
{

    public function FiltrarEquipamentosChamado()
    {

        $dao = new ChamadoDAO();

        return $dao->FiltrarEquipamentosChamado(UtilCTRL::SetorLogado(), 1);
    }

    public function AbrirChamado(ChamadoVO $vo)
    {

        if ($vo->getidEquip() == '' || $vo->getdescCha() == '')
            return 0;


        $vo->setdataCha(UtilCTRL::DataAtual());
        $vo->setidUserFunc(UtilCTRL::CodigoLogado());
        $vo->sethoraCha(UtilCTRL::HoraAtual());

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AbrirChamado);

        $dao = new ChamadoDAO();
        return $dao->AbrirChamado($vo);
    }

    public function DetalharChamado($id)
    {

        $dao = new ChamadoDAO();
        return $dao->DetalharChamado($id);
    }

    public function AtenderChamado(ChamadoVO $vo)
    {
        $vo->setidUserTec(UtilCTRL::CodigoLogado());
        $vo->setdataatenCha(UtilCTRL::DataAtual());
        $vo->sethoraatenCha(UtilCTRL::HoraAtual());

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AtenderChamado);

        $dao = new ChamadoDAO();
        return $dao->AtenderChamado($vo);
    }

    public function FinalizarChamado(ChamadoVO $vo)
    {
        $vo->setidUserTec(UtilCTRL::CodigoLogado());
        $vo->setdataenceCha(UtilCTRL::DataAtual());
        $vo->sethoraenceCha(UtilCTRL::HoraAtual());

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AtenderChamado);

        $dao = new ChamadoDAO();
        return $dao->FinalizarChamado($vo);
    }

    public function FiltrarChamado($situacao, $idSetor){

        $dao = new ChamadoDAO();

        return $dao->FiltrarChamado($idSetor, $situacao, 2);
    }

    public function GerarGraficoInicial(){
        $dao = new ChamadoDAO();
        return $dao->GerarGraficoInicial();
    }
}
