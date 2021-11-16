<?php


class UtilCTRL
{

    public static function RetornarCaminho()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/';
    }

    public static function NomeTipoUser($tipo)
    {

        $nome = '';
        switch ($tipo) {
            case 1:
                $nome = 'Administrador';
                break;
            case 2:
                $nome = 'Funcionário';
                break;
            case 3:
                $nome = 'Técnico';
                break;
        }

        return $nome;
    }

    public static function SituacaoChamado($data_atendimento, $data_encerramento){

        $nome = '';

        if($data_atendimento == ''){
            $nome = '<span class="badge bg-warning">Aguardando</span>';
        }else if($data_atendimento != '' && $data_encerramento == '' ){
            $nome = '<span class="badge bg-primary">Em Atendimento</span>';
        }else if($data_encerramento != ''){
            $nome = '<span class="badge bg-success">Finalizado</span>';
        }

        return $nome;
    }

    public static function IniciarSessao()
    {

        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function CriarSessao($idUser, $tipo, $nome, $idSetor)
    {
        self::IniciarSessao();

        $_SESSION['codUser'] = $idUser;
        $_SESSION['tipo'] = $tipo;
        $_SESSION['nome'] = $nome;
        $_SESSION['setor'] = $idSetor;
    }


    public static function CodigoLogado()
    {
        self::IniciarSessao();
        return $_SESSION['codUser'];
    }

    public static function TipoLogado()
    {
        self::IniciarSessao();
        return $_SESSION['tipo'];
    }

    public static function NomeLogado()
    {
        self::IniciarSessao();
        return $_SESSION['nome'];
    }

    public static function SetorLogado()
    {
        self::IniciarSessao();
        return $_SESSION['setor'];
    }

    public static function Deslogar()
    {

        self::IniciarSessao();
        unset($_SESSION['codUser']);
        unset($_SESSION['tipo']);
        unset($_SESSION['nome']);
        unset($_SESSION['setor']);

        self::PaginaLogar();
    }

    public static function VerificarLogado()
    {

        self::IniciarSessao();

        if (!isset($_SESSION['codUser']))
            self::PaginaLogar();
    }

    public static function ValidarTipoLogado($tipo)
    {

        if (self::TipoLogado() != $tipo)
            self::Deslogar();
    }


    private static function PaginaLogar()
    {

        header('location: http://localhost/ControleOS/acesso/logar/acessar.php');
        exit;
    }

    private static function SetarFusoHorario()
    {

        date_default_timezone_set('America/Sao_Paulo');
    }

    public static function DataAtual()
    {
        self::SetarFusoHorario();
        return date('Y-m-d');
    }

    public static function DataAtualExibir()
    {
        self::SetarFusoHorario();
        return date('d/m/y');
    }

    public static function DataExibir($data)
    {

        $data_arrey = explode('-', $data);
        return $data_arrey[2] . '/' . $data_arrey[1] . '/' . $data_arrey[0];
    }

    public static function HoraAtual()
    {
        self::SetarFusoHorario();
        return date('H:i');
    }

    public static function TirarCaracteresEspeciais($palavra)
    {
        $especial = array('.', '(', ')', '-', ' ', '_');
        $palavra = str_replace($especial, '', $palavra);
        return $palavra;
    }


    public static function TirarScriptsMaliciosos($palavra)
    {
        $especial = array('<script>', '</script>', 'alert', '*', 'table', 'select');
        $palavra = str_replace($especial, '', $palavra);
        return $palavra;
    }

    public static function CriptografarSenha($senha)
    {

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        return $senha_hash;
    }
}
