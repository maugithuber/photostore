@extends('layouts.app_cli')
@section('title')
    Client
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <h2 align="center"> <i class="fa fa-calendar" aria-hidden="true"></i> MY EVENTS</h2>
                            <h4 align="center"> @include('flash::message')</h4>

                            <a href="#adicionar"  data-toggle="modal" class="btn btn-warning btn-lg btn-block">Subscribe to an Event</a>
                            <hr>
                        </div>
                    </div>
                    <div class="table-responsive" >
                        <table class="table table-hover" class="t">
                            <thead class="danger">
                            <tr class="danger">
                                <th>Event</th>
                                {{--<th>Place</th>--}}
                                {{--<th>Date</th>--}}
                                {{--<th>Type</th>--}}
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subs as $sub)
                                <tr class="primary">
                                    <td><b>{{ $sub->event->name}}</b></td>
                                    {{--<td>{{ $sub->event->place}}</td>--}}
                                    {{--<td>{{ $sub->event->date}}</td>--}}
                                    {{--<td>--}}
                                    {{--@if( $sub->event->type ==1)--}}
                                        {{--Public--}}
                                        {{--@else--}}
                                        {{--Private--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    <td>
                                        <a href="{{ url('/view_event'.$sub->event->id) }}" class="btn btn-primary"  role="button">Info</a>
                                        <a href="{{ url('/view_photos'.$sub->event->id) }}" class="btn btn-success "  role="button">Photos</a>
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
        <form  class="form-vertical" action="{{url('subscribe')}}" role='form' method="POST" action="" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title center-block"> Subscribe to an Event</h2>
                        <div class="form-group">
                            <label>Event Code: </label>
                            <input class="form-control" type="text" placeholder="type a code..." name="code" required autofocus>
                        </div>
                        <button class="btn btn-warning center-block">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>




@endsection
