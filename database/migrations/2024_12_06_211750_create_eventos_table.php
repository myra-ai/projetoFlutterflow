<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id(); // ID autoincrementado
            $table->string('title'); // Título do evento
            $table->dateTime('date'); // Data e hora do evento
            $table->string('image'); // URL da imagem do evento
            $table->text('details'); // Detalhes do evento
            $table->timestamps(); // Campos de 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}