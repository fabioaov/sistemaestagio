$("#cep").on("blur", function () {
    consultarCep($(this).val());
});
$("#estado").on("change", function () {
    buscarCidadesPorEstado($(this).val());
});
function consultarCep(cep) {
    $.get(`https://viacep.com.br/ws/${cep}/json/`)
        .done(function (data) {
            const endereco = `${data.logradouro}, ${data.complemento}, ${data.bairro}`;
            $("#logradouro").val(endereco);
            buscarEstadoPorSigla(data.uf, function () {
                buscarCidadePorNome(data.localidade);
            });
        })
        .fail(function (error) {
            console.error("Erro ao consultar o CEP:", error);
        });
}
function buscarCidadesPorEstado(idEstado) {
    $.get(`/cidades/${idEstado}`).done(function (data) {
        let selectCidade = $("#cidade");
        selectCidade.empty();
        selectCidade.append('<option value="">Selecione</option>');
        $.each(data, function (index, cidade) {
            selectCidade.append(
                `<option value="${cidade.id}">${cidade.nome}</option>`
            );
        });
    });
}
function buscarCidadePorNome(nomeCidade) {
    $.get(`/cidade/${nomeCidade}`).done(function (data) {
        let selectCidade = $("#cidade");
        selectCidade.val(data.id);
    });
}
function buscarEstadoPorSigla(siglaEstado, callback) {
    $.get(`/estados/${siglaEstado}`).done(function (data) {
        let selectEstado = $("#estado");
        selectEstado.val(data.id);
        buscarCidadesPorEstado(data.id);
        if (callback) {
            callback();
        }
    });
}
