@extends('layouts.app_cli')
@section('title')
    Photostore
@endsection
@section('content')
    <div class="container">

            <h2 align="center">Event: <b>{{$event->name}}</b></h2>
            <a href="{{url('filter'.$event->id)}}" class="btn btn-danger center-block" role="button">Filter photos where I appear</a>
    </div>

    @foreach($photos->chunk(3) as $photoChunk)
        <div class="container">
            <div class="row">
                @foreach($photoChunk as $photo)
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="{{ Image::make('img/photos/'.$photo->name)->resize(400,400)->insert('img/watermark3.png','center')->encode('data-url')}}" >
                                <div class="caption" align="center">
                                    <h3>$us. {{ $photo->price }}</h3>
                                    <div class="clearfix">

                                        <a href="{{url('add_cart'.$photo->id)}}"  onclick="disable()" class="btn btn-success  btn-block" role="button">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection

