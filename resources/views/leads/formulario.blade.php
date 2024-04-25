<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Leads > {{ isset($lead->id) ? 'Editar' : 'Cadastrar' }} lead
            </h2>
        </div>
    </x-slot>
    <div class="overflow-hidden rounded-md bg-white p-6 shadow-md dark:bg-dark-eval-1">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('leads.salvar') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $lead->id ?? '' }}" />
            <div class="grid grid-cols-4 gap-6">
                <!-- CNPJ -->
                <div class="col-span-4 space-y-2">
                    <x-form.label for="cnpj" :value="'CNPJ'" />
                    <x-form.input class="cnpj block w-full" type="text" name="cnpj" value="{{ isset($lead->cnpj) ? $lead->cnpj : old('cnpj') }}" autofocus placeholder="CNPJ" />
                </div>
                <!-- Razão social -->
                <div class="col-span-4 space-y-2">
                    <x-form.label for="razao_social" :value="'Razão social'" />
                    <x-form.input class="block w-full" type="text" name="razao_social" value="{{ isset($lead->razao_social) ? $lead->razao_social : old('razao_social') }}" autofocus placeholder="Razão social" maxlength="100" />
                </div>
                <!-- Nome fantasia -->
                <div class="col-span-4 space-y-2">
                    <x-form.label for="nome_fantasia" :value="'Nome fantasia'" />
                    <x-form.input class="block w-full" type="text" name="nome_fantasia" value="{{ isset($lead->nome_fantasia) ? $lead->nome_fantasia : old('nome_fantasia') }}" autofocus placeholder="Nome fantasia" maxlength="100" />
                </div>
                <!-- CEP -->
                <div class="col-span-1 space-y-2">
                    <x-form.label for="cep" :value="'CEP'" />
                    <x-form.input class="cep block w-full" type="text" name="cep" id="cep" value="{{ isset($lead->cep) ? $lead->cep : old('cep') }}" autofocus placeholder="CEP" onblur="consultarCep(this.value);" />
                </div>
                <!-- Logradouro -->
                <div class="col-span-3 space-y-2">
                    <x-form.label for="logradouro" :value="'Logradouro'" />
                    <x-form.input class="block w-full" type="text" name="logradouro" id="logradouro" value="{{ isset($lead->logradouro) ? $lead->logradouro : old('logradouro') }}" autofocus placeholder="Logradouro" maxlength="150" />
                </div>
                <!-- Estado -->
                <div class="col-span-2 space-y-2">
                    <x-form.label for="estado" :value="'Estado'" />
                    <x-form.select class="block w-full" name="estado" id="estado" autofocus onchange="buscarCidadesPorIdEstado(this.value);">
                        <option value="">Selecione</option>
                        @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}" {{ (isset($lead) && $lead->id_estado == $estado->id) || old('estado') == $estado->id ? 'selected' : '' }}>
                                {{ $estado->nome }}
                            </option>
                        @endforeach
                    </x-form.select>
                </div>
                <!-- Cidade -->
                <div class="col-span-2 space-y-2">
                    <x-form.label for="cidade" :value="'Cidade'" />
                    <x-form.select class="block w-full" name="cidade" id="cidade" autofocus>
                        <option value="">Selecione um estado</option>
                    </x-form.select>
                    <input type="hidden" id="id_cidade" value="{{ isset($lead->id_cidade) ? $lead->id_cidade : old('id_cidade') }}" />
                </div>
                <!-- Ponto de referência -->
                <div class="col-span-4 space-y-2">
                    <x-form.label for="ponto_referencia" :value="'Ponto de referência'" />
                    <x-form.input class="block w-full" type="text" name="ponto_referencia" value="{{ isset($lead->ponto_referencia) ? $lead->ponto_referencia : old('ponto_referencia') }}" autofocus placeholder="Ponto de referência"
                        maxlength="150" />
                </div>
                <!-- E-mail -->
                <div class="col-span-2 space-y-2">
                    <x-form.label for="email" :value="'E-mail'" />
                    <x-form.input class="block w-full" type="email" name="email" value="{{ isset($lead->email) ? $lead->email : old('email') }}" autofocus placeholder="E-mail" maxlength="50" />
                </div>
                <!-- Celular / telefone -->
                <div class="col-span-2 space-y-2">
                    <x-form.label for="telefone" :value="'Celular / telefone'" />
                    <x-form.input class="telefone block w-full" type="text" name="telefone" value="{{ isset($lead->telefone) ? $lead->telefone : old('telefone') }}" autofocus placeholder="Celular / telefone" />
                </div>
                <!-- Representante -->
                <div class="col-span-4 space-y-2">
                    <x-form.label for="representante" :value="'Representante'" />
                    <x-form.input class="block w-full" type="text" name="representante" value="{{ isset($lead->representante) ? $lead->representante : old('representante') }}" autofocus placeholder="Representante" maxlength="50" />
                </div>
                <div class="col-span-4 space-y-2">
                    <x-button class="w-full justify-center gap-2">
                        <span>Salvar</span>
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
@vite(['resources/js/mascara.js', 'resources/js/endereco.js'])
