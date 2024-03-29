<?php

class TipoEquipSQL
{

    public static function INSERIR_TIPO()
    {

        $sql = '';

        $sql = 'INSERT into tb_tipoequip
                                (nome_tipo) 
                             values 
                                (?)';

        return $sql;
    }

    public static function ALTERAR_TIPO(){

        $sql = '';

        $sql = 'UPDATE tb_tipoequip 
                   set nome_tipo = ?
                 where id_tipoequip = ?';

        return $sql;
    }

    public static function CONSULTAR_TIPO()
    {

        $sql = '';

        $sql = 'SELECT nome_tipo, id_tipoequip from tb_tipoequip';

        return $sql;
    }

    public static function EXCLUIR_TIPO()
    {

        $sql = '';

        $sql = 'DELETE from tb_tipoequip
                        where id_tipoEQUIP = ?';

        return $sql;
    }
}
