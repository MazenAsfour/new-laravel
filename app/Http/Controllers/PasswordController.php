<?php

// app/Http/Controllers/PasswordController.php
// app/Http/Controllers/PasswordController.php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserData;
use Illuminate\Support\Facades\Hash;
use App\Models\NotificationRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\ConfigOption;
class PasswordController extends Controller
{
    public function showPasswordForm($userId)
    {
        return view('enter-password', ['userId' => $userId]);
    }

    public function verifyPassword(Request $request, $userId)
    {
        $password = $request->input('password');
        $pointsPassword = ConfigOption::where("option_name","points_password")->first();
        
       if (Hash::check($password, $pointsPassword->option_value)) {
            $user = UserData::find($userId);
            if ($user) {
                $user->points += 1;
                $user->save();
                NotificationRequests::create([
                    "user_id"=>Auth::user()->id,
                    "status"=>0
                ]);

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'User not found.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Incorrect password. Please try again.']);
        }
    }
}