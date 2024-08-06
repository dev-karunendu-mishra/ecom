<?php

namespace App\Http\Controllers\API;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $settings = Setting::all();
            return response()->json([
                'data'=>$settings
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'error'=>$th
            ],500);
        }
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
        try {
            $validation = Validator::make($request->all(), [
                'title'=>'required',
                'description'=>'required',
                'domain'=>'required',
                'address'=>'required',
                'mobile'=>'required',
                'email'=>'required',
                'logo'=>'required|mimes:png,jpg,jpeg,gif,svg',
                //'icon'=>'required|mimes:png,jpg,jpeg,ico'
            ]);

            if($validation->fails()) {
                return response()->json([
                    'status'=>false,
                    'errors'=>$validation->errors()->all()
                ], 401);
            }
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
            return response()->json(["settings"=>$setting], 201);

        } catch (\Exception $th) {
            return response()->json([
                'status'=>false,
                'error'=>$th->getMessage()
            ],500);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
