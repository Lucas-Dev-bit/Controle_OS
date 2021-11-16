<?php

class UsuarioSQL
{

    public static function FILTRAR_USUARIO($tipo, $nome){

        $sql = '';

        if($tipo == 0 && $nome != ''){

            $sql = 'SELECT id_usuario,
                           nome_usuario,
                           tipo_usuario
                      from tb_usuario
                     where nome_usuario like ?';

        }else if($tipo != 0 && $nome == ''){

            $sql = 'SELECT id_usuario,
                           nome_usuario,
                           tipo_usuario
                      from tb_usuario
                     where tipo_usuario = ?';

        }else if($tipo != 0 && $nome != ''){

            $sql = 'SELECT id_usuario,
                            nome_usuario,
                            tipo_usuario
                       from tb_usuario
                      where tipo_usuario = ?
                        and nome_usuario like ?';

        }else if($tipo == 0 && $nome == ''){

            $sql = 'SELECT id_usuario,
                            nome_usuario,
                            tipo_usuario
                       from tb_usuario';
        }

        return $sql;

    }

    public static function INSERIR_USUARIO()
    {

        $sql = '';

        $sql = 'INSERT INTO tb_usuario
                            (nome_usuario, cpf_usuario, senha_usuario, tipo_usuario, status_usuario)
                        value
                            (?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function ALTERAR_USUARIO(){

        $sql = '';

        $sql = 'UPDATE tb_usuario
                   SET nome_usuario = ?,
                       cpf_usuario = ?
                 WHERE id_usuario = ?';

        return $sql;
    }

    public static function ALTERAR_FUNCIONARIO(){

        $sql = '';

        $sql = ' UPDATE tb_funcionario
                    SET tel_func = ?,
                        end_func = ?,
                        email_func = ?,
                        id_setor = ?
                  WHERE id_usuario_func = ?';

        return $sql;
    }

    public static function ALTERAR_TECNICO(){

        $sql = '';

        $sql = ' UPDATE tb_tecnico
                    SET tel_tec = ?,
                        end_tec = ?,
                        email_tec = ?       
                  WHERE id_usuario_tec = ?';

        return $sql;
    }

    public static function INSERIR_FUNCIONARIO()
    {

        $sql = '';

        $sql = 'INSERT INTO tb_funcionario
                            (id_usuario_func, tel_func, end_func, email_func, id_setor)
                        value
                            (?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function INSERIR_TECNICO()
    {

        $sql = '';

        $sql = ' INSERT INTO tb_tecnico 
                            (id_usuario_tec, tel_tec, end_tec, email_tec)
                        value 
                            (?, ?, ?, ?)';

        return $sql;
    }

    public static function CONSULTAR_CPF($id)
    {
        $sql = '';
        if ($id == ''){
            $sql = 'SELECT count(cpf_usuario) as contar 
                    from tb_usuario where cpf_usuario = ?';
        }else {
            $sql = 'SELECT count(cpf_usuario) as contar
                    from tb_usuario WHERE cpf_usuario = ? and id_usuario != ? ';
        }
        return $sql;
    }

    public static function CONSULTAR_EMAIL($tipo)
    {

        $sql = '';

        if($tipo == 2){
        $sql = 'SELECT count(email_func) as contar
                from tb_funcionario where email_func = ?';
        }else if($tipo == 3){
            $sql = 'SELECT count(email_tec) as contar
            from tb_tecnico where email_tec = ?';
        }

        return $sql;
    }

    public static function EXCLUIR_USUARIO(){

        $sql = '';

        $sql = 'DELETE from tb_usuario WHERE id_usuario = ?';

        return $sql;
    }

    public static function EXCLUIR_TECNICO(){

        $sql = '';

        $sql = 'DELETE from tb_tecnico WHERE id_usuario_tec = ?';

        return $sql;
    }

    public static function EXCLUIR_FUNCIONARIO(){

        $sql = '';

        $sql = 'DELETE from tb_funcionario WHERE id_usuario_func = ?';

        return $sql;
    }

    public static function DETALHAR_USUARIO(){

        $sql = '';

        $sql = 'SELECT 
                    usu.nome_usuario,
                    usu.id_usuario,
                    usu.tipo_usuario,
                    usu.cpf_usuario,
                    tec.tel_tec,
                    tec.end_tec,
                    tec.email_tec,
                    fun.tel_func,
                    fun.end_func,
                    fun.email_func,
                    fun.id_setor
            FROM tb_usuario AS usu
      LEFT JOIN tb_tecnico AS tec
              ON usu.id_usuario = tec.id_usuario_tec
      LEFT JOIN tb_funcionario AS fun
              ON usu.id_usuario = fun.id_usuario_func
              WHERE usu.id_usuario = ?';

        return $sql;
    }

    public static function VALIDAR_LOGIN(){

        $sql = '';

        $sql = ' SELECT user.id_usuario,
                        user.senha_usuario,
                        user.nome_usuario,
                        user.tipo_usuario,
                        fu.id_setor
                   FROM tb_usuario as user
             LEFT JOIN tb_funcionario as fu
                     ON user.id_usuario = fu.id_usuario_func
                  WHERE user.cpf_usuario = ? AND user.status_usuario = 1';

        return $sql;

    }

    public static function VALIDAR_SENHA_ATUAL(){

        $sql = '';

        $sql = ' SELECT senha_usuario
                   FROM tb_usuario 
                  WHERE id_usuario = ?';

        return $sql;

    }

    public static function ALTERAR_SENHA(){


        $sql = '';

        $sql = 'UPDATE tb_usuario
                   SET senha_usuario = ?
                 WHERE id_usuario = ?';

        return $sql;
    }
}
