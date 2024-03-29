<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->char('cnpj', 18)->unique()->nullable();
            $table->string('razao_social', 100)->nullable();
            $table->string('nome_fantasia', 100)->nullable();
            $table->char('cep', 9)->nullable();
            $table->string('logradouro', 150)->nullable();
            $table->foreignId('id_estado')->nullable()->constrained('estados');
            $table->foreignId('id_cidade')->nullable()->constrained('cidades');
            $table->string('ponto_referencia', 150)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('telefone', 15)->nullable();
            $table->string('representante', 50)->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 - Desativado; 1 - Novo; 2 - Interessado; 3 - Não interessado; 4 - Proposta; 5 - Negociação; 6 - Contrato');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
