<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role_or_permission:super-admin|admin|category-manager|blog-manager|list-category|create-category|edit-category|delete-category,admin'], ['only' => ['index','show']]);
        $this->middleware(['role_or_permission:super-admin|admin|category-manager|blog-manager|create-category,admin'], ['only' => ['create','store']]);
        $this->middleware(['role_or_permission:super-admin|admin|category-manager|blog-manager|edit-category,admin'], ['only' => ['edit','update']]);
        $this->middleware(['role_or_permission:super-admin|admin|category-manager|blog-manager|delete-category,admin'], ['only' => ['destroy']]);
    }

       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('admin.categories.index')
                ->withSuccess('New category is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->back()
                ->withSuccess('Category is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
                ->withSuccess('Category is deleted successfully.');
    }
}
