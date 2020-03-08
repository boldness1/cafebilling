<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Product_Category');
            $table->unsignedBigInteger('customer_id');
            $table->string('Product_Name');
            $table->string('Product_Description')->nullable();
            $table->string('Sauce1')->nullable();
            $table->string('Sauce2')->nullable();
            $table->string('Sauce3')->nullable();
            $table->string('Sauce4')->nullable();
            $table->string('Sauce5')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');;
            $table->float('Product_Prce');
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
        Schema::dropIfExists('baskets');
    }
}
