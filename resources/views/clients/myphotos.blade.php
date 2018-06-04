@extends('layouts.app_cli')
@section('title')
  Myphotos
@endsection
@section('content')


    <div class="container-fluid">
        <div class="row">
            <h2 align="center"> <i class="fa fa-image" aria-hidden="true"></i> MY PHOTOS</h2>
            <h3 align="center"> @include('flash::message')</h3>
            <hr>
        </div>
    </div>

    @foreach($photos->chunk(3) as $photoChunk)
        <div class="container">
            <div class="row">
                @foreach($photoChunk as $photo)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            {{--<img src="{{ $photo->url }}" >--}}
                            <img src="{{ Image::make('img/photos/'.$photo->name)->resize(400,400)->encode('data-url')}}" >
                            {{--<img src="{{ Image::make($photo->url)->resize(400,400)->insert('img/watermark.png','center')->encode('data-url')}}" >--}}
                            <div class="caption">
                                <div class="clearfix">
                                    <a href="{{url('download'.$photo->id)}}" class="btn btn-primary pull-right" role="button">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection

