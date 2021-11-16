<?php

require_once 'UtilCTRL.php';
require_once UtilCTRL::RetornarCaminho() . 'DAO/SetorDAO.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/SetorDAO.php';

define('CadastrarSetor', 'CadastrarSetor');
define('ExcluirSetor', 'ExcluirSetor');
define('AlterarSetor', 'AlterarSetor');

class SetorCTRL
{

    public function CadastrarSetor(SetorVO $vo)
    {

        if ($vo->getnomeSetor() == '') {
            return 0;
        }

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(CadastrarSetor);

        $dao = new SetorDAO();

        return $dao->InserirSetor($vo);
    }

    public function AlterarSetor(SetorVO $vo)
    {

        if ($vo->getnomeSetor() == '' || $vo->getidSetor() == '') {
            return 0;
        }

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AlterarSetor);

        $dao = new SetorDAO();

        return $dao->AlterarSetor($vo);
    }


    public function ConsultarSetor()
    {

        $dao = new SetorDAO();

        return $dao->ConsultarSetor();
    }

    public function ExcluirSetor(SetorVO $vo)
    {
        if($vo->getidSetor() == ''){
            return 0;
        }

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(ExcluirSetor);

        $dao = new SetorDAO();

        return $dao->ExcluirSetor($vo);
    }
}
