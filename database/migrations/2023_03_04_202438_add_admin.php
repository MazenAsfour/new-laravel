<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;
use App\Models\User;
use App\Models\UserData;
class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user= new User;
        $user= User::create([
            'name' => "Admin",
            'email' => "Admin@mailinator.com",
            'email_verified_at'=>now(),
            'password' => Hash::make("admin@123"),
        ]);
        UserData::create([
            'user_id'=>$user->id,
            'image_path' => '/images/computer-icons-user-profile-google-account-photos-icon-account.jpg',
            'about_user' => 'Hello I Am Using E-Commerce App!',
        ]);
        Admin::create([
            'user_id'=>$user->id,
            'access_token' => 'qwqkw2442qkwnkqnwkqwkqjwkdsas',
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
