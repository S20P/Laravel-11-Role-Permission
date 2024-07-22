<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class PagesController extends Controller
{
    public function about(Request $request){
         return view("front.pages.about");
    }  
}
