<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

class CustomerController extends Controller
{
    public function api(Request $request){

    return $request->name;
    }

   
}
