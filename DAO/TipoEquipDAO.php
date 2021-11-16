<?php

require_once 'sql/TipoEquipSQL.php';
require_once 'Conexao.php';

class TipoEquipDao extends Conexao{

    /** @var PDO */
    private $conexao;

    /** @var  PDOStatement */
    private $sql;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
        $this->sql = new PDOStatement();
    }


    public function CadastrarTipo(TipoEquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(TipoEquipSQL::INSERIR_TIPO());

        $this->sql->bindValue(1, $vo->getnomeTipo());

        try {

            $this->sql->execute();
            return 1;
        }
        catch (Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }
    }

    public function AlterarTipo(TipoEquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(TipoEquipSQL::ALTERAR_TIPO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getnomeTipo());
        $this->sql->bindValue($i++, $vo->getidTipo());

        try{
            $this->sql->execute();
            return 1;
        }catch (Exception $ex){
            $vo->getMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }

    }

    public function ConsultarTipo(){

        $this->sql = $this->conexao->prepare(TipoEquipSQL::CONSULTAR_TIPO());

        $this->sql->execute();

        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ExcluirTipo(TipoEquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(TipoEquipSQL::EXCLUIR_TIPO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getidTipo());

        try{
            $this->sql->execute();
            return 1;
        }catch (Exception $ex){
            $vo->getMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -2;
        }
    }
}