<?php

require_once 'sql/ModeloSQL.php';
require_once 'Conexao.php';

class ModeloDAO extends Conexao
{

    /** @var PDO */
    private $conexao;

    /** @var  PDOStatement */
    private $sql;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
        $this->sql = new PDOStatement();
    }

    public function InserirModelo(ModeloEquipamentoVO $vo)
    {

        $this->sql = $this->conexao->prepare(ModeloSQL::INSERIR_MODELO());

        $this->sql->bindValue(1, $vo->getnomeModelo());

        try {
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }
    }

    public function AlterarModelo(ModeloEquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(ModeloSQL::ALTERAR_MODELO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getnomeModelo());
        $this->sql->bindValue($i++, $vo->getidModelo());

        try{
            $this->sql->execute();
            return 1;
        }catch(Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }

    }

    public function ExcluirModelo(ModeloEquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(ModeloSQL::EXCLUIR_MODELO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getidModelo());

        try{
            $this->sql->execute();
            return 1;
        }catch(Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -2;
        }
    }

    public function ConsultarModelo()
    {

        $this->sql = $this->conexao->prepare(ModeloSQL::CONSULTAR_MODELO());

        $this->sql->execute();

        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
