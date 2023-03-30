<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name', 100)->comment('Nome do Usuário');
            $table->string('email', 100)->unique()->comment('Email do Usuário');
            $table->string('password', 150)->comment('Senha do Usuário');
            $table->string('cpf', 11)->unique()->comment('CPF do Usuário');
            $table->string('telephone', 50)->nullable()->comment('telefone do Usuário');
            $table->softDeletes()->comment('Registro deletado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
