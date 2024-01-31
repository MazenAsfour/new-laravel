<?php

// app/Http/Controllers/PasswordController.php
// app/Http/Controllers/PasswordController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;
use Illuminate\Support\Facades\Hash;
use App\Models\NotificationRequests;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function showPasswordForm($userId)
    {
        return view('enter-password', ['userId' => $userId]);
    }

    public function verifyPassword(Request $request, $userId)
    {
        $password = $request->input('password');

        // Replace '123' with the actual correct password
        if ($password == 123 ) {
            // Assuming you have a 'points' field in your PersonalDataOfUsers model
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