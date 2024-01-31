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
use App\Models\Product;
use App\Models\Category;
use App\Models\NotificationRequests;
use App\Models\Contact;
use App\Models\Admin;
use App\Models\User;
use App\Models\Rating;
use App\Models\UserData;
use App\Models\Notifications;
use App\Http\Controllers\sendEmail;
use DataTables;
use App\Models\ConfigOption;
use Illuminate\Support\Carbon;

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
   

    public function index(){

        $logo =ConfigOption::where("option_name","logo")->first();
        $name =  ConfigOption::where("option_name","restaurant_name")->first();
        $all_requests = NotificationRequests::get()->count();
        $adminRequestsNonReadable = NotificationRequests::where("is_admin_read")->get()->count();
        $totalProducts = Product::count();
        $all_users = User::count();
        return view("dashboard/dashboard")->with(compact("logo","name","all_users","all_requests","adminRequestsNonReadable","totalProducts"));
        
    }
   
    public function update_options(Request $request){
     
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
    
            $path=$request->image->move(public_path('images'), $imageName);
            $path="/images/$imageName";
            ConfigOption::where("option_name","logo")->update([
                'option_value' =>  $path,
            ]);

        }
        ConfigOption::where("option_name","restaurant_name")->update([
            'option_value' =>  $request->restaurant_name,
        ]);
        print_r(json_encode(["success"=>true]));

    
    }
    public function update_password_points(Request $request){
        ConfigOption::where("option_name","points_password")->update([
            "option_value"=>Hash::make($request->password)
        ]);
        print_r(json_encode(["success"=>true]));
    }
    public function users(){
     
        $adminData = UserData::where('user_id', Auth::user()->id)->first();
        return view("dashboard/dashboard-users")->with(compact("adminData"));;
    
    }
    public function dashboard_admins(){
            $admins = DB::select( DB::raw("SELECT admin.id as id,users.name as name, users.email as email,users.created_at as created_at, personal_data_of_users.image_path as image,personal_data_of_users.about_user as about_user  FROM users INNER JOIN personal_data_of_users ON users.id=personal_data_of_users.user_id INNER JOIN admin ON users.id =admin.user_id where users.email_verified_at IS NOT NULL order by users.id DESC;") );
            $admins=json_decode(json_encode($admins));
            $rootAdmin = Admin::first();

            return view("dashboard.dashboard-admins")->with("admin",true)->with("rootAdmin",$rootAdmin)->with("users",$admins);;
       
    }
 
  
    public function update_user(Request $request){
        try {
            $user= User::where("id",$request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();  
        
                $path=$request->image->move(public_path('images'), $imageName);
                $path="/images/$imageName";
                UserData::where("user_id",$request->id)->update([
                    'image_path' =>  $path,
                    'points'=>$request->points,
                    'free_gift'=>intval($request->points)/7,
                ]);
            }
            UserData::where("user_id",$request->id)->update([
                'points'=>$request->points,
                'free_gift'=>intval($request->points)/7,
                'card_number' =>  $request->card_number,
            ]);
            return json_encode(["success"=>true]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return json_encode(["success"=>false ,"error"=>$th->getMessage()]);
        }
        
    }
    public function admin_profile(){
      
        $user=Auth::user();
        $adminData= UserData::where("user_id",Auth::user()->id)->first();
            return view("dashboard/dashboard-user-profile")->with("admin",$user)->with("adminData",$adminData);
        
    }

  
    public function delete_user(Request $request){
            if(isset($request->admin)){
                $rootAdmin = Admin::first();
             
                if(intval($rootAdmin->id) == intval($request->id)){
                    print_r(json_encode(["success"=>false,"error"=>"You can't delete root admin!"]));
                    die;
                }else{
                    Admin::where("id",$request->id)->delete();
                }
            }
            User::where("id",$request->id)->delete();
            UserData::where("user_id",$request->id)->delete();
            print_r(json_encode(["success"=>true]));
    }

    public function points(){
        return view("dashboard/dashboard-points");
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
                return json_encode(["error"=>true,"message"=>"Current password not correct!" ,"oldPassword"=>$oldPassword ,"currentPassword"=>Hash::make($currentPassword)]);

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

        $data = Product::with("category")->orderBy("created_at", "desc")->get();

        return DataTables::of($data)
            ->make(true);
    }
    public function getUsers()
    {
        $admins = Admin::get("id")->toArray();
        $data = User::leftJoin('personal_data_of_users', 'users.id', '=', 'personal_data_of_users.user_id')
            ->select('users.*', 'personal_data_of_users.*')
            ->whereNotIn('users.id', $admins)
            ->get();
      
        return DataTables::of($data)
            ->make(true);
    }
    public function getCategories()
    {
        $data = Category::query();

        return DataTables::of($data)
            ->make(true);
    }
    public function update_status(Request $request){
        try {
            $request_id = $request->request_id;
            $convert_to = $request->convert_to;
            $notiRow=  NotificationRequests::where("id", $request_id )->first();
            // dd($request_id);
            $userData = UserData::where("user_id", $notiRow->user_id)->first();
            $user_total_points = intval($userData->points );
            
            if(intval($convert_to) == 1){
                $user_total_points = $user_total_points + 1;
            }else{
                if($user_total_points !== 0)
                    $user_total_points = $user_total_points - 1;
            }
            UserData::where("user_id", $notiRow->user_id)->update([
                "points"=>$user_total_points
            ]);
            NotificationRequests::where("id", $request_id)->update([
                "status" => $convert_to,
                "updated_at" => now()
            ]);
            return json_encode(["success"=>true]);

        } catch (\Throwable $th) {
            return json_encode(["success"=>false,"error"=>$th->getMessage()]);
        }
    
    }
    public function make_all_requests_read(Request $request)
    {
        NotificationRequests::where("is_admin_read",0)->update([
            "is_admin_read"=>1
        ]);
        return json_encode(["success"=>true]);

    }
    public function getPoints(Request $request)
    {
        if($request->isCurrentDay == "1"){
          
            $currentDate = Carbon::now()->toDateString();

            $data = NotificationRequests::join('users', 'notification_requests.user_id', '=', 'users.id')
            ->select('users.email', 'users.name', 'notification_requests.*')
            ->whereDate('notification_requests.created_at', $currentDate)
            ->orderBy('notification_requests.id', 'desc')
            ->get();
        }else{
            $data = NotificationRequests::join('users', 'notification_requests.user_id', '=', 'users.id')
            ->select('users.email', 'users.name', 'notification_requests.*')
            ->orderBy('notification_requests.id', 'desc')
            ->get();
        }
     
        return DataTables::of($data)
            ->make(true);    
        }
    public function categories(){

        return view("dashboard/dashboard-categories");;

    }
    public function Products(){
        $categories = Category::get(["id","name"]);
        return view("dashboard/dashboard-Products")->with("category",$categories);
        
    }

    public function add_product(Request $request){
     
            try {
            $imageName = time().'.'.$request->image->extension();  
            
            $path=$request->image->move(public_path('images'), $imageName);
            $path="/images/$imageName";
            Product::where("id",$request->id)->create([
                "image_path"=> $path,
                "name"=>$request->pr_name,
                "price"=>$request->pr_price,
                "category_id"=>$request->category_id,
                "description"=>$request->pr_description,
            ]);
                
            return json_encode(["success"=>true,'image_path'=>$path]);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return json_encode(["success"=>false ,"error"=>$th->getMessage()]);
        }
         
        
    }
    public function add_category(Request $request){
     
        try {
     
        Category::create([
            "name"=>$request->name,
            "description"=>$request->description,
        ]);
            
        return json_encode(["success"=>true]);
        
    } catch (\Throwable $th) {
        DB::rollBack();
        return json_encode(["success"=>false ,"error"=>$th->getMessage()]);
    }
    
}

    public function update_product(Request $request){
    
            try {
                if ($request->hasFile('image')) {
                    $imageName = time().'.'.$request->image->extension();  
                
                    $path=$request->image->move(public_path('images'), $imageName);
                    $path="/images/$imageName";
                    Product::where("id",$request->id)->update([
                        "image_path"=> $path,
                        "name"=>$request->pr_name,
                        "price"=>$request->pr_price,
                        "description"=>$request->pr_description,
                    ]);
                }else{
                    Product::where("id",$request->id)->update([
                        "name"=>$request->pr_name,
                        "price"=>$request->pr_price,
                        "description"=>$request->pr_description,
                    ]);
                }
                return json_encode(["success"=>true]);

            } catch (\Throwable $th) {
                DB::rollBack();
                return json_encode(["success"=>false ,"error"=>$th->getMessage()]);
            }
            
        
    }
    public function create_user(Request $request){
        try {
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();  
        
                $path=$request->image->move(public_path('images'), $imageName);
                $path="/images/$imageName";
            }else{
                $path="/images/computer-icons-user-profile-google-account-photos-icon-account.jpg" ;  
            }
           
                
            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            UserData::create([
                'user_id'=>$user->id,
                'image_path' =>  $path,
                'points'=>intval($request->points),
                'free_gift'=>intval($request->points)/7,
                'card_number' =>  $request->card_number,
                'about_user' => 'Hello I Am Using E-Commerce App!',
            ]);

            return json_encode(["success"=>true]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return json_encode(["success"=>false ,"error"=>$th->getMessage()]);
        }
    }
    public function update_category(Request $request){
    
        try {

            Category::where("id",$request->id)->update([
                "name"=>$request->name,
                "description"=>$request->description,
            ]);
            
            return json_encode(["success"=>true]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return json_encode(["success"=>false ,"error"=>$th->getMessage()]);
        }
        
    
}
    public function single_product($id){
        $Product=Product::where('id',$id)->first();
        print_r(json_encode(["product"=>$Product]));

    }
    public function delete_product(Request $request){
        // dd($request);
        Product::where("id",$request->id)->delete();
        print_r(json_encode(["success"=>true]));
       
    }
    public function delete_category(Request $request){
        // dd($request);
        Category::where("id",$request->id)->delete();
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
                return json_encode(["error"=>true ,"error"=>"Email is already exist! You Must choose a unique email"]);
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
