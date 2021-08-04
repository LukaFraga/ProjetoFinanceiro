function ValidarCamposCategoria() {
    if ($("#nome").val().trim() == "") {
        alert("Preencher o campo Nome da Categoria");
        $("#nome").focus();
        return false;
    }
}

function ValidarCamposMeusDados() {
    if ($("#nome").val().trim() == "") {
        alert("Preencher o campo Nome");
        $("#nome").focus();
        return false;
    }
    if ($("#email").val().trim() == "") {
        alert("Preencher o campo E-mail");
        $("#email").focus();
        return false;
    }
}

function ValidarCamposConta() {
    if ($("#nome").val().trim() == "") {
        alert("Preencher o campo Nome Do Banco");
        $("#nome").focus();
        return false;
    }
    if ($("#tipoconta").val().trim() == "") {
        alert("Escolher uma opção do Tipo Da Conta");
        $("#tipoconta").focus();
        return false;
    }
    if ($("#agencia").val().trim() == "") {
        alert("Preencher o campo Agência");
        $("#agencia").focus();
        return false;
    }
    if ($("#numero").val().trim() == "") {
        alert("Preencher o campo Número da Conta");
        $("#numero").focus();
        return false;
    }
    if ($("#saldo").val().trim() == "") {
        alert("Preencher o campo Saldo da Conta");
        $("#saldo").focus();
        return false;
    }
}

function ValidarCamposEmpresa() {
    if ($("#nome").val().trim() == "") {
        alert("Preencher o Campo Nome da Empresa");
        $("#nome").focus();
        return false;
    }
    if ($("#endereco").val().trim() == "") {
        alert("Preencher o Campo Endereço");
        $("#endereco").focus();
        return false;
    }
    if ($("#telefone").val().trim() == "") {
        alert("Preencher o Campo Número de Telefone");
        $("#telefone").focus();
        return false;
    }
}

function ValidarCamposMovimento() {
    if ($("#movimento").val().trim() == "") {
        alert("Escolha o seu Tipo de Movimento");
        $("#movimento").focus();
        return false;
    }
    if ($("#categoria").val().trim() == "") {
        alert("Escolha o seu Tipo de Categoria");
        $("#categoria").focus();
        return false;
    }
    if ($("#empresa").val().trim() == "") {
        alert("Escolha a sua Empresa");
        $("#empresa").focus();
        return false;
    }
    if ($("#data").val().trim() == "") {
        alert("Escolha uma Data");
        $("#data").focus();
        return false;
    }
    if ($("#conta").val().trim() == "") {
        alert("Escolha o seu tipo de Conta");
        $("#conta").focus();
        return false;
    }
    if ($("#valor").val().trim() == "") {
        alert("Preencha o Campo Valor");
        $("#valor").focus();
        return false;
    }
}

function ValidarCamposPesquisa() {
    if ($("#tipomov").val().trim() == "") {
        alert("Escolha o seu Tipo de Movimento");
        $("#tipomov").focus();
        return false;
    }

    if ($("#dtinicial").val().trim() == "") {
        alert("Escolha a sua Data Inicial");
        $("#dtinicial").focus();
        return false;
    }
    if ($("#dtfinal").val().trim() == "") {
        alert("Escolha a sua Data Final");
        $("#dtfinal").focus();
        return false;
    }
}   

function ValidarCamposCadastro(){
    if ($("#nome").val().trim() == ""){
        alert("Preencha o Campo Nome");
        $("#nome").focus();
        return false;
    }
    if ($("#email").val().trim() == ""){
        alert("Preencha o Campo E-mail");
        $("#email").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6){
        alert("Preencha o Campo Senha e verifique se tem 6 caracteres");
        $("#senha").focus();
        return false;
    }
    if ($("#rsenha").val().trim() != $("#senha").val().trim()){
        alert("As senhas Divergem");
        $("#rsenha").focus();
        return false;
    }
}

