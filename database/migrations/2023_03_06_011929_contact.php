<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        try {
            Schema::create('contact', function (Blueprint $table) {
                $table->id();
                $table->string('user_name');
                $table->text('user_email');
                $table->text('user_message');
                $table->boolean('is_read');
                $table->boolean('replayed');
                $table->timestamps();
            });

        DB::commit();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            DB::rollBack();
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
