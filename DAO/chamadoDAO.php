<?php

require_once 'Conexao.php';
require_once 'sql/chamadoSQL.php';

class ChamadoDAO extends Conexao{

    /** @var PDO */
    private $conexao;

    /** @var PDOStatement */
    private $sql;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
        $this->sql = new PDOStatement();
    } 

    public function GerarGraficoInicial(){

        $this->sql = $this->conexao->prepare(ChamadoSQL::GRAFICO_INICIAL());
        $this->sql->execute();
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function FiltrarEquipamentosChamado($idSetor, $sit){

        $this->sql = $this->conexao->prepare(ChamadoSQL::CARREGAR_EQUIPAMENTO_CHAMADO());
        $this->sql->bindValue(1, $idSetor);
        $this->sql->bindValue(2, $sit);
        $this->sql->execute();
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DetalharChamado($id){

        $this->sql = $this->conexao->prepare(ChamadoSQL::DETALHAR_CHAMADO());
        $this->sql->bindValue(1, $id);
        $this->sql->execute();
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function AbrirChamado(ChamadoVO $vo){

        $this->sql = $this->conexao->prepare(ChamadoSQL::ABRIR_CHAMADO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getdataCha());
        $this->sql->bindValue($i++, $vo->gethoraCha());
        $this->sql->bindValue($i++, $vo->getdescCha());
        $this->sql->bindValue($i++, $vo->getidEquip());
        $this->sql->bindValue($i++, $vo->getidUserFunc());

        $this->conexao->beginTransaction();

        try{
            $this->sql->execute();

            $this->sql = $this->conexao->prepare(ChamadoSQL::ATUALIZAR_SITUACAO());
            $i = 1;
            $this->sql->bindValue($i++, 3);
            $this->sql->bindValue($i++, $vo->getidAlocarEquip());

            $this->sql->execute();
            $this->conexao->commit();
            return 1;
            
        }catch(Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            $this->conexao->rollBack();
            return -1;
        }
    }

    public function AtenderChamado(ChamadoVO $vo){

        $this->sql = $this->conexao->prepare(ChamadoSQL::ATENDER_CHAMADO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getdataatenCha());
        $this->sql->bindValue($i++, $vo->gethoraatenCha());
        $this->sql->bindValue($i++, $vo->getidUserTec());
        $this->sql->bindValue($i++, $vo->getidCha());
        
        try{

            $this->sql->execute();
            return 1;
        }
        catch(Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }

    }

    public function FinalizarChamado(ChamadoVO $vo){

        $this->sql = $this->conexao->prepare(ChamadoSQL::FINALIZAR_CHAMADO());
        $i = 1;

        $this->sql->bindValue($i++, $vo->getdataenceCha());
        $this->sql->bindValue($i++, $vo->gethoraenceCha());
        $this->sql->bindValue($i++, $vo->getidUserTec());
        $this->sql->bindValue($i++, $vo->getlaudoTec());
        $this->sql->bindValue($i++, $vo->getidCha());

        $this->conexao->beginTransaction();

        try{
            $this->sql->execute();

            $this->sql = $this->conexao->prepare(ChamadoSQL::ATUALIZAR_SITUACAO());

            $i = 1;
            $this->sql->bindValue($i++, 1); // Alocado
            $this->sql->bindValue($i++, $vo->getidAlocarEquip());
            $this->sql->execute();

            $this->conexao->commit();

            return 1;

        }catch(Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            $this->conexao->rollBack();
            return -1;
        }
    }

    public function FiltrarChamado($idSetor, $situacao, $alocar){

        $this->sql = $this->conexao->prepare(ChamadoSQL::FILTRAR_CHAMADO($situacao, $idSetor));

        $this->sql->bindValue(1, $alocar);

        if($idSetor != ''){
            $this->sql->bindValue(2, $idSetor);
        }
        
        $this->sql->execute();

        return $this->sql->fetchAll(PDO::FETCH_ASSOC);

    }
}