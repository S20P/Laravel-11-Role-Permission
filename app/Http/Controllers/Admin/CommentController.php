<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\Admin\UpdateCommentRequest;

class CommentController extends Controller
{

    
    public function __construct()
    {
        $this->middleware(['role_or_permission:super-admin|admin|list-comment|create-comment|edit-comment|delete-comment,admin'], ['only' => ['index','show']]);
        $this->middleware(['role_or_permission:super-admin|admin|create-comment|edit-comment,admin'], ['only' => ['create','store']]);
        $this->middleware(['role_or_permission:super-admin|admin|edit-comment,admin'], ['only' => ['edit','update']]);
        $this->middleware(['role_or_permission:super-admin|admin|delete-comment,admin'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.comments.index', [
            'comments' => Comment::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('admin.comments.edit', [
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, string $id)
    {
        try{

            $comment = Comment::find($id);               
            $comment->comment = $request->comment;          
            $comment->status = ($request->status=="active" ? true : false);
            $comment->save();

            return redirect()->route('admin.comments.index')
                    ->withSuccess('Comment is Updated successfully.');

            }catch(\Exception $e){
                $errors = $e->getMessage();
                // dd($errors);
                return redirect()->route('admin.comments.index')
                ->withErrors($errors);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::find($id); 
        $comment->replies()->delete();
        $comment->delete();

        return redirect()->route('admin.comments.index')
                ->withSuccess('Comment is deleted successfully.');
    }
}
