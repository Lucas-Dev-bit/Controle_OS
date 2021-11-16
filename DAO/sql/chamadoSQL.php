<?php

class ChamadoSQL
{
    public static function GRAFICO_INICIAL(){

        $sql = '';

        $sql = 'select 
        (select count(id_chamado) from tb_chamado where data_atendimento is null) as aguardando,
        (select count(id_chamado) from tb_chamado where data_atendimento is not null and data_encerramento is null) as atendimento,
        (select count(id_chamado) from tb_chamado where data_encerramento is not null) as encerrado';

        return $sql;
    }


    public static function DETALHAR_CHAMADO(){

        $sql = '';

        $sql = 'SELECT  ch.id_chamado,
                        ch.data_chamado,
                        ch.data_atendimento,
                        ch.hora_atendimento,
                        ch.data_encerramento,
                        ch.hora_encerramento,
                        ch.laudo_tecnico,
                        se.nome_setor,
                        ch.desc_chamado,
                        eq.ident_equip,
                        eq.desc_equip, 
                        usu_fun.nome_usuario as funcionario,
                        usu_tec.nome_usuario as tecnico,
                        al.id_alocarequip
                    FROM tb_chamado as ch
              INNER JOIN tb_equipamento as eq
                      ON ch.id_equipamento = eq.id_equipamento
              INNER JOIN tb_funcionario as fu
                      ON ch.id_usuario_func = fu.id_usuario_func
              INNER JOIN tb_usuario as usu_fun
                      ON fu.id_usuario_func = usu_fun.id_usuario
              INNER JOIN tb_alocarequip as al
                      ON eq.id_equipamento = al.id_equipamento
              INNER JOIN tb_setor as se
                      ON se.id_setor = al.id_setor
               LEFT JOIN tb_tecnico as te
                      ON ch.id_usuario_tec = te.id_usuario_tec
               LEFT JOIN tb_usuario as usu_tec
                      ON te.id_usuario_tec = usu_tec.id_usuario
                   WHERE ch.id_chamado = ?';

        return $sql;

    }

    public static function FILTRAR_CHAMADO($situacao, $idSetor)
    {

        $sql = '';

        $sql = ' SELECT ch.id_chamado,
                        ch.data_chamado,
                        ch.data_atendimento,
                        ch.hora_atendimento,
                        ch.data_encerramento,
                        ch.hora_encerramento,
                        ch.laudo_tecnico,
                        ch.desc_chamado,
                        eq.ident_equip,
                        eq.desc_equip,
                        usu_fun.nome_usuario as funcionario,
                        usu_tec.nome_usuario as tecnico
                    FROM tb_chamado as ch
              INNER JOIN tb_equipamento as eq
                      ON ch.id_equipamento = eq.id_equipamento
              INNER JOIN tb_funcionario as fu
                      ON ch.id_usuario_func = fu.id_usuario_func
              INNER JOIN tb_usuario as usu_fun
                      ON fu.id_usuario_func = usu_fun.id_usuario
              INNER JOIN tb_alocarequip as al
                      ON al.id_equipamento = al.id_equipamento
               LEFT JOIN tb_tecnico as te
                      ON ch.id_usuario_tec = te.id_usuario_tec
               LEFT JOIN tb_usuario as usu_tec
                      ON te.id_usuario_tec = usu_tec.id_usuario
                   WHERE al.sit_alocar <> ?
                     AND al.data_remover IS NULL';

                   if($idSetor != ''){
                       $sql .= ' al.id_setor = ?';
                   }


        if ($situacao != 0) {

            switch ($situacao) {
                case 1:
                    $sql .= ' AND ch.data_atendimento IS NULL';
                    break;
                case 2: 
                    $sql .= ' AND ch.data_atendimento IS NOT NULL AND ch.data_encerramento IS NULL';
                    break;
                case 3:
                    $sql .= ' AND ch.data_encerramento IS NOT NULL';
                    break;
            }
        }

        return $sql;
    } 

    public static function CARREGAR_EQUIPAMENTO_CHAMADO()
    {

        $sql = '';

        $sql = 'SELECT al.id_equipamento,
                       al.id_alocarequip,
                       eq.ident_equip,
                       eq.desc_equip
                  from tb_alocarequip as al
            inner join tb_equipamento as eq
                    on al.id_equipamento = eq.id_equipamento
                 WHERE al.id_setor = ?
                   AND al.sit_alocar = ?';

        return $sql;
    }

    public static function ABRIR_CHAMADO()
    {

        $sql = '';

        $sql = 'INSERT INTO tb_chamado
                        (data_chamado, hora_chamado, desc_chamado, id_equipamento, id_usuario_func)
                    VALUES
                        (?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function ATUALIZAR_SITUACAO()
    {

        $sql = '';

        $sql = 'UPDATE tb_alocarequip
                   SET sit_alocar = ?
                 WHERE id_alocarequip = ?';

        return $sql;
    }

    public static function ATENDER_CHAMADO(){

        $sql = '';

        $sql = ' UPDATE tb_chamado
                    SET data_atendimento = ?,
                        hora_atendimento = ?,
                        id_usuario_tec = ?
                 WHERE  id_chamado = ?';

        return $sql;
    }

    public static function FINALIZAR_CHAMADO(){

        $sql = '';

        $sql = ' UPDATE tb_chamado
                    SET data_encerramento = ?,
                        hora_encerramento = ?,
                        id_usuario_tec = ?,
                        laudo_tecnico = ?
                  WHERE id_chamado = ?';

        return $sql;
    }
}
