<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    public $columns = ["id"=>"ID", "name"=>"Name", "profile"=>"Profile", "created_at"=>"Created At"];

    public $fields = [
        [
            "id"=>"tname",
            "name"=>"name",
            "type"=>"text",
            "label"=>"User's Name",
            "placeholder"=>"User's Name"
        ],
        [
            "id"=>"tdescription",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Description",
            "placeholder"=>"Description"
        ],
        [
            "id"=>"tprofile",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Profile Picture",
            "placeholder"=>"Profile Picture"
        ]
    ];



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonial.all',['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'testimonials'=>$testimonials,'model'=>null]);
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
        ]);

         // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/testimonials', $fileName); // 'uploads' is the storage folder
        }
        Testimonial::create(["name"=>$request->name, "description"=>$request->description, "profile"=>$filePath]);
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit',['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$testimonial, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial deleted successfully.');
    }
}
