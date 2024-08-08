<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
   
    public $columns = ["id"=>"ID", "name"=>"Name", "images"=>"Image", "created_at"=>"Created At"];

    public $fields = [
        [
            "id"=>"clientName",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Client's Name",
            "placeholder"=>"Client's Name"
        ],
        [
            "id"=>"clientDescription",
            "name"=>"description",
            "type"=>"textarea",
            "label"=>"Client's Description",
            "placeholder"=>"Client's Description"
        ],
        [
            "id"=>"clientImage",
            "name"=>"image",
            "type"=>"file",
            "label"=>"Client's Image",
            "placeholder"=>"Client's Image"
        ]
    ];

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.client.all',['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'clients'=>$clients,'model'=>null]);
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
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

         // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/clients', $fileName); // 'uploads' is the storage folder
        }
        $client = Client::create($request->all());
        if($filePath) {
            $client->images()->create(['path'=>$filePath]);
        }
         // Redirect back with a success message
        return redirect()->route('admin.clients')->with('success', 'Client '.$client->name.' created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('admin.client.edit',['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$client, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients')->with('success', 'Client deleted successfully.');
    }
}
