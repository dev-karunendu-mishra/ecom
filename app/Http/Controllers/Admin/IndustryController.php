<?php

namespace App\Http\Controllers\Admin;

use App\Models\Industry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    private $indexView = 'admin.industry.all';
    private $storeRoute = 'admin.industries';
    private $editView = 'admin.industry.edit';
    private $deleteRoute = 'admin.industries';
    private $deleteMessage = 'Industry deleted successfully.';
    private $createMessage = 'Industry created successfully.';
    private $updateMessage = 'Industry updated successfully.';


    private $columns = ["id"=>"ID", "name"=>"Industry", "parent"=>"Parent Industry", "url"=>"Industry URL", "images"=>"Image", "created_at"=>"Created At"];

    private $fields = [
        "name"=>[
            "id"=>"industryName",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Industry's Name",
            "placeholder"=>"Industry's Name"
        ],
        "description"=>[
            "id"=>"industryDescription",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Industry's Description",
            "placeholder"=>"Industry's Description"
        ],
        "parent_id"=>[
            "id"=>"parentIndustry",
            "name"=>"parent_id",
            "type"=>"select",
            "label"=>"Parent Industry",
            "placeholder"=>"Parent Industry"
        ],
        "url"=>[
            "id"=>"industryURL",
            "name"=>"url",
            "type"=>"text",
            "label"=>"Industry's URL",
            "placeholder"=>"Industry's URL"
        ],
        "image"=>[
            "id"=>"industryImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Industry's Image",
            "placeholder"=>"Industry's Image"
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Industry::with(['parent','children','images'])->get();
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
            $filePath = $file->storeAs('uploads/industries', $fileName); // 'uploads' is the storage folder
        }

        $industry = Industry::create($request->all());
        
        if($filePath) {
            $industry->images()->create(['path'=>$filePath]);
        }
        // Redirect back with a success message
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Industry $industry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Industry $industry)
    {
        $industries = Industry::with(['images'])->get();
        $this->fields['parent_id']['options'] = $industries;
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$industry, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Industry $industry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Industry $industry)
    {
        $industry->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
