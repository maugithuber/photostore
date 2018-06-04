@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data"  method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">type</label>
                            <div class="col-md-6">
                                <select name="type" class="form-control">
                                    <option value="1">Client</option>
                                    <option value="2" >Photographer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="fileupload" class="col-md-4 control-label">Phone</label>
                            <div class="col-md-6">
                                <input  id="phone" type="text"  name="phone" class="form-control" required>
                            </div>
                        </div>



                        <div class="form-group">
                            <label  class="col-md-4 control-label">Photo</label>
                            <div class="col-md-6">
                                <label for="fileupload"> Seleccione una imagen</label>
                                <input  id="photo" type="file"  name="photo" class="form-control" value="photo" accept="image/*" required>
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{--<form action="{{ url('/register') }}" method="post" enctype = "multipart/form-data">--}}
    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}



        {{--<div class="form-group has-feedback">--}}
            {{--<input type="text" class="form-control"  name="username" autofocus/>--}}
            {{--<span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
        {{--</div>--}}


    {{--<div class="form-group has-feedback">--}}
        {{--<input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" value="{{ old('email') }}"/>--}}
        {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
    {{--</div>--}}


    {{--<!--Esto es un comentario-->--}}
    {{--<div class="form-group has-feedback">--}}
        {{--<label for="fileupload"> Seleccione una imagen</label>--}}
        {{--<input type="file"  name="photo" value="photo" accept="image/*"  >--}}
    {{--</div>--}}
    {{--<!--Esto es un comentario-->--}}
    {{--<div class="form-group has-feedback">--}}
        {{--<input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>--}}
        {{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
    {{--</div>--}}
    {{--<div class="form-group has-feedback">--}}
        {{--<input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}" name="password_confirmation"/>--}}
        {{--<span class="glyphicon glyphicon-log-in form-control-feedback"></span>--}}
    {{--</div>--}}
    {{--<div class="row">--}}


        {{--<div class="col-xs-4 col-xs-push-1">--}}
            {{--<button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte_lang::message.register') }}</button>--}}
        {{--</div><!-- /.col -->--}}
    {{--</div>--}}
{{--</form>--}}
@endsection
