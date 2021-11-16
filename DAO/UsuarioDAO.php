<?php

require_once 'sql/UsuarioSQL.php';
require_once 'Conexao.php';

class UsuarioDao extends Conexao
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

    public function CadastrarUsuarioADM(UsuarioVO $vo)
    {

        $this->sql = $this->conexao->prepare(UsuarioSQL::INSERIR_USUARIO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCpf());
        $this->sql->bindValue($i++, $vo->getSenha());
        $this->sql->bindValue($i++, $vo->getTipo());
        $this->sql->bindValue($i++, $vo->getStatus());

        try {
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }
    }

    public function CadastrarUserFunc(FuncionarioVO $vo){

        $this->sql = $this->conexao->prepare(UsuarioSQL::INSERIR_USUARIO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCpf());
        $this->sql->bindValue($i++, $vo->getSenha());
        $this->sql->bindValue($i++, $vo->getTipo());
        $this->sql->bindValue($i++, $vo->getStatus());

        $this->conexao->beginTransaction();

        try{
            //inserir na tb_usuario
            $this->sql->execute();
            $id_user = $this->conexao->lastInsertId();

            $this->sql = $this->conexao->prepare(UsuarioSQL::INSERIR_FUNCIONARIO());
            $i = 1;
            $this->sql->bindValue($i++, $id_user);
            $this->sql->bindValue($i++, $vo->getTel());
            $this->sql->bindValue($i++, $vo->getEndereco());
            $this->sql->bindValue($i++, $vo->getEmail());
            $this->sql->bindValue($i++, $vo->getidSetor());

            //insere na tabela TECNICO
            $this->sql->execute();

            $this->conexao->commit();

            return 1;

        }catch (Exception $ex){
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }
    }


    public function CadastrarUserTec(TecnicoVO $vo){

        $this->sql = $this->conexao->prepare(UsuarioSQL::INSERIR_USUARIO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCpf());
        $this->sql->bindValue($i++, $vo->getSenha());
        $this->sql->bindValue($i++, $vo->getTipo());
        $this->sql->bindValue($i++, $vo->getStatus());

        $this->conexao->beginTransaction();

        try {
            //insete na tabela usuario
            $this->sql->execute();

            //recupera o ID do recem cadastrado usuario
            $id_user = $this->conexao->lastInsertId();

            $this->sql = $this->conexao->prepare(UsuarioSQL::INSERIR_TECNICO());
            $i = 1;
            $this->sql->bindValue($i++, $id_user);
            $this->sql->bindValue($i++, $vo->getTel());
            $this->sql->bindValue($i++, $vo->getEndereco());
            $this->sql->bindValue($i++, $vo->getEmail());

            $this->sql->execute();
            
            $this->conexao->commit();
            return 1;
        } catch (Exception $ex) {
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }
    }

    public function AlterarUsuarioAdm(UsuarioVO $vo){

        $this->sql = $this->conexao->prepare(UsuarioSQL::ALTERAR_USUARIO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCpf());
        $this->sql->bindValue($i++, $vo->getIdUser());
        

        try {
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }

    }

    public function AlterarUsuarioFunc(FuncionarioVO $vo){

        $this->sql = $this->conexao->prepare(UsuarioSQL::ALTERAR_USUARIO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCpf());
        $this->sql->bindValue($i++, $vo->getIdUser());
        
        $this->conexao->beginTransaction();

        try{
            //atualizar na tb_usuario
            $this->sql->execute();
            

            $this->sql = $this->conexao->prepare(UsuarioSQL::ALTERAR_FUNCIONARIO());
            $i = 1;
            
            $this->sql->bindValue($i++, $vo->getTel());
            $this->sql->bindValue($i++, $vo->getEndereco());
            $this->sql->bindValue($i++, $vo->getEmail());
            $this->sql->bindValue($i++, $vo->getidSetor());
            $this->sql->bindValue($i++, $vo->getIdUser());

            //atualiza na tabela FUNCIONARIO
            $this->sql->execute();

            $this->conexao->commit();

            return 1;

        }catch (Exception $ex){
            $this->conexao->rollBack();
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }
    }

    public function AlterarUsuarioTec(TecnicoVO $vo){

        $this->sql = $this->conexao->prepare(UsuarioSQL::ALTERAR_USUARIO());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCpf());
        $this->sql->bindValue($i++, $vo->getIdUser());
        
        $this->conexao->beginTransaction();

        try{
            //atualizar na tb_usuario
            $this->sql->execute();
            
            $this->sql = $this->conexao->prepare(UsuarioSQL::ALTERAR_TECNICO());
            $i = 1;
            
            $this->sql->bindValue($i++, $vo->getTel());
            $this->sql->bindValue($i++, $vo->getEndereco());
            $this->sql->bindValue($i++, $vo->getEmail());
            $this->sql->bindValue($i++, $vo->getIdUser());

            //atualiza na tabela TECNICO
            $this->sql->execute();

            $this->conexao->commit();

            return 1;

        }catch (Exception $ex){
            $this->conexao->rollBack();
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }
    }

    public function ConsultarCPF($cpf, $id)
    {

        $this->sql = $this->conexao->prepare(UsuarioSQL::CONSULTAR_CPF($id));

        $this->sql->bindValue(1, $cpf);

        if($id != ''){
        $this->sql->bindvalue(2, $id);
        }

        $this->sql->execute();

        $ret = $this->sql->fetchAll(PDO::FETCH_ASSOC);

        return $ret[0]['contar'];
       
    }

    public function FiltrarUsuario($nome, $tipo){

        $this->sql = $this->conexao->prepare(UsuarioSQL::FILTRAR_USUARIO($tipo, $nome));
        
        if($tipo == 0 && $nome != ''){

            $this->sql->bindValue(1, '%'.$nome.'%');

        }else if($tipo != 0 && $nome == ''){

            $this->sql->bindValue(1, $tipo);
            
        }else if($tipo != 0 && $nome != ''){

            $this->sql->bindValue(1, $tipo);
            $this->sql->bindValue(2, '%'.$nome.'%');
        }

        $this->sql->execute();

        return $this->sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function ConsultarEMAIL($email, $tipo){

        $this->sql = $this->conexao->prepare(UsuarioSQL::CONSULTAR_EMAIL($tipo));

        $this->sql->bindValue(1, $email);

        $this->sql->execute();

        $ret = $this->sql->fetchAll(PDO::FETCH_ASSOC);

        return $ret[0]['contar'];
    }

    public function VerificarSenhaAtual($idUser){

        $this->sql = $this->conexao->prepare(UsuarioSQL::VALIDAR_SENHA_ATUAL());
        $this->sql->bindValue(1, $idUser);
        $this->sql->execute();
        $ret = $this->sql->fetchAll(PDO::FETCH_ASSOC);

        return $ret[0]['senha_usuario'];
        
    }

    public function DetalharUsuario($idUser){

        $this->sql = $this->conexao->prepare(UsuarioSQL::DETALHAR_USUARIO());

        $this->sql->bindValue(1, $idUser);

        $this->sql->execute();

        return $this->sql->fetchAll(PDO::FETCH_ASSOC);

        
    }

    public function ValidarLogin($login){

        $this->sql = $this->conexao->prepare(UsuarioSQL::VALIDAR_LOGIN());

        $this->sql->bindValue(1, $login);

        $this->sql->execute();

        return $this->sql->fetchAll(PDO::FETCH_ASSOC);

        
    }

    public function ExcluirUsuario(UsuarioVO $vo){

        //É ADM portanto não precisa de transação pois é uma table envolvida
        if($vo->getTipo() == 1){
            $this->sql = $this->conexao->prepare(UsuarioSQL::EXCLUIR_USUARIO());
            $this->sql->bindValue(1, $vo->getIdUser());
            try{
                $this->sql->execute();
                return 1;
            }catch(Exception $ex){
                $vo->setMsgErro($ex->getMessage());
                parent::GravarErro($vo);
                return -1;
            }
        }else{
            $this->conexao->beginTransaction(); // usamos quando precisa buscar informação em duas tabelas diferentes

            $this->sql = $this->conexao->prepare( $vo->getTipo() == 2 ? UsuarioSQL::EXCLUIR_FUNCIONARIO() : UsuarioSQL::EXCLUIR_TECNICO());
    
            $this->sql->bindValue(1, $vo->getIdUser());

            try{
                //Excluiu na table filha
                $this->sql->execute();

                $this->sql = $this->conexao->prepare(UsuarioSQL::EXCLUIR_USUARIO());
                $this->sql->bindValue(1, $vo->getIdUser());

                //Exclui na tb_usuario
                $this->sql->execute();

                $this->conexao->commit();
                return 1;
            }catch(Exception $ex){
                $this->conexao->rollBack();
                $vo->setMsgErro($ex->getMessage());
                parent::GravarErro($vo);
                return -1;
            }
        }
    }

    public function AlterarSenha(UsuarioVO $vo){

        $this->sql = $this->conexao->prepare(UsuarioSQL::ALTERAR_SENHA());

        $i = 1;
        $this->sql->bindValue($i++, $vo->getSenha());
        $this->sql->bindValue($i++, $vo->getIdUser());
        
        try {
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErro($vo);
            return -1;
        }

    }

}
