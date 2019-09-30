<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('orderlists', function (Blueprint $table) {
            	
            $table->unsignedInteger('id');
            $table->unsignedInteger('item_Id');
            $table->primary(['id', 'item_Id']);
            $table->unsignedInteger('orderQuantity');
            $table->unsignedInteger('customer_Id');
            $table->boolean('isDelivered')->default(false);
            $table->foreign('customer_Id')->references('id')->on('users');
            $table->foreign('item_Id')->references('id')->on('items');
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
        Schema::dropIfExists('orderlists');
    }
}
