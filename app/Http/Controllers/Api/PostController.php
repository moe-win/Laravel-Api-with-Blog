<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'category_id'=>'required'
        ],
        [
            'categories_id.required'=>'CATEGORIES FIELD IS REQUIRED'
        ]
    
    ); 
    $post=new Post();
    $post->title=$request->title;
    $post->description=$request->description;
    $post->category_id=$request->categories_id;
    $post->save();

    return ResponseHelper::success([],'Successfully careate and uploaded');

    }
}
