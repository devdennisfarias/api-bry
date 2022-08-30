<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('endereco', 100);
            $table->string('cnpj', 14);
            $table->string('tipo', 100);
            $table->timestamps();
            
        });
                
        Schema::create('empresa_funcionario', function (Blueprint $table) {
            $table->foreignId('empresa_id')->constrained('empresas')->nullable();
            $table->foreignId('funcionario_id')->constrained('funcionarios')->nullable();
        });
        
        Schema::create('empresa_cliente', function (Blueprint $table) {
            $table->foreignId('empresa_id')->constrained('empresas')->nullable();
            $table->foreignId('cliente_id')->constrained('clientes')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_funcionario');
        Schema::dropIfExists('empresa_cliente');
        Schema::dropIfExists('empresas');
    }

}
