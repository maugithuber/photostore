<?php

namespace App\Http\Controllers;

use App\Client;
use App\Event;
//use Aws\Rekognition\RekognitionClient;
use App\Mail\MyMail;
use App\User;

use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
    use Intervention\Image\Facades\Image;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Intervention\Image\Facades\Image;
use Larareko\Rekognition\Rekognition;
class PhotoController extends Controller
{
    public function view_photos($id)
    {
        $event = Event::find($id);
        $photos = Photo::all()->where('event_id',$id);
        return view('clients.view_photos')->with(['event'=>$event,'photos'=>$photos]);
    }
    public function upload_photos($id)
    {
        $event = Event::find($id);
        $photos = Photo::all()->where('event_id',$id);
        return view('photographers.upload_photos')->with(['event'=>$event,'photos'=>$photos]);
    }

    public function store(Request $request,$id,Mailer $mailer)
    {
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $file_name = $photo->getClientOriginalName();
            $path = $request->file('photo')->store('photos', 's3');
            $client = new Rekognition();
            $client =$client->getClient();
            $p=Storage::disk('s3')->get($path);
            $p=base64_encode($p);
            $event = Event::find($id);
            $result=$client->indexFaces([
                'CollectionId' => 'myphotos',
                'DetectionAttributes' => [
                ],
                'ExternalImageId' =>'id'.$file_name,
                'Image' => [
                    'Bytes'=>base64_decode($p),
                ],
            ]);


//            Image::make($photo)->save(public_path('/img/photos/'.$file_name));
            Image::make($photo)->save('img/photos/'.$file_name);
            $photo = new Photo();
            $photo->price = $request->price;
            $photo->url= $path;
            $photo->event_id=$id ;
            $photo->name=$file_name;
            $photo->image_id= $result['FaceRecords']['0']['Face']['ImageId'];
            $photo->save();
        }
        $photos = Photo::all()->where('event_id',$id);

        //notificaciones
        $users=User::where('type',1)->get(); //client profiles
        foreach ($users as $user){
            $u=Storage::disk('s3')->get($user->photo);
            $u=base64_encode($u);
            $comp = $client->compareFaces([
                'SimilarityThreshold' => 70,
                'SourceImage' => [
                    'Bytes'=>base64_decode($u),
                ],
                'TargetImage' => [
                    'Bytes'=>base64_decode($p),
                ],
            ]);
            if(($comp['FaceMatches']!=[])){
                $mailer->to($user->email)->send(new MyMail());
            }
        }

        flash('photo succesfully uploaded')->success();
        return view('photographers.upload_photos')->with(['photos'=>$photos,'event'=>$event]);
    }

    public function send(Mailer $mailer){
        $mailer->to('ingmauriciopl@gmail.com')
            ->send(new MyMail());
        return redirect()->back();
    }
    public function download($id)
    {
        $photo = Photo::find($id);
        $pathtoFile = 'img/photos/'.$photo->name;
        return response()->download($pathtoFile);
    }

    public function filter($event_id)
    {
        $client = new Rekognition();
        $client =$client->getClient();

        $event= Event::find($event_id);

//        $c=Client::where('user_id',Auth::user()->id)->first();
        $cli=Storage::disk('s3')->get(Auth::user()->photo);
        $cli=base64_encode($cli);

        $result = $client->searchFacesByImage([
            'CollectionId' => 'myphotos',
            'Image' => [
                'Bytes'=>base64_decode($cli),
            ],
            'FaceMatchThreshold' => 60,
            'MaxFaces' => 100,
        ]);
//        dd($result);
//dd($result['FaceMatches']['0']['Face']['FaceId']);
        $photos = collect();
//        $photos = array[];
        foreach ($result['FaceMatches'] as $r){
            $e = Photo::where('image_id',$r['Face']['ImageId'])->where('event_id','=',$event_id)->first();
            if($e!= null){
                $photos->push($e);
            }
        }
//        dd($photos);
        return view('clients.view_photos')->with(['event'=>$event,'photos'=>$photos]);
    }
    
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
