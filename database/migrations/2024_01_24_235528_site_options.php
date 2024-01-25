<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ConfigOption;
class SiteOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_options', function (Blueprint $table) {
            $table->id();
            $table->string('option_name');
            $table->text('option_value')->nullable();;;
            $table->timestamps();
        });
        ConfigOption::create([
            "option_name"=>"logo",
            "option_value"=>"/newtheme/img/1600w-9Gfim1S8fHg-removebg-previewas.png"
        ]);
        ConfigOption::create([
            "option_name"=>"restaurant_name",
            "option_value"=>"Restaurant"
        ]);
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
