<?php

require_once 'Conexao.php';
require_once 'sql/EquipamentoSQL.php';

class EquipamentoDAO extends Conexao{

    /** @var PDO */
    private $conexao;

    /** @var PDOStatement */
    private $sql;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
        $this->sql = new PDOStatement();
    }

    public function FiltrarEquipamento($idTipo){
        
        $this->sql = $this->conexao->prepare(EquipamentoSQL::FILTRAR_EQUIPAMENTO());
        $this->sql->bindValue(1, $idTipo);
        $this->sql->execute();
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function FiltrarEquipamentoNaoAlocados(){
        
        $this->sql = $this->conexao->prepare(EquipamentoSQL::FILTRAR_EQUIPAMENTO_NAO_ALOCADO());
        $this->sql->execute();
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DetalharEquipamento($id){

        $this->sql = $this->conexao->prepare(EquipamentoSQL::DETALHAR_EQUIPAMENTO());
        $this->sql->bindValue(1, $id);
        $this->sql->execute();
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function SelecionarEquipamentosAlocados($idSetor){

        $this->sql = $this->conexao->prepare(EquipamentoSQL::EQUIPAMENTOS_ALOCADOS_SETOR());
        $this->sql->bindValue(1, $idSetor);
        $this->sql->execute();
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function CadastrarEquipamento(EquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(EquipamentoSQL::CADASTRAR_EQUIPAMENTO());
        $i = 1;
        $this->sql->bindValue($i++, $vo->getIdentEquip());
        $this->sql->bindValue($i++, $vo->getDescEquip());
        $this->sql->bindValue($i++, $vo->getidModeloEquip());
        $this->sql->bindValue($i++, $vo->getidTipoEquip());

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

    public function RemoverEquipamentoSetor(AlocarEquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(EquipamentoSQL::REMOVAR_EQUIPAMENTO_SETOR());
        $i = 1;
        $this->sql->bindValue($i++, $vo->getsitAlocar());
        $this->sql->bindValue($i++, $vo->getdataRemover());
        $this->sql->bindValue($i++, $vo->getidAlocar());
        
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

   public function AlocarEquipamento(AlocarEquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(EquipamentoSQL::ALOCAR_EQUIPAMENTO());
    
        $i = 1;
        $this->sql->bindValue($i++, $vo->getsitAlocar());
        $this->sql->bindValue($i++, $vo->getdataAlocar());
        $this->sql->bindValue($i++, $vo->getidSetor());
        $this->sql->bindValue($i++, $vo->getidEquipamento());

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

    public function AlterarEquipamento(EquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(EquipamentoSQL::ALTERAR_EQUIPAMENTO());
        $i = 1;
        $this->sql->bindValue($i++, $vo->getIdentEquip());
        $this->sql->bindValue($i++, $vo->getDescEquip());
        $this->sql->bindValue($i++, $vo->getidModeloEquip());
        $this->sql->bindValue($i++, $vo->getidTipoEquip());
        $this->sql->bindValue($i++, $vo->getidEquip());
        

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

    public function ExcluirEquipamento(EquipamentoVO $vo){

        $this->sql = $this->conexao->prepare(EquipamentoSQL::EXCLUIR_EQUIPAMENTO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getidEquip());

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