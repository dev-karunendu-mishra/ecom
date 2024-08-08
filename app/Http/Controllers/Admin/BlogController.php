<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $indexView = 'admin.blogs.all';
    private $storeRoute = 'admin.blogs';
    private $editView = 'admin.blogs.edit';
    private $deleteRoute = 'admin.blogs';
    private $deleteMessage = 'Blog deleted successfully.';
    private $createMessage = 'Blog created successfully.';
    private $updateMessage = 'Blog updated successfully.';


    private $columns = ["id"=>"ID", "name"=>"Blog", "parent"=>"Blog Category", "url"=>"Blog URL", "author"=>"Author", "images"=>"Image", "created_at"=>"Created At"];

    private $fields = [
        "name"=>[
            "id"=>"blogsName",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Blog's Name",
            "placeholder"=>"Blog's Name"
        ],
        "blog_category_id"=>[
            "id"=>"parentBlog",
            "name"=>"blog_category_id",
            "type"=>"select",
            "label"=>"Blog's Category",
            "placeholder"=>"Blog's Category"
        ],
        "heading"=>[
            "id"=>"blogsHeading",
            "name"=>"heading",
            "type"=>"text",
            "label"=>"Heading",
            "placeholder"=>"Heading"
        ],
        "url"=>[
            "id"=>"blogsURL",
            "name"=>"url",
            "type"=>"text",
            "label"=>"Blog's URL",
            "placeholder"=>"Blog's URL"
        ],
        "author"=>[
            "id"=>"blogsAuthor",
            "name"=>"author",
            "type"=>"text",
            "label"=>"Author",
            "placeholder"=>"Author"
        ],
        "image"=>[
            "id"=>"blogsImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Blog's Image",
            "placeholder"=>"Blog's Image"
        ],
        "short_description"=>[
            "id"=>"short_description",
            "name"=>"short_description",
            "type"=>"textarea",
            "label"=>"Short Description",
            "placeholder"=>"Short Description"
        ],
        "long_description"=>[
            "id"=>"long_description",
            "name"=>"long_description",
            "type"=>"textarea",
            "label"=>"Long Description",
            "placeholder"=>"Long Description"
        ],
        // "is_active"=>[
        //     "id"=>"blogsIsActive",
        //     "name"=>"is_active",
        //     "type"=>"switch",
        //     "label"=>"Blog's Status",
        // ]
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Blog::with(['images'])->get();
        $blogCategories = BlogCategory::all();
        $this->fields['blog_category_id']['options'] = $blogCategories;
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
        $validatedData = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'name' => 'required|max:255',
            'heading' => 'required',
            'url'=>'required',
            'author' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/blogs', $fileName); // 'uploads' is the storage folder
        }

        $blog = Blog::create($request->all());
        
        if($filePath) {
            $blog->images()->create(['path'=>$filePath]);
        }
        // Redirect back with a success message
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blogCategories = BlogCategory::all();
        $this->fields['blog_category_id']['options'] = $blogCategories;
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$blog, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
