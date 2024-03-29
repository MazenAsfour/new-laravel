<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::dropIfExists('products');

            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->float('price');
                $table->text('description');
                $table->text('image_path');
                $table->unsignedBigInteger('category_id'); 
                $table->foreign('category_id')->references('id')->on('categories');
                $table->timestamps();
            });
            
        } catch (\Throwable $th) {
        }
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
