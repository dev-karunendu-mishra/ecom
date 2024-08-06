<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['images'])->withCount('products')->get();
        return view('admin.category.all-categories',['categories'=>$categories,'edit'=>false]);
        
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url'=>'required' // max 2MB
        ]);

         // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/categories', $fileName); // 'uploads' is the storage folder
        }
        //$category = Category::create(['name'=>$request->name, 'parent_id'=>$request->parent_category_id, 'description'=>$request->description]);
        $category = Category::create($request->all());
        if($filePath) {
            $category->images()->create(['path'=>$filePath]);
        }
         // Redirect back with a success message
        return redirect()->route('admin.categories')->with('success', 'Category '.$category->name.' created successfully!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
         $categories = Category::with(['images'])->withCount('products')->get();
         return view('admin.category.edit',['categories'=>$categories, 'category'=>$category, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url'=>'required|string' // max 2MB
        ]);

        $category->update($request->all());

        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/categories', $fileName); // 'uploads' is the storage folder
        }
       
        if($filePath) {
            $category->images()->create(['path'=>$filePath]);
        }
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        // Redirect to the items index page with a success message
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }
}
