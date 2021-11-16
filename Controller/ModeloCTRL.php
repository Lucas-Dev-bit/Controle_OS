<?php


require_once 'UtilCTRL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/ModeloDAO.php';
//require_once UtilCTRL::RetornarCaminho() . 'DAO/ModeloDAO.php';

define('CadastrarModelo', 'CadastrarModelo');
define('ExcluirModelo', 'ExcluirModelo');
define('AlterarModelo', 'AlterarModelo');

class ModeloEquipCTRL
{

    public function CadastrarModelo(ModeloEquipamentoVO $vo)
    {

        if ($vo->getnomeModelo() == '') {
            return 0;
        }

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(CadastrarModelo);

        $dao = new ModeloDAO();

        return $dao->InserirModelo($vo);
    }

    public function AlterarModelo(ModeloEquipamentoVO $vo)
    {

        if ($vo->getnomeModelo() == '' )
            return 0;

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AlterarModelo);

        $dao = new ModeloDAO();

        return $dao->AlterarModelo($vo);
        
    }

    public function ExcluirModelo(ModeloEquipamentoVO $vo){

        if($vo->getidModelo() == ''){
            return 0;
        }

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(ExcluirModelo);

        $dao = new ModeloDAO();

        return $dao->ExcluirModelo($vo);

    }


    public function ConsultarModelo()
    {
        $dao = new ModeloDAO();

        return $dao->ConsultarModelo();
    }

}
    
