<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaSetting as SMsetting;
use App\Http\Requests\Admin\StoreAdInserterRequest;
use App\Http\Requests\Admin\UpdateAdInserterRequest;
use App\Models\AdInserterSetting;
use Validator;

use Illuminate\Support\Str;
class AdInserterController extends Controller
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
        $settings = AdInserterSetting::limit(100)->get()->toArray();
        return view('admin.settings.ad-inserter.index', [
            'settings_info' => $settings,            
            'pageTypes' => config('ad_settings.page_types'),
            'positions' => config('ad_settings.positions'),
            'alignment' => config('ad_settings.alignment'),
        ]);
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
        try{

            $input = $request->all();
            $key = $input['key']??[];
            $value_block = $input['value_block']??[];
            $page_type = $input['page_type']??[];
            $position = $input['position']??[];
            $alignment = $input['alignment']??[];
            $insert_data = [];

            for($count = 0; $count < 100; $count++)
            {
                if(isset($key[$count]) && isset($value_block[$count]) && isset($page_type[$count]) && isset($position[$count]) && isset($alignment[$count]))
                {

                    $page_type_string = implode(',', $page_type[$count]);

                    $data = array(
                        'key' => $key[$count],
                        'value' => $value_block[$count],
                        'page_type' => $page_type_string,
                        'position' => $position[$count],
                        'alignment' => $alignment[$count]                       
                    );
                    $existingRecord = AdInserterSetting::where('key', $key[$count])->first();
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
                AdInserterSetting::insert($insert_data);
             }
           
     
      return redirect()->route('admin.ad-inserter-settings.index')
              ->withSuccess('Setting is saved successfully.');

      }catch(\Exception $e){
          $errors = $e->getMessage();
          return redirect()->route('admin.ad-inserter-settings.index')
          ->withErrors($errors);
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
}
