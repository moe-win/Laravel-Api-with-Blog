<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Controllers\Api\ProfileController;

class ProfileController extends Controller
{
    public function profile(){
        $user=auth()->guard()->user();
            // return $user;
            // $data=new ProfileResource($user);
            // return $data;
            // return new ProfileResource($user);
            return ResponseHelper::success(new ProfileResource($user));
            
    }
}
