<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AndroidController extends Controller
{

    public function login(Request $request){
        $user=DB::table('users as u')
            ->select('u.id','u.name','u.email','u.password')
            ->where('u.type',1)
            ->where('u.email',$request['email'])
            ->first();
//        dd($user);
        if($user){
            $pass=$request['password'];
            if(Hash::check($pass,$user->password)){
                return new JsonResponse(array('token'=>200,'user'=>$user));
            }else{
                return new JsonResponse(array('token'=>1));
            }
        }else{
            return new JsonResponse(array('token'=>0));
        }
    }
    
    public function register(Request $request){
        $user=DB::table('users as u')
            ->select('u.id','u.name','u.email','u.password')
            ->where('u.type',1)
            ->where('u.email',$request['email'])
            ->first();
//        dd($user);
        if($user){
            $pass=$request['password'];
            if(Hash::check($pass,$user->password)){
                return new JsonResponse(array('token'=>200,'user'=>$user));
            }else{
                return new JsonResponse(array('token'=>1));
            }
        }else{
            return new JsonResponse(array('token'=>0));
        }
    }






    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
