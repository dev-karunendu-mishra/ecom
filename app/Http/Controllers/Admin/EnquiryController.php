<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    private $indexView = 'admin.enquiries.all';
    private $storeRoute = 'admin.enquiries';
    private $editView = 'admin.enquiries.edit';
    private $deleteRoute = 'admin.enquiries';
    private $deleteMessage = 'Enquiry deleted successfully.';
    private $createMessage = 'Enquiry created successfully.';
    private $updateMessage = 'Enquiry updated successfully.';
    
    public $columns = ["id"=>"ID", "name"=>"Name", "email"=>"Email", "subject"=>"Subject","message"=>"Message", "created_at"=>"Created At"];

    public $fields = [
        [
            "id"=>"clientName",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Client's Name",
            "placeholder"=>"Client's Name"
        ],
        [
            "id"=>"clientEmail",
            "name"=>"email",
            "type"=>"email",
            "label"=>"Client's Email",
            "placeholder"=>"Client's Email"
        ],
        [
            "id"=>"clientSubject",
            "name"=>"subject",
            "type"=>"textarea",
            "label"=>"Client's Subject",
            "placeholder"=>"Client's Subject"
        ],
        [
            "id"=>"clientMessage",
            "name"=>"message",
            "type"=>"textarea",
            "label"=>"Client's Message",
            "placeholder"=>"Client's Message"
        ],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Enquiry::all();
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
            'name' => 'required|max:255',
            'email' => 'required',
            'subject' => 'required',
            'message'=>'required' // max 2MB
        ]);

        Enquiry::create($request->all());
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiry $enquiry)
    {
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$enquiry, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
