<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Support\Facades\Auth;
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:super-admin|admin|setting-manager|list-setting|create-setting|edit-setting|delete-setting,admin'], ['only' => ['index','show']]);
        $this->middleware(['role_or_permission:super-admin|admin|setting-manager|create-setting|edit-setting,admin'], ['only' => ['create','store']]);
        $this->middleware(['role_or_permission:super-admin|admin|setting-manager|edit-setting,admin'], ['only' => ['edit','update']]);
        $this->middleware(['role_or_permission:super-admin|admin|setting-manager|delete-setting,admin'], ['only' => ['destroy']]);
    }

       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();
       
       //  dd($roles, $permissions);


        $settings = Setting::pluck("value","key")->toArray();
     
        return view('admin.settings.general', [
            'settings_info' => $settings
        ]);
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
      
        try{

              //meta tags
              if(isset($request->settings_info)){
                $settings  = $request->settings_info;
                if(count($settings) > 0){
                foreach ($settings as $setting) {
                    $setting_key = $setting['key'];
                    if(isset($setting['value'])){
                        $setting_value = $setting['value'];
                        if($setting_value){
                            Setting::where(['key' => $setting_key])->update([                             
                                'key' => $setting_key,
                                'value' => $setting_value,                           
                            ]);
                        }
                    }
                  }
               }
            }
       
        return redirect()->route('admin.settings.index')
                ->withSuccess('Setting is saved successfully.');

        }catch(\Exception $e){
            $errors = $e->getMessage();
            dd($errors);
            return redirect()->route('admin.settings.index')
            ->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $Setting)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $Setting)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $Setting)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $Setting)
    {
       
    }
}
