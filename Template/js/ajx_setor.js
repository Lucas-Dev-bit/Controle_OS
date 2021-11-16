function InserirSetor() {

    if (ValidarTela(1)) {

        var nome_dig = $("#nome").val();

        $.post('ajax/_setor.php', {
            nome: nome_dig,
            acao: 1
        }, function (ret) {
            
            ExibirMsg(ret);

            if (ret == 1) {

                $.post('ajax/_setor.php', { acao: 2 },
                    function (dados) {
                        $("#resultadoTable").html(dados);
                    });
                $("#nome").val();
            }
        })
    }
    return false;
}