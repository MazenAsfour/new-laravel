<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Models\UserData;


class PublicController extends Controller
{
    public function welcome_view(){
        return view('welcome');
    }
    public function profile(){
        $userData = UserData::where("id",Auth::user()->id)->first();
        return view('profile')->with("userData",$userData);

    }
    public function update_card(Request $request){

        UserData::where("id",Auth::user()->id)->update([
            "card_number"=>$request->card
        ]);
        print_r(json_encode(["success"=>true]));

    }
}

