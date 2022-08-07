<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desafiocrcs', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('nome');
            $table->string('email');
            $table->string('cpf');
            $table->string('cnpj');
            $table->string('telefone');
            $table->text('texto');
            $table->date('updated_at');
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
