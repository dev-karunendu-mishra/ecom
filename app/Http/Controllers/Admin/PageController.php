<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $pages = Page::all();
        return view('admin.pages.all-pages',['pages'=>$pages, 'edit'=>false]);
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
            'description'=>'required',
            'url'=>'required',
            // 'image'=>'required|mimes:png,jpg,jpeg,gif'
        ]);
            
            // // Handle file upload
            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('uploads', $fileName); // 'uploads' is the storage folder
            // }

        $page = Page::create($request->all());
        return redirect()->route('admin.pages')->with('success', 'Page added successfully!');
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
        return view('admin.pages.edit',['page'=>$page, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
         $validatedData = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'required',
            'image'=>'nullable|mimes:png,jpg,jpeg,gif'
        ]);
            
            // // Handle file upload
            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('uploads', $fileName); // 'uploads' is the storage folder
            // }

        //$page = Page::create(['title'=>$request->title, 'description'=>$request->description, 'url'=>$request->url]);
        $page->update($request->all());
        return redirect()->route('admin.pages')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
         $page->delete();
        // Redirect to the items index page with a success message
        return redirect()->route('admin.pages')->with('success', 'Page deleted successfully.');
    }
}
