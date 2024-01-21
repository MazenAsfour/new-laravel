<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\UserData;
use Lcmaquino\GoogleOAuth2\GoogleOAuth2Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Notifications\postNewNotifications;
use Illuminate\Support\Facades\Notification;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider(Request $request)
    {
        $ga = new GoogleOAuth2Manager(config('googleoauth2'), $request);

        return $ga->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $ga = new GoogleOAuth2Manager(config('googleoauth2'), $request);
        echo '<div id="startup">
                <svg class="spinner-container" width="65px" height="65px" viewBox="0 0 52 52">
                <circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="4px" />
                </svg>
              </div>';
        $user = $ga->user();
        
        if(empty($user)) {
            return redirect('/login')->with("filed","Oop,Login With Google Has Been Failed ,Please Try Again Later!");
            die();
            //Do something.
        }else{
            //$user is logged in.
              $Email=$ga->user()->email;
              $Name =$ga->user()->name;
              $Image =$ga->user()->rawAttributes["picture"];
              $this->LoginOrResgiter($Email,$Name,$Image);
            //Do something.
        }
    }
    public function LoginOrResgiter($Email,$Name,$Image){

        $checkUser=User::where('email',$Email)->get();
        if(empty($Name)){
            $Name = substr($Email, 0, strrpos($Email, '@'));
        }
        $Password=''.$Name.'**_Google_Login.';
        if(count($checkUser) < 1){
            try {
                $user= User::create([
                    'name' => $Name,
                    'email' => $Email,
                    'email_verified_at'=>now(),
                    'password' => Hash::make($Password),
                ]);
                UserData::create([
                    'user_id'=>$user->id,
                    'image_path' => "https://cambodiaict.net/wp-content/uploads/2019/12/computer-icons-user-profile-google-account-photos-icon-account.jpg",
                    'about_user' => 'Hello I Am Using E-Commerce App!',
                    'use_cookie'=> 0,
                    'save_login' => 0,
                ]);
                $post=User::find($user->id);
                Notification::send($user, new postNewNotifications($post));
                Auth::loginUsingId($user->id);
                header('refresh:0;url=/');
                return redirect('/home')->with('success', 'Login Successfully');
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }else{            
            try {
                $Name = substr($checkUser[0]->email, 0, strrpos($Email, '@'));
                $credentials = [
                    'email'       => $checkUser[0]->email,
                    'password' =>  $Password,
            ];
            if (Auth::attempt($credentials)) {
                header('refresh:0;url=/');
                return redirect('/home')->with('success', 'Login Successfully');
            }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
    }
   

}
