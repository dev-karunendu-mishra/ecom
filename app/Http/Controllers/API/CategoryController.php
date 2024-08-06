<?php

namespace App\Http\Controllers\API;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        try {
            $categories = Category::with(['images'])->withCount('products')->get();
            return response()->json([
                'data'=>$categories
            ],200);
        } catch (Exception $th) {
            return response()->json([
                'error'=>$th->getMessage()
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg,gif',
            'url'=>'required'
        ]);

        if($validation->fails()) {
            return response()->json([
                'status'=>false,
                'errors'=>$validation->errors()->all()
            ], 401);
        }
         // Handle file upload
         $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/categories', $fileName); // 'uploads' is the storage folder
        }

        //$category = Category::create(['name'=>$request->name, 'parent_id'=>$request->parent_id, 'description'=>$request->description, 'url'=>$request->url]);
        $category = Category::create($request->all());
        if($filePath) {
            $category->images()->create(['path'=>$filePath]);
        }
        
        return response()->json($category, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error'=>$th
            ],500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
