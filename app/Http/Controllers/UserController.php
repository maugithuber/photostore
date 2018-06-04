<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Intervention\Image\Facades\Image;
use App\Event;

class UserController extends Controller
{
    
    public function profile(){
        if( Auth::user()->type == 1){
            return view('clients.profile');
        }
            return view('photographers.profile');
    }
    
    public function update_photo(Request $request){
        if($request->hasFile('photo')){
//            $photo = $request->file('photo');
//            $file_name = time().'.'.$photo->getClientOriginalExtension();
//            Image::make($photo)->resize(300,300)->save(public_path('/img/users/'.$file_name));
            $path = 'https://s3-sa-east-1.amazonaws.com/photostorecmpl/'.$request->file('photo')->store('profiles', 's3');
            $user =Auth::user();
            $user->photo= $path;
            $user->save();
        
        }
        if( Auth::user()->type == 1){
            return view('clients.profile');
        }
        return view('photographers.profile');
    }
    
}



