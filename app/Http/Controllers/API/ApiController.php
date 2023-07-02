<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use DB;
use Auth;
use App\Models\Category;
use App\Models\Tip;
class ApiController extends Controller
{
    
    public function categories()
    {
        try
        {
            if(count(allCategory()) > 0)
            {
                return response(['status'=>true, 'message'=>'Data found', 'total'=>count(allCategory()), 'data'=>allCategory()]);
            }
            return response(['status'=>false, 'message'=>'No data found', 'total'=>count(allCategory()), 'data'=>allCategory()]);

        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function getCategory($category_type)
    {
        try 
        {
            if(count(categories($category_type)) > 0)
            {
                return response(['status'=>true, 'message'=>'Data found', 'total'=>count(categories($category_type)), 'data'=>categories($category_type)]);
            }
            return response(['status'=>false, 'message'=>'No data found', 'total'=>count(categories($category_type)), 'data'=>categories($category_type)]);
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function categoryDetails($id)
    {
        try
        {
            $category = Category::find($id);


          $tips = array();
          foreach(Tip::where('category_id',$id)->get() as $tip)
          {
              $tips[] = $tip;
          }

          $data = ['id'=>$category->id, 'category_type'=>$category->category_type, 'category_name'=>$category->category_name, 'tips'=>$tips];

          if(count($tips) > 0)
          {
             return response()->json(['status'=>true, 'message'=>'Data found', 'total'=>count($tips), 'data'=>$data]);
          }
          return response()->json(['status'=>false, 'message'=>'No data found', 'total'=>count($tips), 'data'=>$data]);
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    public function tips()
    {
        try
        {    

         $tips = array();
        $category_ids = Tip::pluck('category_id')->toArray();
        foreach(Category::whereIn('id',$category_ids)->orderBy('order_no','ASC')->get() as $category)
        {
            $tipsArr = array();
            foreach(Tip::where('category_id',$category->id)->get() as $tip)
            {
                $tipsArr[] = $tip;
            }
            $tips[] = ['id'=>$category->id, 'category_type'=>$category->category_type, 'category_name'=>$category->category_name, 'tips'=>$tipsArr];
        }

             if(count($tips) > 0)
             {
                return response(['status'=>true, 'message'=>'Data found', 'total'=>count(Tip::all()), 'data'=>$tips]);
             }
             return response(['status'=>false, 'message'=>'No data found', 'total'=>count($tips), 'data'=>$tips]);
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

}
 