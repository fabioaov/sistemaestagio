<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Leads > Fluxo de vendas
            </h2>
        </div>
    </x-slot>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="flex">
            <div id="aguardando_proposta" data-value="4" class="dropzone w-1/4 p-4" ondrop="drop(event, 'aguardando_proposta')"
                ondragover="allowDrop(event)">
                <h2 class="text-lg font-medium mb-4">Aguardando proposta</h2>
                @foreach($leads_aguardando_proposta as $lead)
                <div id="card_{{ $lead->id }}"
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-4 cursor-move"
                    draggable="true" ondragstart="drag(event, 'card_{{ $lead->id }}')">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $lead->razao_social }}</h2>
                    <p class="font-normal text-gray-700 dark:text-gray-400"></p>
                </div>
                @endforeach
            </div>
            <div id="proposta_enviada" data-value="5" class="dropzone w-1/4 p-4" ondrop="drop(event, 'proposta_enviada')"
                ondragover="allowDrop(event)">
                <h2 class="text-lg font-medium mb-4">Proposta enviada</h2>
                @foreach($leads_proposta_enviada as $lead)
                <div id="card_{{ $lead->id }}"
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-4 cursor-move"
                    draggable="true" ondragstart="drag(event, 'card_{{ $lead->id }}')">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $lead->razao_social }}</h2>
                    <p class="font-normal text-gray-700 dark:text-gray-400"></p>
                </div>
                @endforeach
            </div>
            <div id="aguardando_contrato" data-value="6" class="dropzone w-1/4 p-4" ondrop="drop(event, 'aguardando_contrato')"
                ondragover="allowDrop(event)">
                <h2 class="text-lg font-medium mb-4">Aguardando contrato</h2>
                @foreach($leads_aguardando_contrato as $lead)
                <div id="card_{{ $lead->id }}"
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-4 cursor-move"
                    draggable="true" ondragstart="drag(event, 'card_{{ $lead->id }}')">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $lead->razao_social }}</h2>
                    <p class="font-normal text-gray-700 dark:text-gray-400"></p>
                </div>
                @endforeach
            </div>
            <div id="contrato_enviado" data-value="7" class="dropzone w-1/4 p-4" ondrop="drop(event, 'contrato_enviado')"
                ondragover="allowDrop(event)">
                <h2 class="text-lg font-medium mb-4">Contrato enviado</h2>
                @foreach($leads_contrato_enviado as $lead)
                <div id="card_{{ $lead->id }}"
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-4 cursor-move"
                    draggable="true" ondragstart="drag(event, 'card_{{ $lead->id }}')">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $lead->razao_social }}</h2>
                    <p class="font-normal text-gray-700 dark:text-gray-400"></p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
@vite(['resources/js/alerta.js', 'resources/js/kanban.js'])
