<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public $columns = ["id"=>"ID", "name"=>"Category", "parent"=>"Parent Category", "url"=>"Category URL", "images"=>"Image", "created_at"=>"Created At"];

    public $fields = [
        "name"=>[
            "id"=>"categoryName",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Category's Name",
            "placeholder"=>"Category's Name"
        ],
        "description"=>[
            "id"=>"categoryDescription",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Category's Description",
            "placeholder"=>"Category's Description"
        ],
        "parent_id"=>[
            "id"=>"parentCategory",
            "name"=>"parent_id",
            "type"=>"select",
            "label"=>"Parent Category",
            "placeholder"=>"Parent Category"
        ],
        "url"=>[
            "id"=>"categoryURL",
            "name"=>"url",
            "type"=>"text",
            "label"=>"Category's URL",
            "placeholder"=>"Category's URL"
        ],
        "image"=>[
            "id"=>"categoryImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Category's Image",
            "placeholder"=>"Category's Image"
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Category::with(['parent','children','images'])->withCount('products')->get();
        $this->fields['parent_id']['options'] = $records;
        return view('admin.category.all',['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'records'=>$records,'model'=>null]);
        
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
        $this->fields['parent_id']['options'] = $categories;
        return view('admin.category.edit',['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$category, 'edit'=>true, 'categories'=>$categories]);
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
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }
}
