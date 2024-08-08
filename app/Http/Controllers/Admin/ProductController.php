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

    private $indexView = 'admin.products.all';
    private $storeRoute = 'admin.products';
    private $editView = 'admin.products.edit';
    private $deleteRoute = 'admin.products';
    private $deleteMessage = 'Product deleted successfully.';
    private $createMessage = 'Product created successfully.';
    private $updateMessage = 'Product updated successfully.';

    private $columns = ["id"=>"ID", "name"=>"Name", "images"=>"Image","category_id"=>"Category","brand_id"=>"Brand", "price"=>"Price", "created_at"=>"Created At"];

    private $fields = [
        [
            "id"=>"name",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Product's Name",
            "placeholder"=>"Product's Name"
        ],
        [
            "id"=>"description",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Product's Description",
            "placeholder"=>"Product's Description"
        ],
        "category_id"=>[
            "id"=>"category",
            "name"=>"category_id",
            "type"=>"select",
            "label"=>"Product's Category",
            "placeholder"=>"Product's Category"
        ],
        "brand_id"=>[
            "id"=>"brand",
            "name"=>"brand_id",
            "type"=>"select",
            "label"=>"Product's Brand",
            "placeholder"=>"Products's Brand"
        ],
        [
            "id"=>"price",
            "name"=>"price",
            "type"=>"text",
            "label"=>"Product's Price",
            "placeholder"=>"Product's Price"
        ],
        [
            "id"=>"productImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Product Image",
            "placeholder"=>"Product Image"
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Product::with(['category', 'brand', 'images'])->get();
        $categories = Category::all();
        $brands = Brand::all();
        $this->fields['category_id']['options'] = $categories;
        $this->fields['brand_id']['options'] = $brands;
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
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            // 'tags' => 'array|exists:tags,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create($request->all());
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

        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
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
        $this->fields['category_id']['options'] = $categories;
        $this->fields['brand_id']['options'] = $brands;
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$product, 'edit'=>true, 'categories'=>$categories]);
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

        $product->update($request->all());

        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/products', $fileName); // 'uploads' is the storage folder
        }
        if($filePath) {
            $product->images()->create(['path'=>$filePath]);
        }
        return redirect()->route($this->storeRoute)->with('success', $this->updateMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
