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
use App\Models\BlogMetaInfos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use App\Models\Setting;
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
            'blogs' => BlogPost::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $settings = Setting::where('key',"block")->get();
        return view('admin.blogs.create',['categories' => $categories,'settings'=>$settings]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostRequest $request)
    {

       // dd($request->all());
      
        // BlogPost::create($request->all());
        try{
                DB::beginTransaction();
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


                // categories 
                $categories  = $request->categories_id;
                if(count($categories) > 0){
                    $post->categories()->attach($categories);
                }

                //settings                 
                 $settings  = $request->settings_id??[];
                 if(count($settings) > 0){
                      $post->settings()->attach($settings);
                 }

                //meta tags
                if(isset($request->meta_info)){
                    $meta_info  = $request->meta_info;
                    if(count($meta_info) > 0){
                    foreach ($meta_info as $meta) {
                        $meta_key = $meta['meta_key'];                       
                        if(isset($meta['meta_value'])){
                            $meta_value = $meta['meta_value'];
                            if($meta_value instanceof UploadedFile && $meta_value->isValid())
                             {
                                    $meta_file = $meta_value;                                    
                                    $meta_filename = "meta".time() . '.' .  $meta_file->getClientOriginalExtension();
                                    $imageStorePath = public_path('uploads/blogs');
                                    $meta_file->move($imageStorePath, $meta_filename);
                                    $meta_value = $meta_filename;
                              }                    
                            BlogMetaInfos::create([
                                'blog_id' => $post->id,
                                'meta_key' => $meta_key,
                                'meta_value' => $meta_value,                           
                            ]);
                         }
                      }
                   }
                }
             
                DB::commit();
                return redirect()->route('admin.blogs.index')
                        ->withSuccess('New Blog is added successfully.');
        }
        catch(\Exception $e){
            DB::rollBack();
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
        $blog = BlogPost::with(["categories","metaInfos","settings"])->find($id); 
        return view('admin.blogs.show', [
            'blog' => $blog,
            'meta_info' => $blog->metaInfos->pluck("meta_value","meta_key")??[]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = BlogPost::with(["categories","metaInfos"])->find($id);     
        $categories = Category::all();
        $selectedCategores =  $blog->categories->pluck("id")->toArray();

        $settings = Setting::where('key',"block")->get();
        $selectedSettings =  $blog->settings->pluck("id")->toArray();
       
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => $categories,
            'selectedCategores' => $selectedCategores,
            'settings' => $settings,
            'selectedSettings' => $selectedSettings,
            'meta_info' => $blog->metaInfos->pluck("meta_value","meta_key",)??[]
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

                $settings  = $request->settings_id??[];
                if(count($settings) > 0){
                    $post->settings()->sync($settings);
                }


                   //meta tags
                   if(isset($request->meta_info)){
                    $meta_info  = $request->meta_info;
                   
                    if(count($meta_info) > 0){
                        
                    foreach ($meta_info as $meta) {
                       
                        $meta_key = $meta['meta_key'];
                        
                        if(isset($meta['meta_value'])){
                           
                            $meta_value = $meta['meta_value'];
                            if($meta_value){
                                if($meta_value instanceof UploadedFile && $meta_value->isValid())
                                {
                                        $meta_file = $meta_value;                                    
                                        $meta_filename = "meta".time() . '.' .  $meta_file->getClientOriginalExtension();
                                        $imageStorePath = public_path('uploads/blogs');
                                        $meta_file->move($imageStorePath, $meta_filename);
                                        $meta_value = $meta_filename;
                                }    
                                
                                BlogMetaInfos::where(['blog_id' => $id, 'meta_key' => $meta_key])->updateOrCreate([   
                                    'blog_id' => $id,                          
                                    'meta_key' => $meta_key,
                                    'meta_value' => $meta_value,                           
                                ]);
                            }
                        }
                      }
                   }
                }

                return redirect()->route('admin.blogs.index')
                        ->withSuccess('New Blog is Updated successfully.');

        }catch(\Exception $e){
            $errors = $e->getMessage();
           
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
        $blog->settings()->detach();
        $blog->comments()->delete();
        $blog->metaInfos()->delete();

        $blog->delete();

        return redirect()->route('admin.blogs.index')
                ->withSuccess('Blog is deleted successfully.');
    }
}
