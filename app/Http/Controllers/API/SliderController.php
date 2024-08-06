<?php

namespace App\Http\Controllers\API;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sliders = Slider::all();
            return response()->json([
                'data'=>$sliders
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'error'=>$th
            ],500);
        }
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
         try {
            $validation = Validator::make($request->all(), [
                'title'=>'required',
                'sub_title'=>'required',
                //'shop_link'=>'required',
                'image'=>'required|mimes:png,jpg,jpeg,gif'
            ]);

            if($validation->fails()) {
                return response()->json([
                    'status'=>false,
                    'errors'=>$validation->errors()->all()
                ], 401);
            }
            // Handle file upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/sliders', $fileName); // 'uploads' is the storage folder
            }

            $slider = Slider::create(['title'=>$request->title, 'sub_title'=>$request->sub_title, 'shop_link'=>$request->shop_link, 'image'=>$filePath]);
            return response()->json(["products"=>$slider], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'error'=>$th
            ],500);
        }
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
        //
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
        //
    }
}
