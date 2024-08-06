<?php

namespace App\Http\Controllers\API;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pages = Page::all();
            return response()->json([
                'data'=>$pages
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
                'description'=>'required',
                'url'=>'required',
                // 'image'=>'required|mimes:png,jpg,jpeg,gif'
            ]);

            if($validation->fails()) {
                return response()->json([
                    'status'=>false,
                    'errors'=>$validation->errors()->all()
                ], 401);
            }
            // // Handle file upload
            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('uploads', $fileName); // 'uploads' is the storage folder
            // }

            $page = Page::create(['title'=>$request->title, 'description'=>$request->description, 'url'=>$request->url]);
            return response()->json(["pages"=>$page], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'error'=>$th
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
