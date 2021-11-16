<?php

require_once '../../Controller/ChamadoCTRL.php';
require_once '_verificar_adm.php';

use Dompdf\Dompdf;
use FontLib\Table\Type\head;

require_once 'dompdf/autoload.inc.php';

if (isset($_GET['sit'])) {

    $ctrl = new ChamadoCTRL();

    $situacao = $_GET['sit'];

    $chs = $ctrl->FiltrarChamado($situacao, UtilCTRL::SetorLogado());

    if(count($chs) == 0){
        header('location: adm_rel_chamados.php');
        exit;
    }
    $img = '<img src="../../Template/img/logo.png" style="width: 85px"><br>';

    $titulo = "<h1>Relatório de Chamados</h1><br> Emitido em " . UtilCTRL::DataAtualExibir() . ' às ' . UtilCTRL::HoraAtual() . '<hr>';

    $table_inicial = '
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th>Data Abertura</th>
                                <th>Funcionário</th>
                                <th>Equipamento</th>
                                <th>Problema</th>
                                <th>Situação</th>  
                                                              
                            </tr>                     
                        </thead>
                                                    
                        <tbody> ';
    $conteudo = '';

            foreach ($chs as $item) {
                $conteudo .= '<tr>
                                <td>' . (UtilCTRL::DataExibir($item['data_chamado'])) . '</td>
                                <td>' . $item['funcionario'] . '</td>
                                <td>' . $item['ident_equip'] . ' / ' . $item['desc_equip'] . '</td>
                                <td>' . $item['desc_chamado'] . '</td>
                                <td>' . (UtilCTRL::SituacaoChamado($item['data_atendimento'], $item['data_atendimento'], $item['data_encerramento'])); '</td>
                              </tr>';
            }

    $table_fim = '</tbody></table>';

   

    $table_full = $img . $titulo . $table_inicial . $conteudo . $table_fim;

    $domPdf = new Dompdf();
    $domPdf->loadHtml($table_full);
    $domPdf->render();
    $domPdf->stream('chamados_situacao.php', array('Attachment' => false));

}else{
    header('location: adm_rel_chamados.php');
    exit;
}

?>