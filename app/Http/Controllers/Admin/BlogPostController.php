<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs as BlogPost;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Str;
class BlogPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:super-admin|admin|blog-manager|list-blog|create-blog|edit-blog|delete-blog,admin'], ['only' => ['index','show']]);
        $this->middleware(['role_or_permission:super-admin|admin|blog-manager|create-blog,admin'], ['only' => ['create','store']]);
        $this->middleware(['role_or_permission:super-admin|admin|blog-manager|edit-blog,admin'], ['only' => ['edit','update']]);
        $this->middleware(['role_or_permission:super-admin|admin|blog-manager|delete-blog,admin'], ['only' => ['destroy']]);
    }

       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = BlogPost::with('categories')->get();
        return view('admin.blogs.index', [
            'blogs' => BlogPost::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostRequest $request)
    {
      
        // BlogPost::create($request->all());
        try{
    
                $user = Auth::guard('admin')->user();

                $post = new BlogPost();
                $post->title = $request->title;
                $post->short_description = $request->short_description;
                $post->body = $request->body;
                $post->slug = Str::slug($request->title);
                $post->published_at = $request->published_at;
                $post->user_id  = $user->id;
                $post->author_name = $user->name;
                $post->status = ($request->status=="Publish" ? true : false);
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $imageStorePath = public_path('uploads/blogs');
                    request()->image->move($imageStorePath, $filename);
                    $post->image = $filename;
                }              
                $post->save();

                $categories  = $request->categories_id;
                if(count($categories) > 0){
                    $post->categories()->attach($categories);
                }

                return redirect()->route('admin.blogs.index')
                        ->withSuccess('New Blog is added successfully.');
        }
        catch(\Exception $e){
            $errors = $e->getMessage();
            dd($errors);
            return redirect()->route('admin.blogs.index')
            ->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = BlogPost::with("categories")->find($id); 
        return view('admin.blogs.show', [
            'blog' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = BlogPost::with("categories")->find($id);     
        $categories = Category::all();
        $selectedCategores =  $blog->categories->pluck("id")->toArray();
       
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => $categories,
            'selectedCategores' => $selectedCategores
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostRequest $request, $id)
    {
        // $category->update($request->all());
            try{
        
                $user = Auth::guard('admin')->user();

                $post = BlogPost::find($id);               
                $post->title = $request->title;
                $post->short_description = $request->short_description;
                $post->body = $request->body;
                $post->slug = Str::slug($request->title);
                $post->published_at = $request->published_at;
                $post->user_id  = $user->id;
                $post->author_name = $user->name;
                $post->status = ($request->status=="Publish" ? true : false);
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $imageStorePath = public_path('uploads/blogs');
                    request()->image->move($imageStorePath, $filename);
                    $post->image = $filename;
                }              
                $post->save();

                $categories  = $request->categories_id;
                if(count($categories) > 0){
                    $post->categories()->sync($categories);
                }

                return redirect()->route('admin.blogs.index')
                        ->withSuccess('New Blog is Updated successfully.');

        }catch(\Exception $e){
            $errors = $e->getMessage();
            dd($errors);
            return redirect()->route('admin.blogs.index')
            ->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = BlogPost::find($id); 
        $blog->categories()->detach();
        $blog->delete();

        return redirect()->route('admin.blogs.index')
                ->withSuccess('Blog is deleted successfully.');
    }
}
