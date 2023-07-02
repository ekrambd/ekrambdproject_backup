<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AjaxController extends Controller
{
    public function getCategory(Request $request)
    {
    	try
    	{
    	   $categories = Category::where('category_type',$request->category_type)->latest()->get();
    	   return view('ajax.categories', compact('categories'));
    	}catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }


    public function customSortable(Request $request)
    {
        try
        {   
            $data = array();
            foreach($request->order as $order)
            {
                foreach(allCategory() as $category)
                {
                    if($category->id == intval($order['id']))
                    {
                        Category::where('id',intval($order['id']))->update(['order_no'=>intval($order['position'])]);
                    }
                }
            }

            return response()->json('updated');

        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }


   public function getCategoryType(Request $request)
   {
        try
        {
           $category = Category::find($request->category_id);

           return response()->json($category);
            
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
   }
}
