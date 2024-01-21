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
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('product_name');
                $table->text('product_price');
                $table->text('product_image_path');
                $table->text('product_description');
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
