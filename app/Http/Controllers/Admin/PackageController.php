<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    private $indexView = 'admin.package.all';
    private $storeRoute = 'admin.packages';
    private $updateRoute = 'admin.packages';
    private $editView = 'admin.package.edit';
    private $deleteRoute = 'admin.packages';
    private $deleteMessage = 'Package deleted successfully.';
    private $createMessage = 'Package created successfully.';
    private $updateMessage = 'Package updated successfully.';


    private $columns = ["id"=>"ID", "title"=>"Title", "sub_title"=>"Sub Title", "description"=>"Description", "created_at"=>"Created At"];

    private $fields = [
        "title"=>[
            "id"=>"title",
            "name"=>"title",
            "type"=>"text",
            "label"=>"Title",
            "placeholder"=>"Title"
        ],
        "sub_title"=>[
            "id"=>"sub_title",
            "name"=>"sub_title",
            "type"=>"text",
            "label"=>"Sub Title",
            "placeholder"=>"Sub Title"
        ],
        "description"=>[
            "id"=>"description",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Package's Description",
            "placeholder"=>"Package's Description"
        ]
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Package::all();
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
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'description' => 'required',
        ]);

        Package::create($request->all());
        // Redirect back with a success message
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $services = Package::with(['images'])->get();
        $this->fields['parent_id']['options'] = $services;
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$service, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'description' => 'required',
        ]);
        $package->update($request->all());
        return redirect()->route($this->updateRoute)->with('success', $this->updateMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
