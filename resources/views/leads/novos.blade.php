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
            <x-button href="{{ route('leads.form') }}" class="justify-self-end max-w-xs mb-6">
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
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <x-button size="sm">
                                                <x-heroicon-o-chevron-down class="w-6 h-6" aria-hidden="true" />
                                            </x-button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('leads.show', $lead->id)">Editar</x-dropdown-link>
                                            <x-dropdown-link :href="route('leads.destroy', $lead->id)"
                                                data-confirm-delete="true">Excluir</x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </td>
                            </tr>
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
