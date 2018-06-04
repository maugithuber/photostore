<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Photographer;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Intervention\Image\Facades\Image;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Larareko\Rekognition\Rekognition;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required',
            'photo'=>'required',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['type']==1) { //CLIENTE
            $file_name = $data['photo']->getClientOriginalName();
            $path = $data['photo']->store('profiles', 's3');
            $client = new Rekognition();
            $client =$client->getClient();
            $p=Storage::disk('s3')->get($path);
            $p=base64_encode($p);

            $faces=$client->indexFaces([
//                'CollectionId' => 'myphotos',
                'CollectionId' => 'profiles',
                'DetectionAttributes' => [
                ],
                'ExternalImageId' =>'id'.$file_name,
                'Image' => [
                    'Bytes'=>base64_decode($p),
                ],
            ]);


            $fields = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'type' => $data['type'],
                'photo'=>$path,
            ];
            $user = User::create($fields);

            $client = new Client();
            $client->face_id =$faces['FaceRecords']['0']['Face']['FaceId'];
            $client->user_id=$user->id;
            $client->save();

        }else{// PHOTOGRAPHER
            $path = $data['photo']->store('profiles', 's3');

            $fields = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'type' => $data['type'],
                'photo'=>$path,
                'face_id'=>'X',
            ];

            $user = User::create($fields);
            $photographer = new Photographer();
            $photographer->user_id =$user->id;
            $photographer->save();

        }
        return $user;

    }

    public function redirectPath()
    {
        return '/home';
//        switch (auth()->user()->type) {
//            case 1:
//                return '/home_cli';
//                break;
//            case 2:
//                return '/photographers/home_pho';
//                break;
//        }
    }
}
