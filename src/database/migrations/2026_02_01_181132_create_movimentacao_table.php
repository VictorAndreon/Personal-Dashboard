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
        Schema::create('movimentacao', function (Blueprint $table) {
            $table->id('cd_movimentacao');
            $table->foreignId('cd_categoria')->constrained('movimentacao_categoria', 'cd_categoria');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Dono do dinheiro
            $table->string('descricao'); // Ex: Salário, Aluguel
            $table->decimal('qtd_valor', 10, 2); // Valor (10 dígitos, 2 decimais). 
            $table->enum('tipo_movimentacao',['entrada', 'saida']); // 'entrada' ou 'saida'
            $table->date('dt_transacao'); // Data da transação
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacao');
    }
};
