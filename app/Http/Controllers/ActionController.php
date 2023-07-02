<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ActionController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth_check');
    }
    
    public function declineVendor(Request $request, $id)
    {
    	try
    	{   
    	
    		$user = User::find($id);
    		$message = $user->declineVendor($id);
    		$notification=array(
                             'messege'=>$message,
                             'alert-type'=>'success'
                            );

            return redirect()->back()->with($notification);
    	}catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function activeVendor(Request $request,$id)
    {
    	try
    	{   
    		$user = User::find($id);
    		$message = $user->activeVendor($id);
    		$notification=array(
                             'messege'=>$message,
                             'alert-type'=>'success'
                            );

            return redirect()->back()->with($notification);
    	}catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

}
