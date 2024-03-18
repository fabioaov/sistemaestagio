<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('modulo')->after('remember_token')->comment('1 - Menu de administração; 2 - Menu de unidade; 3 - Menu de empresa; 4 - Menu de estudante');
            $table->boolean('status')->after('modulo')->default(1)->comment('1 - Ativo; 2 - Inativo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('modulo');
            $table->dropColumn('status');
        });
    }
};
