<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function updateAccount(Request $request,$user)
    {   
          if($request->file('image'))
          {    
            $image = $request->file('image');
            $name = time().$image->getClientOriginalName();
                $image->move(public_path().'/uploads/settings/', $name); 
                $path = 'public/uploads/settings/'.$name;
                unlink($user->image);
          }
          else
          {
             $path = $user->image;
          }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $path;
        $user->update();
        
        Setting::where('id',1)->update(['footer_text'=>$request->footer_text]);

        $message = "Successfully your accout info has been updated";
        return $message;
    }

    public function changePassword(Request $request,$user)
    {
        if (!Hash::check($request->current_password, $user->password)) {
            
           return $message = ['message'=>'The current password is incorrect.', 'type'=>'error'];
        }

        $user->password = Hash::make($request->new_password);
        $user->update();

        return $message = ['message'=>'Your password has been changed', 'type'=>'success'];
    }

}
