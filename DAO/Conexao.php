<?php

// Configurações do site
define('HOST', 'localhost'); //IP
define('USER', 'root'); //usuario
define('PASS', null); //Senha
define('DB', 'db_Controle_OS'); //Banco
/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, WMBarros
 */

class Conexao {

    /** @var PDO */
    private static $Connect;

    private static function Conectar() {
        try {

            //Verifica se a conexão não existe
            if (self::$Connect == null):

                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                self::$Connect = new PDO($dsn, USER, PASS, null);
            endif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       
        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
        return  self::$Connect;
    }

    public static function retornarConexao() {
        return  self::Conectar();
    }
    
    public static function GravarErro(SistemaVO $vo){
        $arquivo = $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/DAO/erro/log_erro.txt';

        //verifica se existe o arquivo
        if(!file_exists($arquivo)){
            $arquivo = fopen($arquivo, 'w');
        }else {
            //Abrir o arquivo, deixando o cursos no final do arquivo
            $arquivo = fopen($arquivo, 'a+');
        }
        $texto_msg = '-------------------------------------------------' . PHP_EOL;
        $texto_msg .= '- DATA DO ERRO: ' . $vo->getDataErro() . PHP_EOL;
        $texto_msg .= '- HORA DO ERRO: ' . $vo->getHoraErro() . PHP_EOL;
        $texto_msg .= '- FUNÇÃO DO ERRO: ' . $vo->getFuncaoErro() . PHP_EOL;
        $texto_msg .= '- CÓD. LOGADO: ' . $vo->getIdUserErro() . PHP_EOL;
        $texto_msg .= '- MSG ERRO: ' . $vo->getMsgErro() . PHP_EOL;
       

        //Escreve no arquivo
        fwrite($arquivo, $texto_msg);
        //Fecha o arquivo
        fclose($arquivo);
    }
    
}