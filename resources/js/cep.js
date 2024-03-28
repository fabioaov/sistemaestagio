$("#cep").on("blur", function () {
    consultarCep($(this).val());
});
function consultarCep(cep) {
    $.get(`https://viacep.com.br/ws/${cep}/json/`)
        .done(function (data) {
            const endereco = `${data.logradouro}, ${data.complemento}, ${data.bairro}`
            $("#logradouro").val(endereco);
            $("#cidade").val(data.localidade);
            $("#estado").val(data.uf);
        })
        .fail(function (error) {
            console.error("Erro ao consultar o CEP:", error);
        });
}
