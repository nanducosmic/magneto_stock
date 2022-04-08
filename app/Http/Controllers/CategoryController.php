<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        
        
         $category=Category::create([
             'category_id'          =>$request['category_id'],
             'category_name'       =>$request['category_name'],
               ]);

        return response()->json($category);
    }

}
