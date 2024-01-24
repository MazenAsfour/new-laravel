<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use App\Models\UserData;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __construct()
    {
     
        $this->middleware('verified');
        
    }
    public function index()
    {
        $userId=Auth::user()->id;
        $checkAdmin =Admin::where("user_id", $userId)->get();
        $products= Product::get();

        $user = DB::select( DB::raw("SELECT users.id as id,users.name as name, users.email as email, personal_data_of_users.image_path as image,personal_data_of_users.about_user as about_user   FROM users INNER JOIN personal_data_of_users ON users.id=personal_data_of_users.user_id where users.id=".$userId."") );
        // $checkAdmin =Admin::where("user_id", $userId)->get();
        $users=DB::select( DB::raw("SELECT users.id as id,users.name as name, users.email as email,users.created_at as created_at, personal_data_of_users.image_path as image,personal_data_of_users.about_user as about_user  FROM users INNER JOIN personal_data_of_users ON users.id=personal_data_of_users.user_id order by users.id DESC LIMIT 4") );;
        if(count($checkAdmin) == 1){
            return view("dashboard/dashboard")->with("admin",true)->with("admin",$user)->with("users",$users);
        }else{
            return view("welcome")->with("admin",false)->with("user",$user)->with("products",$products);
        }
        
    }
}
