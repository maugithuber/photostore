@extends('layouts.app_pho')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">
                        <h2> EVENT INFO </h2>
                    </div>

                        <header class="header b-b b-light hidden-print">
                            <button href="#" class="btn btn-block btn-success pull-right" onClick="window.print();">Print</button>
                        </header>
                    <hr>

                    <div class="panel-body">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name:</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$event->name}}"disabled required autofocus >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Place:</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$event->place}}"disabled required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label  class="col-md-4 control-label">Date:</label>
                            <div class="col-md-6">
                                <input  id="phone" type="text"  name="phone"  value="{{$event->date}}" class="form-control" disabled required>
                            </div>
                        </div>
                        <div class="form-group" align="center">
                            <img  src="{{$event->qr}}" >
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
