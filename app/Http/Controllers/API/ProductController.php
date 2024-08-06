<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         try {
            $products = Product::with(['category', 'brand', 'images'])->get();
            return response()->json([
                'data'=>$products
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
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'category_id'=>'required',
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
                $filePath = $file->storeAs('uploads', $fileName); // 'uploads' is the storage folder
            }

            $product = Product::create(['name'=>$request->name, 'category_id'=>$request->category_id, 'price'=>$request->price, 'description'=>$request->description,'product_image'=>$filePath]);
            return response()->json(["products"=>$product], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'error'=>$th
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
