$(document).ready(function () {
    let idCidade = $("#id_cidade").val();
    if (idCidade.trim() !== "") {
        const idEstado = $("#estado").val();
        buscarCidadesPorIdEstado(idEstado, idCidade);
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
            buscarIdEstadoPorSigla(data.uf).then(function () {
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
    return new Promise(function (resolve, reject) {
        $.get(`/cidade/${nomeCidade}/${siglaEstado}`)
            .done(function (data) {
                let selectCidade = $("#cidade");
                selectCidade.val(data);
                resolve();
            })
            .fail(function (error) {
                reject(error);
            });
    });
}
function buscarIdEstadoPorSigla(siglaEstado) {
    return new Promise(function (resolve, reject) {
        $.get(`/estados/${siglaEstado}`)
            .done(function (data) {
                let selectEstado = $("#estado");
                selectEstado.val(data);
                buscarCidadesPorIdEstado(data);
                resolve();
            })
            .fail(function (error) {
                reject(error);
            });
    });
}
