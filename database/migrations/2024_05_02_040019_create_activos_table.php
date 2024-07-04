<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->id();
            $table->string('sys',10)->unique();;
            $table->string('nombre',25);
            $table->string('modelo',30);
            $table->integer('atn');
            $table->string('marca',25);
            $table->string('serial',30);
            $table->string('codactivo',30);
            $table->string('estado',30);
            $table->string('usuario',30);
            $table->string('area',30);
            $table->string('ciudad',30);
            $table->string('sucursal',30);
            $table->string('observacion',50);
            
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
        Schema::dropIfExists('activos');
    }
}
