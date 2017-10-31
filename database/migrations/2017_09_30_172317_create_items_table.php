<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            $table->string('name')->nullable();
            $table->float('amount')->nullable();
            $table->string('unit')->nullable();
            $table->float('price')->nullable();
            $table->float('vat')->nullable();
            $table->float('vat_value')->nullable();
            $table->float('net_value')->nullable();
            $table->float('gross_value')->nullable();
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
        Schema::dropIfExists('items');
    }
}
