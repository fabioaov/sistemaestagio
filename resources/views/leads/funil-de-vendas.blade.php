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
        <div id="kanban_funil_de_vendas">
        </div>
    </div>
    <script src="{{ asset('js/jkanban.min.js') }}"></script>
    <script>
        const kanban = new jKanban({
            element: "#kanban_funil_de_vendas",
            responsivePercentage: true,
            boards: [{
                    id: "aguardando_proposta",
                    title: '<h5 class="text-base font-semibold text-gray-900 md:text-xl dark:text-white">Aguardando proposta</h5>',
                    item: [
                        @foreach ($leads_aguardando_proposta as $lead)
                            {
                                id: "{{ $lead->id }}",
                                title: `
                                    <div class="flex justify-end px-4 pt-4">
                                        <x-button size="sm" data-dropdown-toggle="dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="mb-4">
                                            <x-heroicon-o-chevron-down class="h-6 w-6" aria-hidden="true" />
                                        </x-button>
                                        <x-multi-dropdown :id="'dropdown_' . $lead->id">
                                            <x-multi-dropdown-link data-dropdown-toggle="mover_dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="flex cursor-pointer justify-between">
                                                Mover
                                                <x-heroicon-o-chevron-right class="h-4 w-4" aria-hidden="true" />
                                            </x-multi-dropdown-link>
                                            <x-multi-dropdown-link data-drawer-target="drawer_comentarios_{{ $lead->id }}" data-drawer-show="drawer_comentarios_{{ $lead->id }}" data-drawer-placement="right">Ver comentários</x-multi-dropdown-link>
                                            <x-multi-dropdown-link :href="route('leads.editar', $lead->id)">Editar</x-multi-dropdown-link>
                                        </x-multi-dropdown>
                                        <x-multi-dropdown :id="'mover_dropdown_'. $lead->id">
                                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 2])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                                Interessados
                                            </x-multi-dropdown-link>
                                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 3])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                                Não interessados
                                            </x-multi-dropdown-link>
                                        </x-multi-dropdown>
                                        <x-drawer :id="'drawer_comentarios_' . $lead->id" class="exibe-drawer">
                                            <ol class="relative border-s border-gray-200 dark:border-gray-700">
                                                @foreach ($lead->comentarios as $comentario)
                                                    <li class="mb-10 ms-4">
                                                        <div class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"></div>
                                                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                            {{ $comentario->created_at->format('d/m/Y H:i:s') }}
                                                        </time>
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                            {{ $comentario->user->name }}
                                                        </h3>
                                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                                            {{ $comentario->comentario }}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            <form method="POST" action="{{ route('comentarios.inserir', $lead->id) }}">
                                                @csrf
                                                <div class="grid gap-6">
                                                    <div class="space-y-2">
                                                        <x-form.label for="comentario" :value="'Inserir comentário'" />
                                                        <x-form.textarea name="comentario" value="{{ old('comentario') }}" placeholder="Comentário" required></x-form.textarea>
                                                    </div>
                                                    <div class="space-y-2">
                                                        <x-button class="w-full justify-center gap-2">
                                                            <span>Salvar</span>
                                                        </x-button>
                                                    </div>
                                                </div>
                                            </form>
                                        </x-drawer>
                                    </div>
                                    <div class="flex flex-col items-center pb-4">
                                        <h5 class="mb-1 text-lg font-medium text-gray-900 dark:text-white text-center">{{ $lead->razao_social }}</h5>
                                        <h5 class="mb-1 text-md font-medium text-gray-900 dark:text-white text-center">{{ $lead->nome_fantasia }}</h5>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $lead->cnpj }}</span>
                                        <div class="flex mt-4 md:mt-6">
                                           <x-button class="sm">Enviar proposta</x-button>
                                        </div>
                                    </div>
                                `,
                            },
                        @endforeach
                    ],
                },
                {
                    id: "proposta_enviada",
                    title: '<h5 class="text-base font-semibold text-gray-900 md:text-xl dark:text-white">Proposta enviada</h5>',
                    item: [
                        @foreach ($leads_proposta_enviada as $lead)
                            {
                                id: "{{ $lead->id }}",
                                title: `
                                    <div class="flex justify-end px-4 pt-4">
                                        <x-button size="sm" data-dropdown-toggle="dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="mb-4">
                                            <x-heroicon-o-chevron-down class="h-6 w-6" aria-hidden="true" />
                                        </x-button>
                                        <x-multi-dropdown :id="'dropdown_' . $lead->id">
                                            <x-multi-dropdown-link data-dropdown-toggle="mover_dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="flex cursor-pointer justify-between">
                                                Mover
                                                <x-heroicon-o-chevron-right class="h-4 w-4" aria-hidden="true" />
                                            </x-multi-dropdown-link>
                                            <x-multi-dropdown-link data-drawer-target="drawer_comentarios_{{ $lead->id }}" data-drawer-show="drawer_comentarios_{{ $lead->id }}" data-drawer-placement="right">Ver comentários</x-multi-dropdown-link>
                                            <x-multi-dropdown-link :href="route('leads.editar', $lead->id)">Editar</x-multi-dropdown-link>
                                        </x-multi-dropdown>
                                        <x-multi-dropdown :id="'mover_dropdown_'. $lead->id">
                                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 2])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                                Interessados
                                            </x-multi-dropdown-link>
                                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 3])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                                Não interessados
                                            </x-multi-dropdown-link>
                                        </x-multi-dropdown>
                                        <x-drawer :id="'drawer_comentarios_' . $lead->id" class="exibe-drawer">
                                            <ol class="relative border-s border-gray-200 dark:border-gray-700">
                                                @foreach ($lead->comentarios as $comentario)
                                                    <li class="mb-10 ms-4">
                                                        <div class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"></div>
                                                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                            {{ $comentario->created_at->format('d/m/Y H:i:s') }}
                                                        </time>
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                            {{ $comentario->user->name }}
                                                        </h3>
                                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                                            {{ $comentario->comentario }}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            <form method="POST" action="{{ route('comentarios.inserir', $lead->id) }}">
                                                @csrf
                                                <div class="grid gap-6">
                                                    <div class="space-y-2">
                                                        <x-form.label for="comentario" :value="'Inserir comentário'" />
                                                        <x-form.textarea name="comentario" value="{{ old('comentario') }}" placeholder="Comentário" required></x-form.textarea>
                                                    </div>
                                                    <div class="space-y-2">
                                                        <x-button class="w-full justify-center gap-2">
                                                            <span>Salvar</span>
                                                        </x-button>
                                                    </div>
                                                </div>
                                            </form>
                                        </x-drawer>
                                    </div>
                                    <div class="flex flex-col items-center pb-4">
                                        <h5 class="mb-1 text-lg font-medium text-gray-900 dark:text-white text-center">{{ $lead->razao_social }}</h5>
                                        <h5 class="mb-1 text-md font-medium text-gray-900 dark:text-white text-center">{{ $lead->nome_fantasia }}</h5>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $lead->cnpj }}</span>
                                    </div>
                                `,
                            },
                        @endforeach
                    ],
                },
                {
                    id: "aguardando_contrato",
                    title: '<h5 class="text-base font-semibold text-gray-900 md:text-xl dark:text-white">Aguardando contrato</h5>',
                    item: [
                        @foreach ($leads_aguardando_contrato as $lead)
                            {
                                id: "{{ $lead->id }}",
                                title: `
                                    <div class="flex justify-end px-4 pt-4">
                                        <x-button size="sm" data-dropdown-toggle="dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="mb-4">
                                            <x-heroicon-o-chevron-down class="h-6 w-6" aria-hidden="true" />
                                        </x-button>
                                        <x-multi-dropdown :id="'dropdown_' . $lead->id">
                                            <x-multi-dropdown-link data-dropdown-toggle="mover_dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="flex cursor-pointer justify-between">
                                                Mover
                                                <x-heroicon-o-chevron-right class="h-4 w-4" aria-hidden="true" />
                                            </x-multi-dropdown-link>
                                            <x-multi-dropdown-link data-drawer-target="drawer_comentarios_{{ $lead->id }}" data-drawer-show="drawer_comentarios_{{ $lead->id }}" data-drawer-placement="right">Ver comentários</x-multi-dropdown-link>
                                            <x-multi-dropdown-link :href="route('leads.editar', $lead->id)">Editar</x-multi-dropdown-link>
                                        </x-multi-dropdown>
                                        <x-multi-dropdown :id="'mover_dropdown_'. $lead->id">
                                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 2])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                                Interessados
                                            </x-multi-dropdown-link>
                                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 3])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                                Não interessados
                                            </x-multi-dropdown-link>
                                        </x-multi-dropdown>
                                        <x-drawer :id="'drawer_comentarios_' . $lead->id" class="exibe-drawer">
                                            <ol class="relative border-s border-gray-200 dark:border-gray-700">
                                                @foreach ($lead->comentarios as $comentario)
                                                    <li class="mb-10 ms-4">
                                                        <div class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"></div>
                                                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                            {{ $comentario->created_at->format('d/m/Y H:i:s') }}
                                                        </time>
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                            {{ $comentario->user->name }}
                                                        </h3>
                                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                                            {{ $comentario->comentario }}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            <form method="POST" action="{{ route('comentarios.inserir', $lead->id) }}">
                                                @csrf
                                                <div class="grid gap-6">
                                                    <div class="space-y-2">
                                                        <x-form.label for="comentario" :value="'Inserir comentário'" />
                                                        <x-form.textarea name="comentario" value="{{ old('comentario') }}" placeholder="Comentário" required></x-form.textarea>
                                                    </div>
                                                    <div class="space-y-2">
                                                        <x-button class="w-full justify-center gap-2">
                                                            <span>Salvar</span>
                                                        </x-button>
                                                    </div>
                                                </div>
                                            </form>
                                        </x-drawer>
                                    </div>
                                    <div class="flex flex-col items-center pb-4">
                                        <h5 class="mb-1 text-lg font-medium text-gray-900 dark:text-white text-center">{{ $lead->razao_social }}</h5>
                                        <h5 class="mb-1 text-md font-medium text-gray-900 dark:text-white text-center">{{ $lead->nome_fantasia }}</h5>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $lead->cnpj }}</span>
                                        <div class="flex mt-4 md:mt-6">
                                           <x-button class="sm">Enviar contrato</x-button>
                                        </div>
                                    </div>
                                `,
                            },
                        @endforeach
                    ],
                },
                {
                    id: "contrato_enviado",
                    title: '<h5 class="text-base font-semibold text-gray-900 md:text-xl dark:text-white">Contrato enviado</h5>',
                    item: [
                        @foreach ($leads_contrato_enviado as $lead)
                            {
                                id: "{{ $lead->id }}",
                                title: `
                                    <div class="flex justify-end px-4 pt-4">
                                        <x-button size="sm" data-dropdown-toggle="dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="mb-4">
                                            <x-heroicon-o-chevron-down class="h-6 w-6" aria-hidden="true" />
                                        </x-button>
                                        <x-multi-dropdown :id="'dropdown_' . $lead->id">
                                            <x-multi-dropdown-link data-dropdown-toggle="mover_dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="flex cursor-pointer justify-between">
                                                Mover
                                                <x-heroicon-o-chevron-right class="h-4 w-4" aria-hidden="true" />
                                            </x-multi-dropdown-link>
                                            <x-multi-dropdown-link data-drawer-target="drawer_comentarios_{{ $lead->id }}" data-drawer-show="drawer_comentarios_{{ $lead->id }}" data-drawer-placement="right">Ver comentários</x-multi-dropdown-link>
                                            <x-multi-dropdown-link :href="route('leads.editar', $lead->id)">Editar</x-multi-dropdown-link>
                                        </x-multi-dropdown>
                                        <x-multi-dropdown :id="'mover_dropdown_'. $lead->id">
                                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 2])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                                Interessados
                                            </x-multi-dropdown-link>
                                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 3])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                                Não interessados
                                            </x-multi-dropdown-link>
                                        </x-multi-dropdown>
                                        <x-drawer :id="'drawer_comentarios_' . $lead->id" class="exibe-drawer">
                                            <ol class="relative border-s border-gray-200 dark:border-gray-700">
                                                @foreach ($lead->comentarios as $comentario)
                                                    <li class="mb-10 ms-4">
                                                        <div class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"></div>
                                                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                            {{ $comentario->created_at->format('d/m/Y H:i:s') }}
                                                        </time>
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                            {{ $comentario->user->name }}
                                                        </h3>
                                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                                            {{ $comentario->comentario }}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            <form method="POST" action="{{ route('comentarios.inserir', $lead->id) }}">
                                                @csrf
                                                <div class="grid gap-6">
                                                    <div class="space-y-2">
                                                        <x-form.label for="comentario" :value="'Inserir comentário'" />
                                                        <x-form.textarea name="comentario" value="{{ old('comentario') }}" placeholder="Comentário" required></x-form.textarea>
                                                    </div>
                                                    <div class="space-y-2">
                                                        <x-button class="w-full justify-center gap-2">
                                                            <span>Salvar</span>
                                                        </x-button>
                                                    </div>
                                                </div>
                                            </form>
                                        </x-drawer>
                                    </div>
                                    <div class="flex flex-col items-center pb-4">
                                        <h5 class="mb-1 text-lg font-medium text-gray-900 dark:text-white text-center">{{ $lead->razao_social }}</h5>
                                        <h5 class="mb-1 text-md font-medium text-gray-900 dark:text-white text-center">{{ $lead->nome_fantasia }}</h5>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $lead->cnpj }}</span>
                                        <div class="flex mt-4 md:mt-6">
                                           <x-button class="sm">Finalizar</x-button>
                                        </div>
                                    </div>
                                `,
                            },
                        @endforeach
                    ],
                },
            ],
            dragBoards: false,
            click: function(el) {
                var drawers = document.querySelectorAll('.drawer');
                drawers.forEach(drawer => {
                    drawer.classList.remove('hidden');
                });
            },
            dragEl: function(el) {
                var drawers = document.querySelectorAll('.drawer');
                drawers.forEach(drawer => {
                    drawer.classList.add('hidden');
                });
            },
            dropEl: function(el, target, source, sibling) {
                let idItem = el.dataset.eid;
                let idQuadro = target.parentElement.dataset.id;
                let status;
                switch (idQuadro) {
                    case "aguardando_proposta":
                        status = 4;
                        break;
                    case "proposta_enviada":
                        status = 5;
                        break;
                    case "aguardando_contrato":
                        status = 6;
                        break;
                    case "contrato_enviado":
                        status = 7;
                        break;
                }
                let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                let xhr = new XMLHttpRequest();
                xhr.open('POST', `/leads/${idItem}/mover/${status}`);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT');
                xhr.send();
            },
        });
        document.querySelectorAll(".kanban-board").forEach(function(board) {
            board.classList.add("w-full", "max-w-sm", "bg-white", "rounded-lg", "shadow", "dark:bg-gray-800");
        });
        document.querySelectorAll(".kanban-item").forEach(function(item) {
            item.classList.add("w-full", "max-w-sm", "rounded-lg", "shadow", "dark:bg-gray-600", "dark:border-gray-500");
        });
        window.addEventListener('DOMContentLoaded', function() {
            var drawers = document.querySelectorAll('.drawer');
            drawers.forEach(drawer => {
                drawer.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
@vite(['resources/js/alerta.js'])
