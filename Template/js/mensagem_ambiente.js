function RetornarMsg(num) {

    var msg = "";

    switch (num) {

        case -2:
            msg = "Não foi possível excluir o registro!";
            break;

        case -1:
            msg = "Ocorreu um erro na operação. Tente mais tarde!";
            break;

        case 0:
            msg = "Preencher TODOS os campos obrigatórios!";
            break;

        case 1:
            msg = "Ação realizada com sucesso!";
            break;

        case 2:
            msg = "Não foi encontrado nenhum registro para ser exibido!";
            break;

        case 3:
            msg = "Login não encontrado!";
            break;

        case 4:
            msg = "Senha não confere!";
            break;

        case 5:
            msg = "Senha deverá conter no mínimo 6 caracteres!";
            break;


        case 6:
            msg = "Senha e repetir senha não confere!";
            break;

    }

    return msg;
}