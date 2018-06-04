<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to Photostore</title>
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #954120;
            color: #FFFFFF;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100%;
            margin: 0;
            box-sizing: border-box;
            background: url('img/wall.jpg') repeat-y center 0;
            background-size: cover;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 50px;
        }

        .links > a {
            color: #FFFFFF;
            padding: 0 25px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 25px;
        }

    </style>
</head>
<body background="all.png" >
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="row">
            <div class="title m-b-md"> PhotoStore  </div>
            <div class="links">
                @if (Route::has('login'))
                    <div class="links">
                        @if (Auth::check())
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/login') }}">Log in</a>
                            <a href="{{ url('/register') }}">Register</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</body>





</html>
