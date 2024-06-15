<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
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
                    
                        $setting_value = $setting['value'];
                            $matchkeys = ['key' => $setting_key];
                            if($setting_value=="<p><br></p>" || $setting_value==null){
                                $setting_value = "";
                            }


                            if($setting_value instanceof UploadedFile && $setting_value->isValid())
                            {
                                    $icon_file =$setting_value;                                    
                                    $filename = "meta".time() . '.' .  $icon_file->getClientOriginalExtension();
                                    $imageStorePath = public_path('uploads/');
                                    $icon_file->move($imageStorePath, $filename);
                                    $setting_value = $filename;
                            }  

                            Setting::updateOrCreate($matchkeys,[                             
                                'key' => $setting_key,
                                'value' => $setting_value,                           
                            ]);
                        
                    
                  }
               }
            }
       
        return redirect()->route('admin.settings.index')
                ->withSuccess('Setting is saved successfully.');

        }catch(\Exception $e){
            $errors = $e->getMessage();
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

    public function updateThroughAjax($input){
          try{

            $key = $input['key'];
            $value = $input['value'];

            $setting = Setting::where('key',$key)->first();
            if(!Empty($setting))
            {
                $setting->value = $value;
                $setting->save();
            }
     
            
            return response()->json([
                'success'  => 'Data Saved Successfully.'
            ]);

          }catch(\Exception $e){
            $errors = $e->getMessage();
            return response()->json([
                'error'  => $errors
               ]);
          }
    }

    public function ajaxRequestData(Request $request)
    {
        if($request->ajax()){
                   $action = $request->action;
                   if($action){
                     switch($action){
                         case "update-setting-through-key";
                             return $this->updateThroughAjax($request->all());
                         break;
                        
                     }
                  }              
         }    
    }
    
}
