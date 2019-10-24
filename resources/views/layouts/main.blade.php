<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mary Kay</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Nunito|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{ asset('/css/mycss.css') }}" rel="stylesheet">


</head>

<body>
    <nav class="navbar navbar-custom navbar-expand-lg shadow-sm">

        <a class="navbar-brand" href="/">
            <img src="https://pbs.twimg.com/profile_images/1682838784/mk2_400x400.png" width="50" height="50" alt="">
            MARY KAY
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#my-nav"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
        </button>

        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                @auth
                @if(auth()->user()->role == 'customer')
                <li class="nav-item active">
                    <a class="nav-link" href='#'>
                        <i class="fa fa-eye"></i> Browse Products
                    </a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="/orderlists">
                        <i class="fa fa-list-ol"></i> Place Order
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exchange"></i> My Transactions
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="/transactions">
                            Pending Orders
                        </a>
                        <a class="dropdown-item" href="/transactions/completed">
                            Completed Order
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-dollar"></i> Payments
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/payments">Pending Payments</a>
                        <a class="dropdown-item" href="#">Completed Order</a>
                    </div>
                </li>
                {{--asample--}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-dollar"></i> Payments
                    </a>
                    <div class="dropdown-menu dropright" aria-labelledby="navbarDropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                Pending Payments
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/payments">Pending Payments</a>
                            <a class="dropdown-item" href="#">Completed Order</a>
                        </div>
                    </div>
                    
                        
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i> Cart</a>
                </li>
                @endif
                @endauth
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}"> LOGIN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">REGISTER</a>
                </li>
                @endguest

                @auth
                @if(auth()->user()->role == 'customer')

                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Welcome {{auth()->user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"> <i class="fa fa-user-circle-o"></i> My Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    @yield('content')

</body>

</html>