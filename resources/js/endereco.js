$(document).ready(function () {
    if (oldCidade.trim() !== "") {
        const idEstado = $("#estado").val();
        buscarCidadesPorIdEstado(idEstado, oldCidade);
    }
});
window.consultarCep = function consultarCep(cep) {
    $.get(`https://viacep.com.br/ws/${cep}/json/`)
        .done(function (data) {
            const endereco =
                data.complemento.trim() !== ""
                    ? `${data.logradouro}, ${data.complemento}, ${data.bairro}`
                    : `${data.logradouro}, ${data.bairro}`;
            $("#logradouro").val(endereco);
            buscarIdEstadoPorSigla(data.uf, function () {
                buscarIdCidadePorNomeESiglaEstado(data.localidade, data.uf);
            });
        })
        .fail(function (error) {
            console.error("Erro ao consultar o CEP:", error);
        });
};
window.buscarCidadesPorIdEstado = function buscarCidadesPorIdEstado(
    idEstado,
    idCidade = null
) {
    $.get(`/cidades/${idEstado}`).done(function (data) {
        let selectCidade = $("#cidade");
        selectCidade.empty();
        selectCidade.append('<option value="">Selecione</option>');
        $.each(data, function (index, cidade) {
            let selected = idCidade == cidade.id ? "selected" : "";
            selectCidade.append(
                `<option value='${cidade.id}' ${selected}>${cidade.nome}</option>`
            );
        });
    });
};
function buscarIdCidadePorNomeESiglaEstado(nomeCidade, siglaEstado) {
    $.get(`/cidade/${nomeCidade}/${siglaEstado}`).done(function (data) {
        let selectCidade = $("#cidade");
        selectCidade.val(data);
    });
}
function buscarIdEstadoPorSigla(siglaEstado, callback) {
    $.get(`/estados/${siglaEstado}`).done(function (data) {
        let selectEstado = $("#estado");
        selectEstado.val(data);
        buscarCidadesPorIdEstado(data);
        if (callback) {
            callback();
        }
    });
}
