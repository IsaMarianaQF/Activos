<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialsTable extends Migration
{
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activo_id')->constrained()->onDelete('cascade');
            $table->json('cambios'); // Campo para almacenar los cambios realizados
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historials');
    }
}
