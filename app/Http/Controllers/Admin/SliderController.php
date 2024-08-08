<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    private $indexView = 'admin.sliders.all';
    private $storeRoute = 'admin.sliders';
    private $editView = 'admin.sliders.edit';
    private $deleteRoute = 'admin.sliders';
    private $deleteMessage = 'Slider deleted successfully.';
    private $createMessage = 'Slider created successfully.';
    private $updateMessage = 'Slider updated successfully.';

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
            'title'=>'required',
            'sub_title'=>'required',
            'shop_link'=>'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/sliders', $fileName);
        }

        Slider::create(['title'=>$request->title, 'sub_title'=>$request->sub_title, 'shop_link'=>$request->shop_link, 'image'=>$filePath]);
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
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
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$slider, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'=>'required',
            'sub_title'=>'required',
            'shop_link'=>'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/sliders', $fileName);
        }

        $slider->create(['title'=>$request->title, 'sub_title'=>$request->sub_title, 'shop_link'=>$request->shop_link, 'image'=>$filePath]);
        return redirect()->route($this->storeRoute)->with('success', $this->updateMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
