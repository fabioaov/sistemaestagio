const kanban = new jKanban({
    element: "#kanban",
    responsivePercentage: true,
    boards: [
        {
            id: "aguardando-proposta",
            title: '<h5 class="text-base font-semibold text-gray-900 md:text-xl dark:text-white">Aguardando proposta</h5>',
            item: leads_aguardando_proposta.map((lead) => ({
                title: lead.razao_social,
            })),
        },
        {
            id: "proposta-enviada",
            title: '<h5 class="text-base font-semibold text-gray-900 md:text-xl dark:text-white">Proposta enviada</h5>',
            item: leads_proposta_enviada.map((lead) => ({
                title: lead.razao_social,
            })),
        },
        {
            id: "aguardando-contrato",
            title: '<h5 class="text-base font-semibold text-gray-900 md:text-xl dark:text-white">Aguardando contrato</h5>',
            item: leads_aguardando_contrato.map((lead) => ({
                title: lead.razao_social,
            })),
        },
        {
            id: "contrato-enviado",
            title: '<h5 class="text-base font-semibold text-gray-900 md:text-xl dark:text-white">Contrato enviado</h5>',
            item: leads_contrato_enviado.map((lead) => ({
                title: lead.razao_social,
            })),
        },
    ],
    dragBoards: false,
});
$(".kanban-board").each(function () {
    $(this).addClass(
        "w-full max-w-sm bg-white rounded-lg shadow dark:bg-gray-800 "
    );
});
$(".kanban-item").each(function () {
    $(this).addClass(
        "flex items-center text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white"
    );
});
