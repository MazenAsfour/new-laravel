<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ConfigOption;
use Illuminate\Support\Facades\Hash;
class AddPointsPasswordToConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ConfigOption::create([
            "option_name"=>"points_password",
            "option_value"=>Hash::make("123456789")
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config', function (Blueprint $table) {
            //
        });
    }
}