<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $indexView = 'admin.service.all';
    private $storeRoute = 'admin.services';
    private $editView = 'admin.service.edit';
    private $deleteRoute = 'admin.services';
    private $deleteMessage = 'Service deleted successfully.';
    private $createMessage = 'Service created successfully.';
    private $updateMessage = 'Service updated successfully.';


    private $columns = ["id"=>"ID", "name"=>"Service", "parent"=>"Parent Service", "url"=>"Service URL", "images"=>"Image", "created_at"=>"Created At"];

    private $fields = [
        "name"=>[
            "id"=>"serviceName",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Service's Name",
            "placeholder"=>"Service's Name"
        ],
        "description"=>[
            "id"=>"serviceDescription",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Service's Description",
            "placeholder"=>"Service's Description"
        ],
        "parent_id"=>[
            "id"=>"parentService",
            "name"=>"parent_id",
            "type"=>"select",
            "label"=>"Parent Service",
            "placeholder"=>"Parent Service"
        ],
        "url"=>[
            "id"=>"serviceURL",
            "name"=>"url",
            "type"=>"text",
            "label"=>"Service's URL",
            "placeholder"=>"Service's URL"
        ],
        "image"=>[
            "id"=>"serviceImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Service's Image",
            "placeholder"=>"Service's Image"
        ]
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Service::with(['parent','children','images'])->get();
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
            $filePath = $file->storeAs('uploads/services', $fileName); // 'uploads' is the storage folder
        }

        $service = Service::create($request->all());
        
        if($filePath) {
            $service->images()->create(['path'=>$filePath]);
        }
        // Redirect back with a success message
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $services = Service::with(['images'])->get();
        $this->fields['parent_id']['options'] = $services;
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$service, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
