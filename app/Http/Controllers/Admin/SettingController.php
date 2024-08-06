<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  $pages = Page::all();
        $settings = Setting::first();
        return view('admin.settings.create',['settings'=>$settings,'edit'=>false]);
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
            'title'=>'required',
            'description'=>'required',
            'domain'=>'required',
            'address'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'logo'=>'required|mimes:png,jpg,jpeg,gif,svg',
        ]);
            // Handle file upload
        $logo=null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $logo = $file->storeAs('uploads/logo', $fileName); // 'uploads' is the storage folder
        }
        
        $icon=null;
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $icon = $file->storeAs('uploads/logo', $fileName); // 'uploads' is the storage folder
        }

        $setting = Setting::create(['title'=>$request->title, 'description'=>$request->description, 'domain'=>$request->domain, 'address'=>$request->address,'mobile'=>$request->mobile, 'email'=>$request->email, 'logo'=>$logo, 'icon'=>$icon, 'facebook'=>$request->facebook,'twitter'=>$request->twitter,'linkedin'=>$request->linkedin,'instagram'=>$request->instagram,'youtube'=>$request->youtube]);
        return redirect()->route('admin.settings')->with('success', 'Website settings added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        // $validatedData = $request->validate([
        //     'title'=>'required',
        //     'description'=>'required',
        //     'domain'=>'required',
        //     'address'=>'required',
        //     'mobile'=>'required',
        //     'email'=>'required',
        //     'logo'=>'required|mimes:png,jpg,jpeg,gif,svg',
        // ]);
            // Handle file upload
        $logo=null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $logo = $file->storeAs('uploads/logo', $fileName); // 'uploads' is the storage folder
        }
        
        $icon=null;
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $icon = $file->storeAs('uploads/logo', $fileName); // 'uploads' is the storage folder
        }

        $newSetting = [
            'title'=>$request->title,
            'description'=>$request->description,
            'domain'=>$request->domain,
            'address'=>$request->address,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linkedin'=>$request->linkedin,
            'instagram'=>$request->instagram,
            'youtube'=>$request->youtube
        ];

        if($logo) {
            $newSetting['logo'] = $logo;
        }

        if($icon) {
            $newSetting['icon'] = $icon;
        }


        $setting->update($newSetting);
        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
