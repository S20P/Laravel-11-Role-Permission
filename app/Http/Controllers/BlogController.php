<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs as BlogPost;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Empty_;

class BlogController extends Controller
{
    public function __construct(){

    }

    public function index()
    {
      
        $blogs = BlogPost::with("categories")->where('status',1)->latest()->paginate(10);
        
        return view('pages.blogs.blog', [
            'blogs' => $blogs
        ]);
    }

    public function show($slug)
    {
        $blog = BlogPost::with(["categories","metaInfos","settings","comments","latestComment","oldestComment"])->where("slug",$slug)->where('status',1)->first(); 
        if(!Empty($blog)){
            $viewedBlogPosts = Session::get('viewed_blog_posts', []);
            if (!in_array($blog->id, $viewedBlogPosts)) {
                // Increment the view count
                $blog->increment('views');
    
                // Store the blog post ID in the session
                Session::push('viewed_blog_posts', $blog->id);
            }
           
            $relatedBlogs = $this->getRelatedBlogs($blog);
            $trendingBlogs = BlogPost::orderBy('views', 'desc')->limit(5)->get();
    
            $categories = Category::all();
            return view('pages.blogs.blog-details', [
                'blog' => $blog,
                'meta_info' => $blog->metaInfos??[],
                'setting_info' => $blog->settings??[],
                'categories' => $categories,
                'relatedBlogs' => $relatedBlogs,
                'trendingBlogs' => $trendingBlogs
            ]); 
        }else{
            abort(404);
            //return redirect()->back()->withErrors('No Blogs Found!.');
        }
              
    }

    public function showCategory($slug){
       
        try{
            $mainCategory = Category::where('slug', $slug)->where('status',1)->first();
            if(!Empty($mainCategory)){
                $blogs = BlogPost::whereHas('categories', function($query) use ($slug) {
                    $query->where('slug', $slug);
                })->where('status', 1)->paginate(10);        
        
                return view('pages.blogs.blog-category', [
                    'blogs' => $blogs,
                    'mainCategory' => $mainCategory
                ]);
          }else{
            abort(404);
          }
        }catch(\Exception $e){               
                $errors = $e->getMessage();
                abort(404);
                return redirect()->back()
                ->withErrors($errors);
      }
       
    }

    private function getRelatedBlogs(BlogPost $blog)
    {
        $relatedBlogs = BlogPost::whereHas('categories', function($query) use ($blog) {
            $query->whereIn('categories.id', $blog->categories->pluck('id'));
        })
        ->where('id', '!=', $blog->id)
        ->where('status', 1)
        ->limit(5)       
        ->get();
         
        if ($relatedBlogs->isEmpty()) {
            // Fetch random blogs if no related blogs are found
            $relatedBlogs = BlogPost::where('id', '!=', $blog->id)
                ->inRandomOrder()
                ->limit(5)
                ->get();
        }

        return $relatedBlogs;
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

        $blogs = BlogPost::with("categories")->where('status',1);

        if(isset($input['search']) && !Empty($input['search'])){
            $search = $input['search'];
            $blogs->where('title', 'LIKE', "%{$search}%");
            $blogs->orWhere('short_description', 'LIKE', "%{$search}%");
            $blogs->orWhere('body', 'LIKE', "%{$search}%");
        }

        $blogs = $blogs->latest()->paginate(10);
        
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
