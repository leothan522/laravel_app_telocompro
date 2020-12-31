<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('sku')->unique();
            $table->text('descripcion')->nullable();
            $table->bigInteger('categorias_id')->unsigned()->nullable();
            $table->decimal('precio', 12, 2)->nullable();
            $table->integer('cant_inventario')->nullable();
            $table->integer('cant_ventas')->nullable();
            $table->integer('poca_existencia')->nullable();
            $table->float('peso')->nullable();
            $table->string('und_peso')->default('Kg.');
            $table->integer('venta_individual')->default(0);
            $table->integer('max_carrito')->nullable();
            $table->string('file_path')->nullable();
            $table->string('imagen')->nullable();
            $table->integer('estado')->default(0);
            $table->integer('visibilidad')->default(0);
            $table->string('slug');
            $table->softDeletes();
            $table->foreign('categorias_id')->references('id')->on('categorias')->nullOnDelete();
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
        Schema::dropIfExists('productos');
    }
}
