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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');
            $table->string('slug');
            $table->longText('descripcion');

            $table->foreignId('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->nullable();
            
            $table->foreignId('subcategoria_id')->references('id')->on('subcategorias')->onDelete('cascade');
            
            $table->foreignId('emergencia_id')->references('id')->on('emergencias')->onDelete('cascade');

            $table->foreignId('statu_id')->default(1)->references('id')->on('status')->onDelete('cascade');

            // usuario que crea la incidencia
            $table->bigInteger('user_id')->nullable();

            //usuario que se le ha asignado la incidencia
            $table->foreignId('asignado_id')->nullable()/* ->references('idusuario')->on('users') */;
            
            //usuario que asigna la incidencia
            $table->foreignId('asigna_id')->nullable()/*->references('id')->on('users')*/;

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
        Schema::dropIfExists('incidencias');
    }
};
