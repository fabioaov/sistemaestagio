<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/jkanban.min.css') }}">
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Leads > Funil de vendas
            </h2>
        </div>
    </x-slot>
    <div class="overflow-hidden rounded-md bg-white p-6 shadow-md dark:bg-dark-eval-1">
        <div id="kanban">
        </div>
    </div>
    <script>
        const leads_aguardando_proposta = @json($leads_aguardando_proposta);
        const leads_proposta_enviada = @json($leads_proposta_enviada);
        const leads_aguardando_contrato = @json($leads_aguardando_contrato);
        const leads_contrato_enviado = @json($leads_contrato_enviado);
    </script>
    <script src="{{ asset('js/jkanban.min.js') }}"></script>
</x-app-layout>
@vite(['resources/js/alerta.js', 'resources/js/kanban.js'])
