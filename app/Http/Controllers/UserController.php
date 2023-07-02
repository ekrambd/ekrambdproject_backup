<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use DataTables;
class UserController extends Controller
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
                $data = User::where('role', 'vendor')->select('*');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status', function($row){
                            if($row->status == 'Active')
                            {
                                return "<span class='badge badge-primary p-2'>" . $row->status . "</span>";
                            }
                            else
                            {
                                return "<span class='badge badge-danger p-2'>" . $row->status . "</span>";
                            }
                        })
                       
                        ->addColumn('action', function($row){

                            if($row->status == 'Active')
                            {
                                $btn = ' <a href="#" class="btn btn-danger btn-sm decline-user action-button" data-id="'.$row->id.'"><i class="fa fa-ban"></i></a>';
                            }
                            else
                            {
                                $btn = '<button type="button" class="btn btn-info btn-sm active-user action-button" data-id="'.$row->id.'"><i class="fa fa-check"></i></button>';
                            }
                             
                             

                            $btn .= '&nbsp;';
                            $btn .= ' <a href="'.route('users.show',$row->id).'" class="btn btn-primary btn-sm action-button"><i class="fa fa-edit"></i></a>';

                            $btn .= '&nbsp;';


                              $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-vendor action-button" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>'; 
        
                                return $btn;
                        })->filter(function ($instance) use ($request) {
                            if ($request->get('search') != "") {
                                 $instance->where(function($w) use($request){
                                    $search = $request->get('search');
                                    $w->orWhere('name', 'LIKE', "%$search%")
                                    ->orWhere('email', 'LIKE', "%$search%")
                                    ->orWhere('phone', 'LIKE', "%$search%");
                                });
                            }

                            if ($request->get('status') == 'Decline' || $request->get('status') == 'Active') {
                                $instance->where('status', $request->get('status'));
                            }
                            
                        })
                        ->rawColumns(['action', 'status'])
                        ->make(true); 
            }
            
            return view('vendors.index');
           
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
            return view('vendors.create');
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
    public function store(RegisterUserRequest $request)
    {
        try
        {
            $user = new User();
            $message = $user->storeVendor($request);  
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $vendor = User::find($id);
            return view('vendors.edit', compact('vendor'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try
        {   
            $message = $user->updateUser($request,$user);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try
        {
             $message = $user->deleteVendor($user);
             return response()->json($message);

        }catch(Exception $e){
                  
                $message = $e->getMessage();
      
                $code = $e->getCode();       
      
                $string = $e->__toString();       
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}
