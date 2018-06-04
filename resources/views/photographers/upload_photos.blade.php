@extends('layouts.app_pho')
@section('title')
    Event
@endsection
@section('content')


    <div class="container">
        <div class="row">
            <h1 align="center">{{$event->name}}</h1>
            @include('flash::message')
                <a href="#adicionar"  data-toggle="modal" type="button" class="btn btn-raised btn-danger  center-block ">Upload photo</a>
        </div>
    </div>

    @foreach($photos->chunk(3) as $photoChunk)
        <div class="container">
            <div class="row">
                @foreach($photoChunk as $photo)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail" align="center">
                            <img src="{{ Image::make('img/photos/'.$photo->name)->resize(400,400)->encode('data-url')}}" >                            <div class="caption">
                                <h3>$us. {{ $photo->price }}</h3>
                                <div class="clearfix">
                                    <a href="#edit"data-toggle="modal"  class="btn btn-warning btn-block" role="button">Edit</a>
                                </div>



                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="adicionar">
        <form  class="form-vertical" action="{{ url('/store_photo'.$event->id) }}" role='form' method="POST" action="" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title"> Upload photo</h2>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Photo: </label>
                                <input type="file" name="photo" required>
                            </div>
                            <label>Price: </label>
                            <input class="form-control" type="number" name="price" required autofocus>
                        </div>
                        <button class="btn btn-danger center-block">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>





@endsection

