<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand', 'images'])->get();
        $categories = Category::all();
        $brands = Brand::all();
        // $tags = Tag::all();
        return view('admin.products.all',['products'=>$products,'categories'=>$categories, 'brands'=>$brands, 'edit'=>false]);
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
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            // 'tags' => 'array|exists:tags,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create($request->only(['category_id', 'brand_id', 'name', 'description', 'price']));
        // $product->tags()->sync($request->tags);

        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         $path = $image->store('images', 'public');
        //         $product->images()->create(['path' => $path]);
        //     }
        //      $file = $request->file('image');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = $file->storeAs('uploads/categories', $fileName); 
        // }

        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/products', $fileName); // 'uploads' is the storage folder
        }
        if($filePath) {
            $product->images()->create(['path'=>$filePath]);
        }

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
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
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit',['product'=>$product, 'categories'=>$categories, 'brands'=>$brands,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            // 'tags' => 'array|exists:tags,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update($request->only(['category_id', 'brand_id', 'name', 'description', 'price']));
        // $product->tags()->sync($request->tags);

        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         $path = $image->store('images', 'public');
        //         $product->images()->create(['path' => $path]);
        //     }
        // }

        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/products', $fileName); // 'uploads' is the storage folder
        }
        if($filePath) {
            $product->images()->create(['path'=>$filePath]);
        }
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        // Redirect to the items index page with a success message
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
