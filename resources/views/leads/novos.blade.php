<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Leads > Novos
            </h2>
        </div>
    </x-slot>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="grid">
            <x-button href="{{ route('leads.cadastrar') }}" class="justify-self-end max-w-xs mb-6">
                <span>Cadastrar novo lead</span>
            </x-button>
        </div>
        <div class="relative overflow-x-auto">
            @if ($leads->isNotEmpty())
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">CNPJ</th>
                            <th scope="col" class="px-6 py-3">Nome Fantasia</th>
                            <th scope="col" class="px-6 py-3">E-mail</th>
                            <th scope="col" class="px-6 py-3">Telefone</th>
                            <th scope="col" class="px-6 py-3">Representante</th>
                            <th scope="col" class="px-6 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leads as $lead)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $lead->id }}
                                </th>
                                <td class="px-6 py-4">{{ $lead->cnpj }}</td>
                                <td class="px-6 py-4">{{ $lead->nome_fantasia }}</td>
                                <td class="px-6 py-4">{{ $lead->email }}</td>
                                <td class="px-6 py-4">{{ $lead->telefone }}</td>
                                <td class="px-6 py-4">{{ $lead->representante }}</td>
                                <td class="px-6 py-4">
                                    <x-button size="sm" data-dropdown-toggle="dropdown_{{ $lead->id }}"
                                        data-dropdown-placement="right-start">
                                        <x-heroicon-o-chevron-down class="w-6 h-6" aria-hidden="true" />
                                    </x-button>
                                </td>
                            </tr>
                            <div id="dropdown_{{ $lead->id }}"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                    <li>
                                        <button data-dropdown-toggle="mover_dropdown_{{ $lead->id }}"
                                            data-dropdown-placement="right-start" type="button"
                                            class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Mover <x-heroicon-o-chevron-right class="w-4 h-4" aria-hidden="true" />
                                        </button>
                                        <div id="mover_dropdown_{{ $lead->id }}"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="doubleDropdownButton">
                                                <li>
                                                    {{-- TODO: Criar alerta de confirmação --}}
                                                    <form method="POST"
                                                        action="{{ route('leads.mover', ['id' => $lead->id, 'status' => 2]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">Interessados</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{ route('leads.editar', $lead->id) }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editar</a>
                                    </li>
                                    <li>
                                        {{-- TODO: Criar alerta de confirmação --}}
                                        <form method="POST" action="{{ route('leads.excluir', $lead->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">Excluir</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $leads->links() }}
                </div>
            @else
                <p class="text-center">Nenhum lead novo a ser exibido.</p>
            @endif
        </div>
    </div>
</x-app-layout>
