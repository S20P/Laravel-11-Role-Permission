<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaSetting as SMsetting;
use App\Http\Requests\Admin\SaveSocialMediaSettingRequest;
use Validator;
use Illuminate\Support\Str;

class SocialMediaSettingController extends Controller
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
        $settings = SMsetting::get()->toArray();
        
        return view('admin.settings.social-media.index', [
            'settings_info' => $settings,
            'media_icons' => config('social-media-icons.icons')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($input)
    {
        $index = $input['index'] ?? 1;        
        $blogItemHTML = view('admin.settings.social-media.new-block',["index" => $index, 'media_icons' => config('social-media-icons.icons')])->render();

        return response()->json([
            "success" => true,
            "template" => $blogItemHTML,
            "message" => "success"
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($input)
    {
        try{
                $rules = array(
                    'name.*'  => 'required',
                    'url.*' => 'required',
                    'icon.*' => 'required',
                    'sort_order.*' => 'required',
                );

                $error = Validator::make($input, $rules);
            
                if($error->fails())
                {
                        return response()->json([
                            'error'  => $error->errors()->all()
                        ]);
                }

                $name = $input['name']??[];
                $url = $input['url']??[];
                $icon = $input['icon']??[];
                $sort_order = $input['sort_order']??[];
                $status = $input['status']??[];

                $insert_data = [];

                for($count = 0; $count < count($name); $count++)
                {
                    
                        if(isset($name[$count]) && isset($url[$count]) && isset($icon[$count]) && isset($sort_order[$count]))
                        {

                            $status_value = 0;
                            if(isset($status[$count+1]) && $status[$count+1]=="active"){
                                $status_value = 1;
                            }                    

                            $slug = Str::slug($name[$count]);
                            $data = array(
                                'name' => $name[$count],
                                'slug' => $slug,
                                'url' => $url[$count],
                                'icon' => $icon[$count],
                                'sort_order' => $sort_order[$count],
                                'status' => $status_value
                            );


                            $existingRecord = SMsetting::where('slug', $slug)->first();
                            if (empty($existingRecord)) {
                                // Insert data if no existing record found
                                $insert_data[] = $data; 
                            } else {
                                // Update existing record
                                $existingRecord->update($data);
                            }

                    }
                }

                if(count($insert_data) > 0){
                        SMsetting::insert($insert_data);
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function ajaxRequestData(Request $request)
    {
        if($request->ajax()){
                   $action = $request->action;
                   if($action){
                     switch($action){
                         case "fetch-media-block";
                             return $this->create($request->all());
                         break;
                         case "store";
                             return $this->store($request->all());
                         break;
                     }
                  }              
         }    
    }


}
