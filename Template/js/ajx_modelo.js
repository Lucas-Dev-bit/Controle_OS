function InserirModelo() {

    if (ValidarTela(1)) {

        var nome_dig = $("#nome").val();

        $.post('ajax/_modeloequip.php', {
            nome: nome_dig,
            acao: 1
        }, function (ret) {
            
            ExibirMsg(ret);

            if (ret == 1) {

                $.post('ajax/_modeloequip.php', { acao: 2 },
                    function (dados) {
                        $("#resultadoTable").html(dados);
                    });
                $("#nome").val();
            }
        })
    }

    return false;
    
}