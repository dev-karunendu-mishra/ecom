<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public $columns = ["id"=>"ID", "title"=>"Title", "sub_title"=>"SubTitle", "image"=>"Slider Image", "created_at"=>"Created At"];

    public $fields = [
        [
            "id"=>"title",
            "name"=>"title",
            "type"=>"text",
            "label"=>"Slider's Title",
            "placeholder"=>"Slider's Title"
        ],
        [
            "id"=>"subTitle",
            "name"=>"sub_title",
            "type"=>"text",
            "label"=>"Slider's SubTitle",
            "placeholder"=>"Slider's SubTitle"
        ],
        [
            "id"=>"shopLink",
            "name"=>"shop_link",
            "type"=>"text",
            "label"=>"Shop Link",
            "placeholder"=>"Shop Link"
        ],
        [
            "id"=>"sliderImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Slider Image",
            "placeholder"=>"Slider Image"
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Slider::all();
        return view('admin.sliders.all',['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'records'=>$records,'model'=>null]);
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
             'title'=>'required',
                'sub_title'=>'required',
                //'shop_link'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

            // Handle file upload
            $filePath=null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName); // 'uploads' is the storage folder
            }

            $slider = Slider::create(['title'=>$request->title, 'sub_title'=>$request->sub_title, 'shop_link'=>$request->shop_link, 'image'=>$filePath]);
             return redirect()->route('admin.sliders')->with('success', 'Slider added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit',['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$slider, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.sliders')->with('success', 'Slider deleted successfully.');
    }
}
