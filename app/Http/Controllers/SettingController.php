<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\PasswordChangeRequest;
use Auth;
use App\Models\User;
class SettingController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth_check');
    }
    
    public function appSettings()
    {
    	try
    	{
    		return view('app_settings');
    	}catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function settingsApp(SettingRequest $request)
    {
        try
        {
            $setting = Setting::find(1); 
            $message = $setting->appSettings($request,$setting);
            $notification=array(
                             'messege'=>$message,
                             'alert-type'=>'success'
                            );

            return Redirect()->back()->with($notification);
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function accountSettings()
    {
        try
        {
            return view('account_settings');   
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function settingAccount(UpdateUserRequest $request)
    {
        try
        {
            $user = User::find(Auth::user()->id);
            $message = $user->updateAccount($request,$user);
            $notification=array(
                             'messege'=>$message,
                             'alert-type'=>'success'
                            );

            return Redirect()->back()->with($notification);
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function adsSetting()
    {
        try{
          return view('ads_settings');
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }   
    }

    public function settinngsAd(Request $request)
    {
        try
        {
            $setting = Setting::find(1); 
            $message = $setting->adsSettings($request,$setting);
            $notification=array(
                             'messege'=>$message,
                             'alert-type'=>'success'
                            );

            return Redirect()->back()->with($notification);

        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        } 
    }

    public function changePassword()
    {
        try
        {
           return view('change_password'); 
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function passwordChange(PasswordChangeRequest $request)
    {
        try
        {
            $user = User::find(Auth::user()->id);
            $message = $user->changePassword($request,$user);
            $notification=array(
                             'messege'=>$message['message'],
                             'alert-type'=>$message['type']
                            );

            return Redirect()->back()->with($notification);

        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}
