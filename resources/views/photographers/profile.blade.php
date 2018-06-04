@extends('layouts.app_pho')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center"><h1><i class="fa fa-user" aria-hidden="true"></i> PROFILE</h1></div>

                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Photo:</label>
                            <div class="col-md-6">:
                                <img  src="https://s3.amazonaws.com/photovirginia/{{Auth::user()->photo}}" style="width:330px; height:333px; float:left;border-radius:50%; margin-right:25px" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name:</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{Auth::user()->name}}"disabled required autofocus >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address:</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{Auth::user()->email}}"disabled required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="fileupload" class="col-md-4 control-label">Phone:</label>
                            <div class="col-md-6">
                                <input  id="phone" type="text"  name="phone"  value="{{Auth::user()->phone}}" class="form-control" disabled required>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
