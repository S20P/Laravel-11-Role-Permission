<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs as BlogPost;

class BlogController extends Controller
{
    public function __construct(){

    }

    public function index()
    {
        $blogs = BlogPost::with("categories")->where('status',1)->latest()->paginate(6);
        
        return view('pages.blogs.blog', [
            'blogs' => $blogs
        ]);
    }

    public function show($slug)
    {
        $blog = BlogPost::with(["categories","metaInfos"])->where("slug",$slug)->where('status',1)->first(); 
       
        return view('pages.blogs.blog-details', [
            'blog' => $blog,
            'meta_info' => $blog->metaInfos??[]
        ]);
    }

    public function ajaxRequest(Request $request)
    {
        if($request->ajax()){

                   $action = $request->action;
                   if($action){

                     switch($action){
                         case "fetchblogaction";
                          return $this->getBlogs($request->all());
                         break;


                     }

                   }
                
               
         }    
    }


    public function getBlogs($input) {

        $blogs = BlogPost::with("categories")->where('status',1)->latest()->paginate(6);
        
        $blogItemHTML = view('pages.blogs.blog-items', [
            'blogs' => $blogs
        ])->render();

        return response()->json([
            "success" => true,
            "blogItemHTML" => $blogItemHTML,
            "message" => "Lists"
        ]);         
    }

}
