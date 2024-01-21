<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;
use App\Models\Products;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AjaxUploadController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp',
        
               ]);
               //|max:2048
               $imageName = time().'.'.$request->image->extension();  
              
               $path=$request->image->move(public_path('images'), $imageName);
               if(File::exists($path)){
                $path="/images/$imageName";
                    if(isset($request->type)){
                        Products::where("id",$request->id)->update([
                            "product_image_path"=> $path
                        ]);
                }else{
                        UserData::where("user_id",$request->id)->update([
                            "image_path"=> $path
                        ]);
                }
                }
               
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return json_encode(["error"=>true,"errorMessage"=>$th->getMessage(),"Request"=>$request->id]);
            // echo $th->getMessage();
        }
       
    }

    public function store_user(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp',
        
               ]);
               //|max:2048
               $imageName = time().'.'.$request->image->extension();  
              
               $path=$request->image->move(public_path('images'), $imageName);
               if(File::exists($path)){
                $path="/images/$imageName";
                    UserData::where("user_id",Auth::user()->id)->update([
                        "image_path"=> $path
                    ]);
                    DB::commit();
                    return json_encode(["success"=>true]);
               }else{
                    return json_encode(["success"=>false,"image"=>$imageName]);
               }
               
        } catch (\Throwable $th) {
            DB::rollBack();
            return json_encode(["success"=>false]);
            // echo $th->getMessage();
        }
       
    }
}
