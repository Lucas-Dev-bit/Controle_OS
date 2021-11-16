<?php

require_once 'Conexao.php';
require_once 'sql/SetorSQL.php';

class SetorDAO extends Conexao{

    /** @var PDO */
    private $conexao;

    /** @var PDOStatment */
    private $sql;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
        $this->sql = new PDOStatement();
    }

    public function InserirSetor(SetorVO $vo){

        $this->sql = $this->conexao->prepare(SetorSQL::INSERIR_SETOR());

        $this->sql->bindValue(1, $vo->getnomeSetor());

        try{
            $this->sql->execute();
            return 1;
        }
        catch (Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }

    }

    public function AlterarSetor(SetorVO $vo){

        $this->sql =$this->conexao->prepare(SetorSQL::ALTERAR_SETOR());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getnomeSetor());
        $this->sql->bindValue($i++, $vo->getidSetor());

        try{
            $this->sql->execute();
            return 1;
        }
        catch (Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }



    }

    public function ConsultarSetor(){

        $this->sql = $this->conexao->prepare(SetorSQL::CONSULTAR_SETOR());

        $this->sql->execute();

        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function ExcluirSetor(SetorVO $vo){

        $this->sql = $this->conexao->prepare(SetorSQL::EXCLUIR_SETOR($vo));

        $i = 1;
        $this->sql->bindValue($i++, $vo->getidSetor());
        
        try{
            $this->sql->execute();
            return 1;
        }catch(Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -2;
        }
    }
}