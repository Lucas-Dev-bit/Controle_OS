<?php

class EquipamentoSQL
{

    public static function CADASTRAR_EQUIPAMENTO()
    {
        $sql = '';

        $sql = 'INSERT INTO tb_equipamento
                            (ident_equip, desc_equip, id_modeloequip, id_tipoequip)
                            value
                            (?, ?, ?, ?)';

        return $sql;
    }

    public static function ALOCAR_EQUIPAMENTO(){

        $sql = '';

        $sql = 'INSERT INTO tb_alocarequip
                            (sit_alocar, data_alocar, id_setor, id_equipamento)
                            VALUE
                            (?, ?, ?, ?)';

        return $sql;

    }

    public static function ALTERAR_EQUIPAMENTO()
    {
        $sql = '';

        $sql = 'UPDATE tb_equipamento
                   SET ident_equip = ?, 
                       desc_equip = ?, 
                       id_modeloequip = ?, 
                       id_tipoequip = ?
                 WHERE id_equipamento = ?';

        return $sql;
    }


    public static function FILTRAR_EQUIPAMENTO(){

        $sql = '';

        $sql = 'SELECT eq.id_equipamento,
                       ti.nome_tipo,
                       mo.nome_modelo,
                       eq.ident_equip,
                       eq.desc_equip
                  FROM tb_equipamento as eq
            INNER JOIN tb_tipoequip as ti
                    ON eq.id_tipoequip = ti.id_tipoequip
            INNER JOIN tb_modeloequip as mo
                    ON eq.id_modeloequip = mo.id_modeloequip
                WHERE eq.id_tipoequip = ?';

        return $sql;
    }

    public static function DETALHAR_EQUIPAMENTO(){

        $sql = '';

        $sql = 'SELECT eq.id_equipamento,
                       eq.id_tipoequip,
                       eq.id_modeloequip,
                       eq.ident_equip,
                       eq.desc_equip
                  FROM tb_equipamento as eq
                WHERE eq.id_equipamento = ?';

        return $sql;
    }

    public static function FILTRAR_EQUIPAMENTO_NAO_ALOCADO(){

        $sql = '';

        $sql = 'SELECT eq.id_equipamento,
                       ti.nome_tipo,
                       mo.nome_modelo,
                       eq.ident_equip,
                       eq.desc_equip
                  FROM tb_equipamento as eq
            INNER JOIN tb_tipoequip as ti
                    ON eq.id_tipoequip = ti.id_tipoequip
            INNER JOIN tb_modeloequip as mo
                    ON eq.id_modeloequip = mo.id_modeloequip
                WHERE eq.id_equipamento NOT IN (SELECT al.id_equipamento
                                                FROM tb_alocarequip as al
                                                WHERE al.sit_alocar != 2)';

        return $sql;
    }


    public static function EXCLUIR_EQUIPAMENTO(){

        $sql = '';

        $sql = 'DELETE 
                FROM tb_equipamento
                WHERE id_equipamento = ?';

        return $sql;
    }

    public static function EQUIPAMENTOS_ALOCADOS_SETOR(){

        $sql = '';
 
        $sql = ' SELECT al.id_alocarequip,
                        ti.nome_tipo,
                        mo.nome_modelo,
                        eq.ident_equip,
                        eq.desc_equip
                   FROM tb_alocarequip as al
             INNER JOIN tb_equipamento as eq
                     ON al.id_equipamento = eq.id_equipamento
             INNER JOIN tb_tipoequip as ti
                     ON eq.id_tipoequip = ti.id_tipoequip
             INNER JOIN tb_modeloequip as mo
                     ON eq.id_modeloequip = mo.id_modeloequip
                  WHERE al.id_setor = ? and al.sit_alocar = 1';

        return $sql;

    }

    public static function REMOVAR_EQUIPAMENTO_SETOR(){

        $sql = '';

        $sql = 'UPDATE tb_alocarequip
                   SET sit_alocar = ?,
                       data_remover = ?
                 WHERE id_alocarequip = ?';

        return $sql;

    }
}
