<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Leads > Interessados
            </h2>
        </div>
    </x-slot>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="relative overflow-x-auto">
            @if ($leads->isNotEmpty())
                <x-table :headers="['ID', 'CNPJ', 'Nome fantasia', 'E-mail', 'Telefone', 'Representante', 'Ações']">
                    @foreach ($leads as $lead)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $lead->id }}
                            </th>
                            <td>{{ $lead->cnpj }}</td>
                            <td>{{ $lead->nome_fantasia }}</td>
                            <td>{{ $lead->email }}</td>
                            <td>{{ $lead->telefone }}</td>
                            <td>{{ $lead->representante }}</td>
                            <td>
                                <x-button size="sm" data-dropdown-toggle="dropdown_{{ $lead->id }}"
                                    data-dropdown-placement="right-start">
                                    <x-heroicon-o-chevron-down class="w-6 h-6" aria-hidden="true" />
                                </x-button>
                            </td>
                        </tr>
                        <x-multi-dropdown :id="'dropdown_' . $lead->id">
                            <x-multi-dropdown-link data-dropdown-toggle="mover_dropdown_{{ $lead->id }}"
                                data-dropdown-placement="right-start" class="flex justify-between cursor-pointer">
                                Mover
                                <x-heroicon-o-chevron-right class="w-4 h-4" aria-hidden="true" />
                            </x-multi-dropdown-link>
                            <x-multi-dropdown-link data-drawer-target="drawer_comentarios_{{ $lead->id }}"
                                data-drawer-show="drawer_comentarios_{{ $lead->id }}"
                                data-drawer-placement="right">Ver comentários</x-multi-dropdown-link>
                            <x-multi-dropdown-link :href="route('leads.editar', $lead->id)">Editar</x-multi-dropdown-link>
                        </x-multi-dropdown>
                        <x-multi-dropdown :id="'mover_dropdown_' . $lead->id">
                            <x-multi-dropdown-link :href="route('leads.mover', ['id' => $lead->id, 'status' => 1])" data-titulo="Mover lead"
                                data-texto="Tem certeza que deseja mover este lead?" data-method="put">
                                Novos
                            </x-multi-dropdown-link>
                        </x-multi-dropdown>
                        <x-drawer :id="'drawer_comentarios_' . $lead->id">
                            <ol class="relative border-s border-gray-200 dark:border-gray-700">
                                @foreach ($lead->comentarios as $comentario)
                                    <li class="mb-10 ms-4">
                                        <div
                                            class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                                        </div>
                                        <time
                                            class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
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
                            {{-- TODO: Inserir comentário sem recarregar página --}}
                            <form method="POST" action="{{ route('comentarios.inserir', $lead->id) }}">
                                @csrf
                                <div class="grid gap-6">
                                    <div class="space-y-2">
                                        <x-form.label for="comentario" :value="'Inserir comentário'" />
                                        <x-form.textarea name="comentario" value="{{ old('comentario') }}"
                                            placeholder="Comentário" required></x-form.textarea>
                                    </div>
                                    <div class="space-y-2">
                                        <x-button class="justify-center w-full gap-2">
                                            <span>Salvar</span>
                                        </x-button>
                                    </div>
                                </div>
                            </form>
                        </x-drawer>
                    @endforeach
                </x-table>
                <div class="mt-6">
                    {{ $leads->links() }}
                </div>
            @else
                <p class="text-center">Nenhum lead interessado a ser exibido.</p>
            @endif
        </div>
    </div>
</x-app-layout>
@vite(['resources/js/alerta.js'])
