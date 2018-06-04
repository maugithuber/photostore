@extends('layouts.app_cli')
@section('title')
    My Cart
@endsection
@section('content')
    @if(Session::has('cart'))
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-8 col-md-offset-2">--}}
                    {{--<div class="panel panel-default">--}}
                        {{--<div class="panel-heading" align="center"><h2> <i class="fa fa-shopping-cart" aria-hidden="true"></i> My Shopping Cart</h2>--}}
                            {{--<div class="panel-body">--}}
                                {{--<div class="panel panel-default">--}}
                                    {{--<div class="panel-body">--}}
                                        {{--<div class="table-responsive" >--}}
                                            {{--<table class="table table-unbordered" >--}}
                                                {{--<thead >--}}
                                                {{--<tr>--}}
                                                    {{--<th><strong>Photo</strong></th>--}}
                                                    {{--<th><strong>Price ($us.) </strong></th>--}}
                                                    {{--<th><strong>Option</strong></th>--}}
                                                {{--</tr>--}}
                                                {{--</thead>--}}
                                                {{--<tbody>--}}
                                                {{--@foreach($products as $product)--}}
                                                    {{--<tr>--}}
                                                        {{--<td>--}}
                                                            {{--<img src="{{ Image::make('img/photos/'.$product['item']['name'])->resize(100,100)->encode('data-url')}}" >--}}
                                                        {{--</td>--}}
                                                        {{--<td> {{$product['price']}}</td>--}}
                                                        {{--<td>--}}
                                                            {{--<a href="{{ url('/remove'.$product['item']['id'] ) }}" class="btn btn-danger btn-sm" role="button">--}}
                                                                {{--<i class="fa fa-trash" aria-hidden="true"></i>--}}
                                                            {{--</a>--}}
                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                {{--@endforeach--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3   ">--}}
                                            {{--<h3>TOTAL : $. {{$totalPrice}}</h3><hr>--}}
                                            {{--<a href="{{ route('payment') }}"><img src="img/paypal.jpg"></a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row">
                                <h2 align="center"> <i class="fa fa-calendar" aria-hidden="true"></i> My Shopping Cart</h2>
                                <h4 align="center"> @include('flash::message')</h4>

                                {{--<a href="#adicionar"  data-toggle="modal" class="btn btn-warning btn-lg btn-block">Subscribe to an Event</a>--}}
                                <hr>
                            </div>
                        </div>
                        <div class="table-responsive" >
                            <table class="table table-hover" class="t">
                                <thead class="danger">
                                <tr class="danger">
                                    <th><strong>Photo</strong></th>
                                    <th><strong>Price </strong></th>
                                    <th><strong>Option</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="primary">
                                        <td>
                                            <img src="{{ Image::make('img/photos/'.$product['item']['name'])->resize(100,100)->encode('data-url')}}" >
                                            </td>
                                        <td> {{$product['price']}}</td>
                                        <td>
                                            <a href="{{ url('/remove'.$product['item']['id'] ) }}" class="btn btn-danger btn-sm" role="button">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                            <h3>TOTAL :  {{$totalPrice}}</h3><hr>
                            {{--<a href="{{ route('payment') }}"><img src="img/paypal.jpg"></a>--}}
                            {{--<a href="{{ route('payment') }}">CHECK OUT with PayPal</a>--}}
                            <a href="{{ route('payment') }}" class="btn btn-primary btn-block" role="button">
                               </i>CHECK OUT with PayPal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @else
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h2>Empty<i class="fa fa-shopping-cart" aria-hidden="true"></i></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection