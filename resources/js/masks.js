import "jquery-mask-plugin";
const opcoesTelefone = function (val) {
    switch (val.replace(/\D/g, "").length) {
        case 8:
            return "0000-00009";
        case 11:
            return "(00) 00000-0000";
        default:
            return "(00) 0000-00009";
    }
};
const spOptions = {
    onKeyPress: function (val, e, field, options) {
        field.mask(opcoesTelefone.apply({}, arguments), options);
    },
};
$(".cnpj").mask("00.000.000/0000-00", { reverse: true });
$(".cep").mask("00000-000");
$(".telefone").mask(opcoesTelefone, spOptions);
