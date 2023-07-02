<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Tip;

class CategoryController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth_check');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try
        {
           if($request->ajax()) {
                $data = Category::orderBy('order_no','ASC')->select('*');
                return Datatables::of($data)
                        ->addIndexColumn()
                       
                        ->addColumn('action', function($row){

                                                         
                            $btn = "";
                            $btn .= '&nbsp;';
                            $btn .= ' <a href="'.route('categories.show',$row->id).'" class="btn btn-primary btn-sm action-button"><i class="fa fa-edit"></i></a>';

                            $btn .= '&nbsp;';


                              $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-category action-button" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>'; 
        
                                return $btn;
                        })->filter(function ($instance) use ($request) {
                            if ($request->get('search') != "") {
                                 $instance->where(function($w) use($request){
                                    $search = $request->get('search');
                                    $w->orWhere('category_name', 'LIKE', "%$search%");
                                });
                            }

                            if ($request->get('category_type') == 'Free' || $request->get('category_type') == 'VIP') {
                                $instance->where('category_type', $request->get('category_type'));
                            }
                            
                        })
                        ->rawColumns(['action'])
                        ->setRowAttr([
                            'class' => 'row1',
                            'data-id' => function($data) {
                                return $data->id;
                            },
                        ])
                        ->make(true); 
            }
            
            return view('categories.index'); 
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try
        {
           return view('categories.create');
             
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try
        {
            Category::create($request->all());
            $notification=array(
                             'messege'=>"Successfully category has been added",
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        try
        {
           return view('categories.edit', compact('category')); 
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try
        {
           $category->update($request->all());
           $notification=array(
                             'messege'=>"Successfully category has been updated",
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try
        {   
            Tip::where('category_id',$category->id)->delete();
            $category->delete();
            return response()->json('Successfully category has been deleted');
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}
