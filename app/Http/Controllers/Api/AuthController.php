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
        $user->save();

        // Creating a token without scopes...
        $token = $user->createToken('Blogs')->accessToken;

        return ResponseHelper::success([
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
    if(auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user= auth::user();

            $token = $user->createToken('Blogs')->accessToken;

        return ResponseHelper::success([
            'access_token'=>$token]);

    }    
   }
}