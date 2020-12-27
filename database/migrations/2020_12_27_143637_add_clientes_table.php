<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('num_pedidos')->nullable()->after('parroquias_id');
            $table->decimal('gasto_bs', 5, 2)->nullable()->after('num_pedidos');
            $table->decimal('gasto_dolar', 5, 2)->nullable()->after('gasto_bs');
            $table->date('ultima_compra')->nullable()->after('gasto_dolar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
        });
    }
}
