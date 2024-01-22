<?php

namespace App\Http\Controllers;

use App\Notifications\AddNewAdmin;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Models\Products;
use App\Models\Contact;
use App\Models\Admin;
use App\Models\User;
use App\Models\Rating;
use App\Models\UserData;
use App\Models\Notifications;
use App\Http\Controllers\sendEmail;
use DataTables;
class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        if(Auth::check()){
            $userId=Auth::user()->id;
            $checkAdmin =Admin::where("user_id", $userId)->first();
            if(!$checkAdmin){
                abort(403);
            }
        }
      
    }
    public function checkAccess(){
        $userId=Auth::user()->id;
        $checkAdmin =Admin::where("user_id", $userId)->get();
        if(count($checkAdmin) == 1){
            return true;
        }else{
            return false;
        }
    }
    public function getUsersLimit(){
        $users=DB::select( DB::raw("SELECT users.id as id,users.name as name, users.email as email,users.created_at as created_at, personal_data_of_users.image_path as image,personal_data_of_users.about_user as about_user ,personal_data_of_users.last_login as last_login  FROM users INNER JOIN personal_data_of_users ON users.id=personal_data_of_users.user_id where users.email_verified_at IS NOT NULL order by users.id  DESC LIMIT 4") );
        return $users;
    }
    public function getUsers(){
        $users=DB::select( DB::raw("SELECT users.id as id,users.name as name, users.email_verified_at as email_verified_at, users.email as email,users.created_at as created_at, personal_data_of_users.image_path as image,personal_data_of_users.about_user as about_user ,personal_data_of_users.last_login as last_login  FROM users INNER JOIN personal_data_of_users ON users.id=personal_data_of_users.user_id ") );
        return $users;
    }
    public function userSession(){
        $userId=Auth::user()->id;
        $user = DB::select( DB::raw("SELECT users.id as id,users.name as name, users.email as email, users.password as password, users.created_at as created_at, personal_data_of_users.image_path as image,personal_data_of_users.about_user as about_user ,personal_data_of_users.last_login as last_login  FROM users INNER JOIN personal_data_of_users ON users.id=personal_data_of_users.user_id where users.id=".$userId."") );
        return $user;
    }
   
    public function index(){
        $checkAdmin=$this->checkAccess();
        $users=$this->getUsersLimit();
        $user=$this->userSession();
        if($checkAdmin){
            return view("dashboard/dashboard")->with("admin",true)->with("admin",$user)->with("users",$users);
        }else{
           abort("404");

        }
    }
   
    public function users(){
        $checkAdmin=$this->checkAccess();
        $users=$this->getUsers();
        $user=$this->userSession();
        if($checkAdmin){
            return view("dashboard/dashboard-users")->with("admin",true)->with("admin",$user)->with("users",$users);;
        }else{
            abort("404");
        }
    }
    public function dashboard_admins(){
        $checkAdmin=$this->checkAccess();
        $user=$this->userSession();
        $users=$this->getUsers();

        if($checkAdmin){
            $admins = DB::select( DB::raw("SELECT admin.id as id,users.name as name, users.email as email,users.created_at as created_at, personal_data_of_users.image_path as image,personal_data_of_users.about_user as about_user ,personal_data_of_users.last_login as last_login  FROM users INNER JOIN personal_data_of_users ON users.id=personal_data_of_users.user_id INNER JOIN admin ON users.id =admin.user_id where users.email_verified_at IS NOT NULL order by users.id DESC;") );
            $admins=json_decode(json_encode($admins));
            return view("dashboard.dashboard-admins")->with("admin",true)->with("admin",$user)->with("users",$admins);;
        }else{
           abort("404");

        }
    }


 
    public function approve_rating(Request $request){
        $checkAdmin=$this->checkAccess();
           if($checkAdmin){
            Rating::where("id",$request->id)->update([
                "is_approved"=>1
            ]);         
        }else{
           abort("404");

        }
    }
    public function delete_rating(Request $request){
        $checkAdmin=$this->checkAccess();
           if($checkAdmin){
            Rating::where("id",$request->id)->delete();         
        }else{
           abort("404");

        }
    }

    
    public function update_user(Request $request){
        $checkAdmin=$this->checkAccess();
        try {
            DB::beginTransaction();
            if($checkAdmin){
            
                User::where("id",$request->id)->update([
                    "email"=>$request->email,
                    "name"=>$request->name
                ]);
                
            }
            DB::commit();
        } catch (\Throwable $th) {
            //DB::rollBack();
            return json_encode(["error"=>true,"errorMessage"=>$th->getMessage(),"Request"=>$request]);
            // echo $th->getMessage();
        }
        
    }
    public function admin_profile(){
        $checkAdmin=$this->checkAccess();
        $users=$this->getUsers();
        $user=$this->userSession();
        if($checkAdmin){
            return view("dashboard/dashboard-user-profile")->with("Isadmin",true)->with("admin",$user)->with("users",$users);;
        }else{
            abort("404");

        }
    }

  
    public function delete_user(Request $request){
        $checkAdmin=$this->checkAccess();
        if($checkAdmin){
            if(isset($request->admin)){
                Admin::where("id",$request->id)->delete();
            }
            User::where("id",$request->id)->delete();
            UserData::where("user_id",$request->id)->delete();
        }
    }
    public function check_password(Request $request){
        $checkAdmin=$this->checkAccess();
        $newPassword=$request->newPassword;
        $currentPassword=$request->currentPassword;
        $oldPassword=Auth::user()->password;
        if($checkAdmin){
         
            if (Hash::check($currentPassword, $oldPassword)) {
                $this->updatePassword($newPassword);
                return json_encode(["error"=>false]);
            }else{
                return json_encode(["error"=>true ,"oldPassword"=>$oldPassword ,"currentPassword"=>Hash::make($currentPassword)]);

            }

        }
    }
    public function updatePassword($newPassword){
        User::where("id",Auth::user()->id)->update([
            'password'=>Hash::make($newPassword),
        ]);
    }
    
    public function getProdcuts()
    {

        $data = Products::query();

        return DataTables::of($data)
            ->make(true);
    }
    public function products(){
        $checkAdmin=$this->checkAccess();
        $products=Products::orderBy('id', 'DESC')->get();

        $user=$this->userSession();
        if($checkAdmin){
            return view("dashboard/dashboard-products")->with("Isadmin",true)->with("admin",$user)->with("products",$products);
        }else{
            abort("404");

        }
    }

    public function add_products(Request $request){
     
            try {
            $imageName = time().'.'.$request->image->extension();  
            
            $path=$request->image->move(public_path('images'), $imageName);
            $path="/images/$imageName";
            Products::where("id",$request->id)->create([
                "product_image_path"=> $path,
                "product_name"=>$request->pr_name,
                "product_price"=>$request->pr_price,
                "product_description"=>$request->pr_description,
            ]);
                
            return json_encode(["success"=>true,'image_path'=>$path]);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return json_encode(["success"=>false ,"error_message"=>$th->getMessage()]);
        }
         
        
    }
    public function update_products(Request $request){
    
            try {
                if ($request->hasFile('image')) {
                    $imageName = time().'.'.$request->image->extension();  
                
                    $path=$request->image->move(public_path('images'), $imageName);
                    $path="/images/$imageName";
                    Products::where("id",$request->id)->update([
                        "product_image_path"=> $path,
                        "product_name"=>$request->pr_name,
                        "product_price"=>$request->pr_price,
                        "product_description"=>$request->pr_description,
                    ]);
                }else{
                    Products::where("id",$request->id)->update([
                        "product_name"=>$request->pr_name,
                        "product_price"=>$request->pr_price,
                        "product_description"=>$request->pr_description,
                    ]);
                }
                return json_encode(["success"=>true]);

            } catch (\Throwable $th) {
                DB::rollBack();
                return json_encode(["success"=>false ,"error_message"=>$th->getMessage()]);
            }
            
        
    }
    public function single_product($id){
        $product=Products::where('id',$id)->first();
        print_r(json_encode(["product"=>$product]));

    }
    public function delete_product(Request $request){
        // dd($request);
        Products::where("id",$request->id)->delete();
        print_r(json_encode(["success"=>true]));
       
    }
    public function contact(){
        $checkAdmin=$this->checkAccess();
        $contact=Contact::orderBy('id', 'DESC')->get();
        $user=$this->userSession();
        if($checkAdmin){
            return view("dashboard/dashboard-contact")->with("Isadmin",true)->with("admin",$user)->with("contacts",$contact);
        }else{
           abort("404");

        }
    }
    public function add_new_admin(Request $request){
        $checkAdmin=$this->checkAccess();
        if($checkAdmin){
            DB::beginTransaction();
            try {
                $user= User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'email_verified_at'=>now()
                ]);
                UserData::create([
                    'user_id'=>$user->id,
                    'image_path' => 'https://cambodiaict.net/wp-content/uploads/2019/12/computer-icons-user-profile-google-account-photos-icon-account.jpg',
                    'about_user' => 'Hello I Am Using E-Commerce App!',
                    'use_cookie'=> 0,
                    'save_login' => 0,
                ]);
                Admin::create([
                    "id"=>$request->id,
                    'user_id'=>$user->id,
                    'access_token'=>$request->_token,
                ]);
                
                $result = Admin::where("user_id",Auth::user()->id)->get()->first();
                $result->notify(new AddNewAdmin($result));
                DB::commit();
                
                return json_encode(["error"=>false]);
            } catch (\Throwable $th) {
                DB::rollBack();
                echo $th->getMessage();
                return json_encode(["error"=>true ,"error_message"=>"Email is already exist! You Must choose a unique email"]);
            }
        }else{
            abort("404");

        }
    }
    public function modifiyAdmin(Request $request){
        $checkAdmin=$this->checkAccess();
        if($checkAdmin){
            Admin::where("id",$request->id)->delete();
        }else{
           abort("404");

        }
    }
    public function get_unread_message(){
        $unreadMessage=Contact::where("is_read",false)->get();
        return json_encode(["messageCount"=>count($unreadMessage)]);
    }
    public function mark_as_read(){
        Contact::where("is_read",false)->update(["is_read"=>true]);
    }
    public function get_notifications(){
        $post=notifications::orderBy('notifiable_id', 'DESC')->get();
        return json_encode($post);
    }
    public function get_notifications_image(Request $request){
        $image=UserData::where("user_id",$request->id)->get("image_path");
        return($image);
    }
    public function get_notifications_count(){
        $count=notifications::where('read_at', null)->get();
        return json_encode(['count'=>count($count)]);
    }
    public function update_read_notifications(){
        $count=notifications::where('read_at', null)->update([
            'read_at'=>now()
        ]);
    }
    public function test(){
        DB::beginTransaction();
        try {
             $id=Auth::user()->id;
             $Admin=Admin::where("user_id", $id)->get();
            $result = Admin::where("user_id",$id)->get()->first();
            $result->notify(new AddNewAdmin($result));
            DB::commit();
        } catch (\Throwable $th) {
           echo $th->getMessage();
           DB::rollBack();

        }
    }

    public function sendResetPasswordEmail(Request $request){
        $checkAdmin=$this->checkAccess();
        if($checkAdmin){
            try {
                $user = User::where('email',$request->email)->first();
                $token = Password::getRepository()->create($user);
                $user->sendPasswordResetNotification($token);
                $credentials = ['email' => $request->email];
                $response = Password::sendResetLink($credentials, function (Message $message) {
                $message->subject($this->getEmailSubject());
            });
    
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
            }
        }else{
            abort("404");
        }
    }
    public function sendVerificationCode(Request $request){
        $number =$request->one.$request->two.$request->three.$request->four;
        $checkAdmin=$this->checkAccess();
        if($checkAdmin){
            try {
                echo $number;
                $result = (new sendEmail)->verfificationCode($number,$request->email);
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
            }
        }else{
           abort("404");

        }
    }

}
