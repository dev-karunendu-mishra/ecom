<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public $columns = ["id"=>"ID", "name"=>"Name", "email"=>"Email"];

    public $fields = [
        [
            "id"=>"name",
            "name"=>"name",
            "type"=>"text",
            "label"=>"Subscriber's Name",
            "placeholder"=>"Subscriber's Name"
        ],
        [
            "id"=>"email",
            "name"=>"email",
            "type"=>"email",
            "label"=>"Subscriber's Email",
            "placeholder"=>"Subscriber's Email"
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Subscriber::all();
        return view('admin.subscriber.all',['columns'=>$this->columns,'fields'=>$this->fields,'edit'=>false,'records'=>$records,'model'=>null]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ]);

        Subscriber::create($request->all());
        return redirect()->route('admin.subscribers')->with('success', 'Subscriber added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriber $subscriber)
    {
        return view('admin.subscriber.edit',['columns'=>$this->columns,'fields'=>$this->fields, 'model'=>$subscriber, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return redirect()->route('admin.subscribers')->with('success', 'Subscriber deleted successfully.');
    }
}
