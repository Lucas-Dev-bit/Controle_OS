function ValidarTela(n_tela) {

    var ret = true;

    switch (n_tela) {

        //Gerencia os parâmetros ADM
        case 1: //telas: setor / consultar usuario / tipo equip / modelo equip / consultar equip
            if ($("#nome").val().trim() == '') {
                ret = false;
            }
            break;

        case 2: // telas: alocar equipamento / 
            if ($("#equipamento").val().trim() == '' || $("#setor").val().trim() == '') {
                ret = false;
            }
            break;

        case 3: // telas: novo equipamento / equipamento
            if ($("#tipo").val().trim() == '' ||
                $("#modelo").val().trim() == '' ||
                $("#ident").val().trim() == '' ||
                $("#desc").val().trim() == '') {
                ret = false;
            }

        case 4: // USUARIO // LOGIN(ACESSO)
            if ($("#cpf").val().trim() == '' || $("#nome").val().trim() == '') {
                ret = false;
                break;
            }

            var tipo = $("#tipo").val();

            switch (tipo) {

                case '2':
                case '3':

                    if ($("#email").val().trim() == '' || $("#telefone").val().trim() == '' || $("#endereco").val().trim() == '') {
                        ret = false;
                        break;
                    }
                    if (tipo == 2) {
                        if ($("#setor").val().trim() == '') {
                            ret = false
                        }
                    }
                    break;
            }
            break;
        //FIM


        case 8: // mudar senha obs: falta validar os campos NOVA SENHA e REPETIR SENHA
            if ($("#senha").val().trim() == '') {
                ret = false;
            }

        case 9:
            if ($("#email").val().trim() == '' || $("#telefone").val().trim() == '' ||
                $("#endereco").val().trim() == '') {
                ret = false;
            }

        case 10: //filtrar equipamento 
            if ($("#tipo").val().trim() == '')
                ret = false;

            break;

        case 11: //Remover equipamento setor
            if ($("#idSetor").val().trim() == '')
                ret = false;

            break;

        case 12: //Mudar Senha FUNCIONARIO
            if ($("#senhaatual").val().trim() == '')
                ret = false;

            break;

        case 13: //Mudar Senha Gravar FUNCIONARIO
            if ($("#nsenha").val().trim() == '' || $("#rsenha").val().trim() == '')
                ret = false;

            break;

        case 14: //Abir Chamado FUNCIONARIO
            if ($("#equip").val().trim() == '' || $("#desc").val().trim() == '')
                ret = false;

            break;

        case 15: //Tela: LAUDO - perfil tecnico
            if ($("#laudo").val().trim() == '' )
                ret = false;

            break;
    }

    if (!ret)
        toastr.warning(RetornarMsg(0));

    return ret;
}