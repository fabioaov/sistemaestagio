<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Obter os atributos personalizados para os campos do formulário.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'cnpj' => 'CNPJ',
            'razao_social' => 'RAZÃO SOCIAL',
            'nome_fantasia' => 'NOME FANTASIA',
            'cep' => 'CEP',
            'logradouro' => 'LOGRADOURO',
            'estado' => 'ESTADO',
            'cidade' => 'CIDADE',
            'ponto_referencia' => 'PONTO DE REFERÊNCIA',
            'email' => 'E-MAIL',
            'telefone' => 'TELEFONE',
            'representante' => 'REPRESENTANTE',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cnpj' => 'size:18|nullable|required_without_all:razao_social,nome_fantasia,cep,logradouro,ponto_referencia,email,telefone,representante',
            'razao_social' => 'max:100|nullable|required_without_all:cnpj,nome_fantasia,cep,logradouro,ponto_referencia,email,telefone,representante',
            'nome_fantasia' => 'max:100|nullable|required_without_all:cnpj,razao_social,cep,logradouro,ponto_referencia,email,telefone,representante',
            'cep' => 'size:9|nullable|required_without_all:cnpj,razao_social,nome_fantasia,logradouro,ponto_referencia,email,telefone,representante',
            'logradouro' => 'max:150|nullable|required_without_all:cnpj,razao_social,nome_fantasia,cep,ponto_referencia,email,telefone,representante',
            'estado' => 'exists:estados,id|nullable|required_with:logradouro,ponto_referencia',
            'cidade' => 'exists:cidades,id|nullable|required_with:estado',
            'ponto_referencia' => 'max:150|nullable|required_without_all:cnpj,razao_social,nome_fantasia,cep,logradouro,email,telefone,representante',
            'email' => 'max:50|nullable|required_without_all:cnpj,razao_social,nome_fantasia,cep,logradouro,ponto_referencia,telefone,representante',
            'telefone' => 'max:15|nullable|required_without_all:cnpj,razao_social,nome_fantasia,cep,logradouro,ponto_referencia,email,representante',
            'representante' => 'max:50|nullable|required_without_all:cnpj,razao_social,nome_fantasia,cep,logradouro,ponto_referencia,email,telefone',
        ];
    }
}
