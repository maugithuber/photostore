@extends('layouts.app_pho')
@section('title')
    Photographer
@endsection
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <h2 align="center">MY EVENTS</h2>
                            <h4 align="center"> @include('flash::message')</h4>
                            <a href="#adicionar"  data-toggle="modal" class="btn btn-danger btn-lg btn-block">New Event</a>
                            <hr>
                        </div>
                    </div>
                    <div class="table-responsive" >
                        <table class="table table-hover" class="t">
                            <thead class="danger">
                            <tr class="danger">
                                <th>Name</th>
                                <th>Place</th>
                                <th>Date</th>
                                {{--<th>QR code</th>--}}
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr class="primary">
                                    <td><b>{{ $event->name}}</b></td>
                                    <td>{{ $event->place}}</td>
                                    <td>{{ $event->date}}</td>
                                    {{--<td><img src="{{asset($event->qr)}}"></td>--}}
                                    <td>
                                        <a href="{{ url('/view_event'.$event->id) }}" class="btn btn-warning " role="button">Info</a>
                                        <a href="{{ url('/up_photos'.$event->id) }}" class="btn btn-primary " role="button">Photos</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="adicionar">
        <form  class="form-vertical" action="{{ url('/store_event') }}" role='form' method="POST" action="" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title"> Add event</h2>
                        <div class="form-group">
                            <label>Name: </label>
                            <input class="form-control" type="text" placeholder="type name..." name="name" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Place: </label>
                            <input class="form-control" type="text" placeholder="type place..." name="place" required>
                        </div>
                        <div class="form-group">
                            <label>Date: </label>
                            <input class="form-control" type="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label>Type:</label>
                            <select name="type" class="form-control">
                                <option value="1">Public</option>
                                <option value="2" >Private</option>
                            </select>
                        </div>
                        <button class="btn btn-danger btn center-block">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection
