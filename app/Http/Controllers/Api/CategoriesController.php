<?php

namespace App\Http\Controllers\Api;

use App\Models\categories;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoriesController extends Controller
{
    public function index(Request $request){
            $categories=categories::orderBy('name')->get();
            return ResponseHelper::success(CategoryResource::collection($categories)) ;
            
    }
}
