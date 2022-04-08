<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        
        
         $products=Product::create([
             'product_id'          =>$request['productId'],
             'product_name'       =>$request['productName'],
             'description'        =>$request['description'],
             'category'           =>$request['category'],
             'unit'               =>$request['unit'],
             'unit_price'         =>$request['unit_price']

         ]);

        return response()->json($products);
    }

}
