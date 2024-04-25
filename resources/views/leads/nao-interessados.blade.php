<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Leads > Não interessados
            </h2>
        </div>
    </x-slot>
    <div class="overflow-hidden rounded-md bg-white p-6 shadow-md dark:bg-dark-eval-1">
        <div class="relative overflow-x-auto">
            @if ($leads->isNotEmpty())
                <x-table :headers="['ID', 'CNPJ', 'Nome fantasia', 'Razão social', 'E-mail', 'Telefone', 'Representante', 'Responsável', 'Ações']">
                    @foreach ($leads as $lead)
                        <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                            <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $lead->id }}
                            </th>
                            <td>{{ $lead->cnpj }}</td>
                            <td>{{ $lead->nome_fantasia }}</td>
                            <td>{{ $lead->razao_social }}</td>
                            <td>{{ $lead->email }}</td>
                            <td>{{ $lead->telefone }}</td>
                            <td>{{ $lead->representante }}</td>
                            <td>{{ $lead->user ? $lead->user->name : '' }}</td>
                            <td>
                                <x-button size="sm" data-dropdown-toggle="dropdown_{{ $lead->id }}" data-dropdown-placement="right-start">
                                    <x-heroicon-o-chevron-down class="h-6 w-6" aria-hidden="true" />
                                </x-button>
                            </td>
                        </tr>
                        <x-multi-dropdown :id="'dropdown_' . $lead->id">
                            <x-multi-dropdown-link data-dropdown-toggle="mover_dropdown_{{ $lead->id }}" data-dropdown-placement="right-start" class="flex cursor-pointer justify-between">
                                Mover
                                <x-heroicon-o-chevron-right class="h-4 w-4" aria-hidden="true" />
                            </x-multi-dropdown-link>
                            <x-multi-dropdown-link data-drawer-target="drawer_comentarios_{{ $lead->id }}" data-drawer-show="drawer_comentarios_{{ $lead->id }}" data-drawer-placement="right">Ver comentários</x-multi-dropdown-link>
                        </x-multi-dropdown>
                        <x-multi-dropdown :id="'mover_dropdown_' . $lead->id">
                            <x-multi-dropdown-link :href="route('leads.mover', ['idLead' => $lead->id, 'status' => 2])" data-titulo="Mover lead" data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                Interessados
                            </x-multi-dropdown-link>
                        </x-multi-dropdown>
                        <x-drawer :id="'drawer_comentarios_' . $lead->id">
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
                        </x-drawer>
                    @endforeach
                </x-table>
                <div class="mt-6">
                    {{ $leads->links() }}
                </div>
            @else
                <p class="text-center">Nenhum lead não interessado a ser exibido.</p>
            @endif
        </div>
    </div>
</x-app-layout>
@vite(['resources/js/alerta.js'])
