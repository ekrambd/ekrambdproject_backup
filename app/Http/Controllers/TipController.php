<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;
use DataTables;
class TipController extends Controller
{
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
                $data = Tip::join('categories', 'tips.category_id', 'categories.id')
                            ->select('tips.*', 'categories.category_name');
                return Datatables::of($data)
                        ->addIndexColumn()
                        
                        ->addColumn('action', function($row){

                                                         
                            $btn = "";
                            $btn .= '&nbsp;';
                            $btn .= ' <a href="'.route('tips.show',$row->id).'" class="btn btn-primary btn-sm action-button"><i class="fa fa-edit"></i></a>';

                            $btn .= '&nbsp;';


                              $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-tip action-button" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>'; 
        
                                return $btn;
                        })->filter(function ($instance) use ($request) {
                            if ($request->get('search') != "") {
                                 $instance->where(function($w) use($request){
                                    $search = $request->get('search');
                                    $w->orWhere('tips.tips_name', 'LIKE', "%$search%")
                                     ->orWhere('tips.league_name', 'LIKE', "%$search%"); 
                                });
                            }


                            if ($request->get('category_type') == 'Free' || $request->get('category_type') == 'VIP') {
                                $instance->where('tips.category_type', $request->get('category_type'));
                            }

                            if($request->category_id != '')
                            {
                                $instance->where('tips.category_id', $request->get('category_id'));
                            }

                            if($request->filter_section != '')
                            {
                                if($request->filter_section == 'today')
                                {
                                    $instance->where('tips.date', today());
                                }


                                if($request->filter_section == 'this_month')
                                {
                                    $instance->whereMonth('tips.date', date('m'));
                                }

                            }
                            
                        }) 
                        ->rawColumns(['action','date'])
                        ->make(true); 
            }
            
            return view('tips.index'); 
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
           return view('tips.create');
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
    public function store(Request $request)
    {
        try
        {   
       

            Tip::create($request->all());
             $notification=array(
                             'messege'=>"Successfully tips has been added",
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
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function show(Tip $tip)
    {
        try
        {
           return view('tips.edit', compact('tip')); 
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
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function edit(Tip $tip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tip $tip)
    {
        try
        {
           $tip->update($request->all());
            $notification=array(
                             'messege'=>"Successfully tips has been updated",
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
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tip $tip)
    {
        try
        {
            $tip->delete();
            return response()->json('Successfully tip has been deleted');
        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}
