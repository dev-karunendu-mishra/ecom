<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $indexView = 'admin.pages.all';
    private $storeRoute = 'admin.pages';
    private $editView = 'admin.pages.edit';
    private $deleteRoute = 'admin.pages';
    private $deleteMessage = 'Page deleted successfully.';
    private $createMessage = 'Page created successfully.';
    private $updateMessage = 'Page updated successfully.';
    
    public $columns = ["id"=>"ID", "title"=>"Page Title", "description"=>"Description", "url"=>"Page URL", "created_at"=>"Created At"];

    public $fields = [
        [
            "id"=>"pageTitle",
            "name"=>"title",
            "type"=>"text",
            "label"=>"Page Title",
            "placeholder"=>"Page Title"
        ],
        [
            "id"=>"pageDescription",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Page Description",
            "placeholder"=>"Page Description"
        ],
        [
            "id"=>"pageURL",
            "name"=>"url",
            "type"=>"text",
            "label"=>"Page URL",
            "placeholder"=>"Page URL"
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Page::all();
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
            'description'=>'required',
            'url'=>'required'
        ]);
        Page::create($request->all());
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
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
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$page, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'required',
            'image'=>'nullable|mimes:png,jpg,jpeg,gif'
        ]);
        $page->update($request->all());
        return redirect()->route($this->storeRoute)->with('success', $this->updateMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
         $page->delete();
        // Redirect to the items index page with a success message
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
