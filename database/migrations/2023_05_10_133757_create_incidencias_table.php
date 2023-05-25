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
            $table->id()->comment('ID de la incidencia');

            $table->string('titulo')->comment('Título de la incidencia');
            $table->string('slug')->comment('Slug de la incidencia');
            $table->longText('descripcion')->comment('Descripción de la incidencia');

            $table->foreignId('categoria_id')->comment('ID que hace referencia a la tabla categorias')->references('id')->on('categorias')->onDelete('cascade')->nullable();
            
            $table->foreignId('subcategoria_id')->comment('ID que hace referencia a la tabla subcategorias')->references('id')->on('subcategorias')->onDelete('cascade');
            
            $table->foreignId('emergencia_id')->comment('ID que hace referencia a la tabla emergencias')->references('id')->on('emergencias')->onDelete('cascade');

            $table->foreignId('statu_id')->comment('ID que hace referencia a la tabla status')->default(1)->references('id')->on('status')->onDelete('cascade');

            // usuario que crea la incidencia
            $table->bigInteger('user_id')->nullable()->comment('ID del usuario que crea la incidencia');

            //usuario que se le ha asignado la incidencia
            $table->foreignId('asignado_id')->nullable()->comment('ID del usuario que se la ha asignado la incidencia')/* ->references('idusuario')->on('users') */;
            
            //usuario que asigna la incidencia
            $table->foreignId('asigna_id')->nullable()->comment('ID del usuario que asignó la incidencia')/*->references('id')->on('users')*/;

            $table->timestamps();
        });

        // Agregar comentarios a los campos de creación y actualización en PostgreSQL
        DB::statement('COMMENT ON COLUMN incidencias.created_at IS \'Fecha de creación\'');
        DB::statement('COMMENT ON COLUMN incidencias.updated_at IS \'Fecha de actualización\'');

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
