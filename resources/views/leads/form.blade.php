<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Leads > Cadastrar novo lead
            </h2>
        </div>
    </x-slot>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('leads.store') }}">
            @csrf
            <div class="grid gap-6 grid-cols-4">
                <!-- CNPJ -->
                <div class="space-y-2 col-span-4">
                    <x-form.label for="cnpj" :value="'CNPJ'" />
                    <x-form.input class="block w-full cnpj" type="text" name="cnpj" :value="old('cnpj')" autofocus
                        placeholder="CNPJ" />
                </div>
                <!-- Razão social -->
                <div class="space-y-2 col-span-4">
                    <x-form.label for="razao_social" :value="'Razão social'" />
                    <x-form.input class="block w-full" type="text" name="razao_social" :value="old('razao_social')" autofocus
                        placeholder="Razão social" maxlength="100" />
                </div>
                <!-- Nome fantasia -->
                <div class="space-y-2 col-span-4">
                    <x-form.label for="nome_fantasia" :value="'Nome fantasia'" />
                    <x-form.input class="block w-full" type="text" name="nome_fantasia" :value="old('nome_fantasia')" autofocus
                        placeholder="Nome fantasia" maxlength="100" />
                </div>
                <!-- CEP -->
                <div class="space-y-2 col-span-1">
                    <x-form.label for="cep" :value="'CEP'" />
                    <x-form.input class="block w-full cep" type="text" name="cep" id="cep"
                        :value="old('cep')" autofocus placeholder="CEP" />
                </div>
                <!-- Logradouro -->
                <div class="space-y-2 col-span-3">
                    <x-form.label for="logradouro" :value="'Logradouro'" />
                    <x-form.input class="block w-full" type="text" name="logradouro" id="logradouro"
                        :value="old('logradouro')" autofocus placeholder="Logradouro" maxlength="150" />
                </div>
                <!-- Estado -->
                <div class="space-y-2 col-span-2">
                    <x-form.label for="estado" :value="'Estado'" />
                    <x-form.select class="block w-full" name="estado" id="estado" autofocus>
                        <option value="">Selecione</option>
                        @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}" @selected(old('estado') == $estado->id)>
                                {{ $estado->nome }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
                <!-- Cidade -->
                <div class="space-y-2 col-span-2">
                    <x-form.label for="cidade" :value="'Cidade'" />
                    <x-form.select class="block w-full" name="cidade" id="cidade" autofocus>
                        <option value="">Selecione um estado</option>
                    </x-form.select>
                </div>
                <!-- Ponto de referência -->
                <div class="space-y-2 col-span-4">
                    <x-form.label for="ponto_referencia" :value="'Ponto de referência'" />
                    <x-form.input class="block w-full" type="text" name="ponto_referencia" :value="old('ponto_referencia')"
                        autofocus placeholder="Ponto de referência" maxlength="150" />
                </div>
                <!-- E-mail -->
                <div class="space-y-2 col-span-2">
                    <x-form.label for="email" :value="'E-mail'" />
                    <x-form.input class="block w-full" type="email" name="email" :value="old('email')" autofocus
                        placeholder="E-mail" maxlength="50" />
                </div>
                <!-- Celular / telefone -->
                <div class="space-y-2 col-span-2">
                    <x-form.label for="telefone" :value="'Celular / telefone'" />
                    <x-form.input class="block w-full telefone" type="text" name="telefone" :value="old('telefone')"
                        autofocus placeholder="Celular / telefone" />
                </div>
                <!-- Representante -->
                <div class="space-y-2 col-span-4">
                    <x-form.label for="representante" :value="'Representante'" />
                    <x-form.input class="block w-full" type="text" name="representante" :value="old('representante')" autofocus
                        placeholder="Representante" maxlength="50" />
                </div>
                <div class="space-y-2 col-span-4">
                    <x-button class="justify-center w-full gap-2">
                        <span>Cadastrar</span>
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
@vite(['resources/js/masks.js', 'resources/js/endereco.js'])
