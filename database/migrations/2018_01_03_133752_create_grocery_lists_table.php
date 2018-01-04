<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroceryListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grocery_lists', function (Blueprint $table) {
        $table->increments('id');
	      $table->integer('product_id')->unsigned();
	      $table->integer('price');
	      $table->integer('quantity');
        $table->timestamps();

			  $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('product_groups');
		Schema::dropIfExists('product');
        Schema::dropIfExists('grocery_lists');
    }
}
