$(document).ready(function () {
    $;
    $("[data-method]").on("click", function (e) {
        e.preventDefault();
        let titulo = $(this).data("titulo");
        let texto = $(this).data("texto");
        let method = $(this).data("method").toUpperCase();
        let rota = $(this).attr("href");
        let token = $('meta[name="csrf-token"]').attr("content");
        Swal.fire({
            title: titulo,
            text: texto,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                let form = $(
                    `<form action="${rota}" method="POST" style="display: none;">
                        <input type="hidden" name="_token" value="${token}">
                        <input type="hidden" name="_method" value="${method}">
                    </form>`
                );
                $("body").append(form);
                form.submit();
            }
        });
    });
});
