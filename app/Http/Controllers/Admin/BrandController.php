<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public $columns = ["id"=>"ID", "name"=>"Brand's Name", "url"=>"Brand's URL", "images"=>"Picture", "created_at"=>"Created At"];

    public $fields = [
        [
            "id"=>"brandName",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Brand's Name",
            "placeholder"=>"Brand's Name"
        ],
        [
            "id"=>"brandDescription",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Brand's Description",
            "placeholder"=>"Brand's Description"
        ],
        [
            "id"=>"brandURL",
            "name"=>"url",
            "type"=>"text",
            "label"=>"Brand's URL",
            "placeholder"=>"Brand's URL"
        ],
        [
            "id"=>"brandImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Brand's Image",
            "placeholder"=>"Brand's Image"
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Brand::with(['images'])->get();
        return view('admin.brands.all-brands',['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'records'=>$records,'model'=>null]);
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
            'name'=>'required',
            'description'=>'required',
            'url'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg,gif'
        ]);
            
        // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/brands', $fileName); // 'uploads' is the storage folder
        }

        //Brand::create(['name'=>$request->name, 'description'=>$request->description, 'url'=>$request->url, 'image'=>$filePath]);
        $brand = Brand::create($request->all());
        if($filePath) {
            $brand->images()->create(['path'=>$filePath]);
        }
        return redirect()->route('admin.brands')->with('success', 'Brand added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$brand, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'description'=>'required',
            'url'=>'required',
            // 'image'=>'required|mimes:png,jpg,jpeg,gif'
        ]);
            
        // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName); // 'uploads' is the storage folder
        }

        $updatedInfo = $request->all();
        if($filePath){
            $updatedInfo['image'] = $filePath; 
        }
        //$page = Page::create(['title'=>$request->title, 'description'=>$request->description, 'url'=>$request->url]);
        $brand->update($updatedInfo);
        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands')->with('success', 'Brand deleted successfully.');
    }
}
