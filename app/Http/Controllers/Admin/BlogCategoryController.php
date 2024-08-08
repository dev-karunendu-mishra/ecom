<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    private $indexView = 'admin.blog-category.all';
    private $storeRoute = 'admin.blog-categories';
    private $editView = 'admin.blog-category.edit';
    private $deleteRoute = 'admin.blog-categories';
    private $deleteMessage = 'BlogCategory deleted successfully.';
    private $createMessage = 'BlogCategory created successfully.';
    private $updateMessage = 'BlogCategory updated successfully.';


    private $columns = ["id"=>"ID", "name"=>"BlogCategory", "parent"=>"Parent BlogCategory", "url"=>"BlogCategory URL", "images"=>"Image", "created_at"=>"Created At"];

    private $fields = [
        "name"=>[
            "id"=>"blogCategoryName",
            "name"=>"name",
            "type"=>"text",
            "label"=>"BlogCategory's Name",
            "placeholder"=>"BlogCategory's Name"
        ],
        "parent_id"=>[
            "id"=>"parentBlogCategory",
            "name"=>"parent_id",
            "type"=>"select",
            "label"=>"Parent BlogCategory",
            "placeholder"=>"Parent BlogCategory"
        ],
        "url"=>[
            "id"=>"blogCategoryURL",
            "name"=>"url",
            "type"=>"text",
            "label"=>"BlogCategory's URL",
            "placeholder"=>"BlogCategory's URL"
        ],
        "image"=>[
            "id"=>"blogCategoryImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"BlogCategory's Image",
            "placeholder"=>"BlogCategory's Image"
        ],
        // "is_active"=>[
        //     "id"=>"blogCategoryIsActive",
        //     "name"=>"is_active",
        //     "type"=>"switch",
        //     "label"=>"BlogCategory's Status",
        // ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = BlogCategory::with(['parent','children','images'])->get();
        $this->fields['parent_id']['options'] = $records;
        return view($this->indexView,['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'records'=>$records,'model'=>null]);
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
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url'=>'required' // max 2MB
        ]);

        // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/blogCategories', $fileName); // 'uploads' is the storage folder
        }

        $blogCategory = BlogCategory::create($request->all());
        
        if($filePath) {
            $blogCategory->images()->create(['path'=>$filePath]);
        }
        // Redirect back with a success message
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blogCategory)
    {
        $blogCategories = BlogCategory::with(['images'])->get();
        $this->fields['parent_id']['options'] = $blogCategories;
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$blogCategory, 'edit'=>true]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url'=>'required' // max 2MB
        ]);

        $blogCategory->update($request->all());
        // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/blogCategories', $fileName); // 'uploads' is the storage folder
        }
        
        if($filePath) {
            $blogCategory->images()->create(['path'=>$filePath]);
        }

        // Redirect back with a success message
        return redirect()->route($this->storeRoute)->with('success', $this->updateMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
