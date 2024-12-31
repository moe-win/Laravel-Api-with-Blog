<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\AuthController;

class AuthController extends Controller{
   public function register(Request $request){
        //check validate name,email,password
        $request->validate(
            ['name'=> 'required|string|max:10',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:8|max:20'          
            ]
        );

        //store in server name,email,password
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save(); //save database user as name,email,password

        // Creating a token without scopes...
        $token = $user->createToken('Blogs')->accessToken;

        return ResponseHelper::success([//get response from using responsehelper
            'access_token'=>$token]);

   }

   //login feature
   public function login(Request $request){
    //login email,password check    
    $request->validate(
            [
                'email'=>'required',
                'password'=>'required'
            ]
        );
    //login using attempt to check correct email and password    
    if(auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user= auth::user();//get user auth to create user

            $token = $user->createToken('Blogs')->accessToken;

        return ResponseHelper::success([
            'access_token'=>$token]);

    }    
   }

   //logout feature
   public function logout(Request $request){
        // $user=auth()->user();
        // $user->token()->revoke();
        auth()->user()->token()->revoke();//token logout by using revoke function
        return ResponseHelper::success([],'logout successed');//array inside no data and use success pass data
   }
}