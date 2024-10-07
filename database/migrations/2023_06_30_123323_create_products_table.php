<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->bigIncrements('id');


        $table->unsignedBigInteger('product_creator')->nullable();
        $table->foreign('product_creator')->references('id')->on('users')->onDelete('cascade');

        $table->unsignedBigInteger('category_id');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        $table->string('name');
        $table->text('description');
        $table->string('path')->nullable();
        $table->decimal('price' , 6 , 2 );
        //update
        //this attribute can take(in well condition,roughly used, bad condition..etc)
        $table->string('condition');
        //Status of products determine wether the product is or not available
        //in the market
        $table->string('status')->default('pending');
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
        //
    }
}
