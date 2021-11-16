<?php 

require_once 'UtilCTRL.php';
require_once UtilCTRL::RetornarCaminho().'dao/UsuarioDAO.php';

define('CadastrarUserAdm', 'CadastrarUserAdm');
define('ExcluirUserAdm', 'ExcluirUserAdm');
define('ExcluirUserTec', 'ExcluirUserTec');
define('ExcluirUserFun', 'ExcluirUserFun');
define('AlterarUserAdm', 'AlterarUserAdm');
define('AlterarUserFun', 'AlterarUserFun');
define('AlterarUserTec', 'AlterarUserTec');
define('AlterarSenha', 'AlterarSenha');

class UsuarioCTRL {

    public function AlterarUsuarioAdm(UsuarioVO $vo){

        if($vo->getNome() == '' || $vo->getCpf() == ''){
            return 0;
        }

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AlterarUserAdm);

        $dao = new UsuarioDao();
        return $dao->AlterarUsuarioAdm($vo);

    }

    public function AlterarUsuarioFunc(FuncionarioVO $vo){

        if($vo->getNome() =='' || $vo->getCpf() == '' || $vo->getEndereco() == '' ||
        $vo->getTel() == '' || $vo->getEmail() == '' || $vo->getidSetor() == '')
        return 0;

        //Preenchimento do sistemaVO para erro
         $vo->setIdUserErro(UtilCTRL::CodigoLogado());
         $vo->setHoraErro(UtilCTRL::HoraAtual());
         $vo->setDataErro(UtilCTRL::DataAtualExibir());
         $vo->setFuncaoErro(AlterarUserFun);

         $dao = new UsuarioDao();
         return $dao->AlterarUsuarioFunc($vo);

    }

    public function VerificarSenhaAtual($senhaDigitada){

        $dao = new UsuarioDao();
        $senha_hash = $dao->VerificarSenhaAtual(UtilCTRL::CodigoLogado());

        return password_verify($senhaDigitada, $senha_hash);
       
    }

    public function AlterarUsuarioTec(TecnicoVO $vo){

        if($vo->getNome() == '' || $vo->getCpf() == '' || $vo->getEndereco() == '' ||
        $vo->getTel() == '' || $vo->getEmail() == '')
        return 0;

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AlterarUserTec);

        $dao = new UsuarioDao();
        return $dao->AlterarUsuarioTec($vo);


    }

    public function ValidarLogin($senha, $login){

        if(trim(ltrim($login)) == '' || trim(ltrim($senha) == '')){
            return 0;
        }
        
        $dao = new UsuarioDao();

        $user = $dao->ValidarLogin(UtilCTRL::TirarCaracteresEspeciais($login));

        if(count($user) == 0){

        }else if(password_verify($senha, $user[0]['senha_usuario'])){

            UtilCTRL::CriarSessao(
                $user[0]['id_usuario'],
                $user[0]['tipo_usuario'],
                $user[0]['nome_usuario'],
                $user[0]['id_setor']
            );

            switch($user[0]['tipo_usuario']){

                case 1: //ADM
                    header('location: http://localhost/ControleOS/Acesso/admin/novo_usuario.php');
                    break;
                
                case 2: //FUNC
                    header('location: http://localhost/ControleOS/acesso/funcionario/meus_dados.php');
                    break;
                
                case 3: //TEC
                    header('location: http://localhost/ControleOS/acesso/tecnico/meus_dados.php');
                    break;
            }

        }else{
            return 4;
        }


   }

    public function ExcluirUsuario(UsuarioVO $vo){

         //Preenchimento do sistemaVO para erro
         $vo->setIdUserErro(UtilCTRL::CodigoLogado());
         $vo->setHoraErro(UtilCTRL::HoraAtual());
         $vo->setDataErro(UtilCTRL::DataAtualExibir());
         $vo->setFuncaoErro( $vo->getTipo() == 1 ? ExcluirUserAdm : ($vo->getTipo() == 2 ? ExcluirUserFun : ExcluirUserTec));

         $dao = new UsuarioDao();

         return $dao->ExcluirUsuario($vo);


    }

    public function DetalharUsuario($idUser){

        $dao = new UsuarioDao();
        return $dao->DetalharUsuario($idUser); 

    }

    public function CadastrarUserAdm(UsuarioVO $vo){

        if($vo->getTipo() == '' || $vo->getNome() == '' || $vo->getCpf() == '') 
            return 0;
        
            $vo->setSenha(UtilCTRL::CriptografarSenha($vo->getCpf()));
            $vo->setStatus(1);

        //Preenchimento do sistemaVO para erro
          $vo->setIdUserErro(UtilCTRL::CodigoLogado());
          $vo->setHoraErro(UtilCTRL::HoraAtual());
          $vo->setDataErro(UtilCTRL::DataAtualExibir());
          $vo->setFuncaoErro(CadastrarUserAdm);

          $dao = new UsuarioDao();

          return $dao->CadastrarUsuarioADM($vo);
    }

    public function VerificarCPF($cpf, $id){

        $dao = new UsuarioDao();

        return $dao->ConsultarCPF(UtilCTRL::TirarCaracteresEspeciais($cpf), $id);

    }

    public function VerificarEMAIL($email, $tipo){

        $dao = new UsuarioDao();

        return $dao->ConsultarEMAIL($email, $tipo);

    }

    public function CadastrarUserTecnico(TecnicoVO $vo){

        if(
            $vo->getTipo() == '' || $vo->getNome() == '' || $vo->getCpf() == '' ||
            $vo->getEndereco() == ' ' || $vo->getTel() == '' || $vo->getEmail() == ''
            ) return 0;
        
            $vo->setSenha(UtilCTRL::CriptografarSenha($vo->getCpf()));
            $vo->setStatus(1);

        //Preenchimento do sistemaVO para erro
          $vo->setIdUserErro(UtilCTRL::CodigoLogado());
          $vo->setHoraErro(UtilCTRL::HoraAtual());
          $vo->setDataErro(UtilCTRL::DataAtualExibir());
          $vo->setFuncaoErro(CadastrarUserAdm);

          $dao = new UsuarioDao();

          return $dao->CadastrarUserTec($vo);

        
    }

    public function CadastrarUserFuncionario(FuncionarioVO $vo){
       
        if(
            $vo->getTipo() == '' || $vo->getNome() == '' || $vo->getCpf() == '' ||
            $vo->getEndereco() == ' ' || $vo->getTel() == '' || $vo->getEmail() == '' || 
            $vo->getidSetor() == ''
            ) 
            return 0;
        
            $vo->setSenha(UtilCTRL::CriptografarSenha($vo->getCpf()));
            $vo->setStatus(1);

        //Preenchimento do sistemaVO para erro
          $vo->setIdUserErro(UtilCTRL::CodigoLogado());
          $vo->setHoraErro(UtilCTRL::HoraAtual());
          $vo->setDataErro(UtilCTRL::DataAtualExibir());
          $vo->setFuncaoErro(CadastrarUserAdm);

          $dao = new UsuarioDao();

          return $dao->CadastrarUserFunc($vo);

    }

    public function FiltrarUsuario($nome, $tipo){

        $dao = new UsuarioDao();

        return $dao->FiltrarUsuario($nome, $tipo);
    }

    //Recursos de Funcionario

    public function AlterarSenhaFuncionario(FuncionarioVO $vo){

        if($vo->getSenha() == ''){
            return 0;
        }
    }

    public function MeusDadosFuncionario(FuncionarioVO $vo){

        if($vo->getEmail() == '' || $vo->getTel() == '' || $vo->getEndereco() == ''){
            return 0;
        }
    }


    public function AlterarSenha(UsuarioVO $vo){

        if($vo->getSenha() == '')
        return 0;

        $vo->setSenha(UtilCTRL::CriptografarSenha($vo->getSenha()));
        $vo->setIdUser(UtilCTRL::CodigoLogado());

        //Preenchimento do sistemaVO para erro
        $vo->setIdUserErro(UtilCTRL::CodigoLogado());
        $vo->setHoraErro(UtilCTRL::HoraAtual());
        $vo->setDataErro(UtilCTRL::DataAtualExibir());
        $vo->setFuncaoErro(AlterarSenha);

        $dao = new UsuarioDao();
        return $dao->AlterarSenha($vo);


    }

    
}