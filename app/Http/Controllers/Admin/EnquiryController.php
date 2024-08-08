<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
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
        return view('admin.enquiries.all',['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'records'=>$records,'model'=>null]);
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
            'name' => 'required|max:255',
            'email' => 'required',
            'subject' => 'required',
            'message'=>'required' // max 2MB
        ]);

         // Handle file upload
        // $filePath=null;
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = $file->storeAs('uploads/categories', $fileName); // 'uploads' is the storage folder
        // }
        //$category = Category::create(['name'=>$request->name, 'parent_id'=>$request->parent_category_id, 'description'=>$request->description]);
        $enquiry = Enquiry::create($request->all());
        // if($filePath) {
        //     $category->images()->create(['path'=>$filePath]);
        // }
         // Redirect back with a success message
        return redirect()->route('admin.enquiries')->with('success', 'Enquiry created successfully!');
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
        return view('admin.client.edit',['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$enquiry, 'edit'=>true]);
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
        return redirect()->route('admin.enquiries')->with('success', 'Enquiry deleted successfully.');
    }
}
