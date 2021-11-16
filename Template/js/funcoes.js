function LimparCamposUser() {
    $("#cpf").val('');
    $("#nome").val('');
    $("#setor").val('');
    $("#email").val('');
    $("#telefone").val('');
    $("#endereco").val('');

}

function MostrarCamposUser(tipo) {

    LimparCamposUser();

    switch (tipo) {

        case '1': //Administrador
            $("#div123").show();
            $("#btnSalvar").show();

            $("#div2").hide();
            $("#div23").hide();
            break;

        case '2': // Funcionario
            $("#div123").show();
            $("#btnSalvar").show();

            $("#div2").show();
            $("#div23").show();

            $("#btnSalvar").show();

            break;

        case '3': // Tecnico
            $("#div123").show();
            $("#btnSalvar").show();

            $("#div23").show();

            $("#btnSalvar").show();

            $("#div2").hide();
            break;

        default:
            $("#div123").hide();
            $("#btnSalvar").hide();

            $("#div2").hide();
            $("#div23").hide();
            break;
    }
}

function CarregarDadosTipoEquip(id, nome) {

    $("#id_tipo_alt").val(id);
    $("#nome_tipo_alt").val(nome);

}

function CarregarDadosModeloEquip(id, nome) {

    $("#id_modelo_alt").val(id);
    $("#nome_modelo_alt").val(nome);

}

function CarregarDadosSetor(id, nome) {

    $("#id_setor_alt").val(id);
    $("#nome_setor_alt").val(nome);

}

function CarregarDadosExcluir(id, nome) {

    $("#id_excluir").val(id);
    $("#nome_excluir").html(nome);

}

function ValidarCPF(cpf_digitado, id) {

    if (cpf_digitado != "") {

        $.post('ajax/_verificar_cpf.php', {
            cpf: cpf_digitado,
            id_user: id
        }, function (ret) {
            if (ret == 1) {
                $("#lblCpfVal").html('O CPF: ' + cpf_digitado + ' JÁ EXITE!');
                $("#cpf").val('');
            } else {
                $("#lblCpfVal").html('');
            }
        });
    }

}

function ValidarEMAIL(email_digitado, tipo_escolhido) {

    //alert(tipo_escolhido);

    if (email_digitado != "") {

        $.post('ajax/_verificar_email.php', {
            email_digitado: email_digitado,
            tipo_escolhido: tipo_escolhido
        }, function (ret) {
            if (ret == 1) {
                $("#lblEmailVal").html('O E-MAIL: ' + email_digitado + ' JÁ EXITE!');
                $("#email").val('');
            } else {
                $("#lblEmailVal").html('');
            }
        });
    }

}

function VerificarSenhaAtual() {


    if (ValidarTela(12)) {

        var senhaatual = $("#senhaatual").val().trim();

        $.post("ajax/_verificar_senha_atual.php", { senha: senhaatual }, function (ret) {

            if (ret == 1) {
                $("#passo1").hide();
                $("#passo2").show();
            } else {
                $("#passo1").show();
                $("#passo2").hide();
                ExibirMsg('4');
            }
        })
    }
}

function ValidarNovaSenha() {

    var ret = true;

    if (ValidarTela(13)) {

        if ($("#nsenha").val().trim().length < 6) {
            ExibirMsg('5');
            ret = false;
        } else if ($("#nsenha").val().trim() != $("#rsenha").val().trim()) {
            ExibirMsg('6');
            ret = false;
        } 

    }else{
        ret = false;
    }

    return ret;

}

function CarregarDetalhesChamado(atendido_em, encerrado_em, tecnico, laudo){

    $("#atendido_em").val(atendido_em);
    $("#encerrado_em").val(encerrado_em);
    $("#tecnico").val(tecnico);
    $("#laudo").val(laudo);


}