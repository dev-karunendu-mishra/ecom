<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $indexView = 'admin.client.all';
    private $storeRoute = 'admin.clients';
    private $editView = 'admin.client.edit';
    private $deleteRoute = 'admin.clients';
    private $deleteMessage = 'Client deleted successfully.';
    private $createMessage = 'Client created successfully.';
    private $updateMessage = 'Client updated successfully.';
   
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
        return view($this->indexView,['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'clients'=>$clients,'model'=>null]);
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
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
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
        return view($this->editView,['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$client, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
         $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $client->update($request->all());
        
        // Handle file upload
        $filePath=null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/clients', $fileName); // 'uploads' is the storage folder
        }
       
        if($filePath) {
            $client->images()->create(['path'=>$filePath]);
        }
         // Redirect back with a success message
        return redirect()->route($this->storeRoute)->with('success', $this->updateMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route($this->deleteRoute)->with('success', $this->deleteMessage);
    }
}
