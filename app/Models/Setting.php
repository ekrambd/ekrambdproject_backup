<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Setting extends Model
{
    use HasFactory;

    public function appSettings(Request $request, $setting)
    {
    	if($request->file('app_logo'))
    	{    
    		$app_logo = $request->file('app_logo');
    		$name = time().$app_logo->getClientOriginalName();
            $app_logo->move(public_path().'/uploads/settings/', $name); 
            $path = 'public/uploads/settings/'.$name;
    	}
    	else
    	{
    		$path = $setting->app_logo;
    	}

    	$setting->app_name = $request->app_name;
    	$setting->app_logo = $path;
    	$setting->update();

    	$message = "Successfully app has been updated";

    	return $message;

    }

    public function adsSettings(Request $request, $setting)
    {
        $setting->select_ads = $request->select_ads;
        $setting->admob_app_id = $request->admob_app_id;
        $setting->admob_banner_id = $request->admob_banner_id;
        $setting->admob_native_id = $request->admob_native_id;
        $setting->abmob_interstial_id = $request->abmob_interstial_id;
        $setting->startio_app_id = $request->startio_app_id;
        $setting->applovin_app_id = $request->applovin_app_id;
        $setting->applovin_banner_id = $request->applovin_banner_id;
        $setting->applovin_native_id = $request->applovin_native_id;
        $setting->applovin_interstial_id = $request->applovin_interstial_id;
        $setting->update();
        $message = "Successfully ads has been updated";

        return $message;
    }
}
