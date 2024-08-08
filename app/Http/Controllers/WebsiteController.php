<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Page;
use App\Models\Enquiry;
use App\Models\Client;

class WebsiteController extends Controller
{
    public function index() {
        $sliders = Slider::all();
        $products = Product::all();
        $clients = Client::all();
        return view('template-one.home', compact('sliders', 'products', 'clients'));
    }

    public function getPage(Request $request, $page)
    {
        try {
            $pageData = Page::where('url', $page)->first();
            $template = 'template-one';
            $pageTemplate = $template.'.page';
            return view($pageTemplate, ['page'=>$page, 'pageData'=>$pageData]);
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }


    public function getCategoryData(Request $request, $category)
    {
        try {
            $categoryData = Category::where('url', $category)->with(['products','images'])->withCount('products')->first();
            return view('template-one.shop', ['data'=>$categoryData]);
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }

    public function getProductData(Request $request, $product)
    {
        try {
            $productData = Product::where('id', $product)->with(['images'])->first();
            return view('template-one.productDetails', ['product'=>$productData]);
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }

    public function submitEnquiry(Request $request) {
        try {
            $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'subject' => 'required',
            'message'=>'required' // max 2MB
        ]);

        // $enquiry = Enquiry::create($request->all());
        return redirect()->route('template-one.contact')->with('success', 'Enquiry created successfully!');
        //return redirect()->route('contact');
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }
}
