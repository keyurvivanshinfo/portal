<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="icon" href="../assets/images/erp.png" type="image/x-icon"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <!-- <script src="../assets/js/jqueryCDN.js"></script> -->
    <!-- <script src="../assets/js/jquery.js"></script> -->

    <title>Index</title>
</head>

<body>
    <div class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="adminDashboard.php">Portal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">

                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav text-white">


                    </ul>
                </div>
                <div class='justify-content-end text-white'>


                </div>

                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <button class="">
                            <li><a href="{{ url('registration') }}"><span class=" btn btn-primary mr-3">Sign Up</span> </a>
                            </li>
                        </button>
                        <button class="">
                            <li><a href="{{ url('login') }}"><span class="btn btn-primary mr-2">Login</span> </a></li>
                        </button>
                    @else
                        <form action="{{ url('logout') }}" method="post">
                            @csrf
                            <li>
                                <button type="submit"><span class="btn btn-primary mr-2">Log out</span> </button>
                            </li>
                        </form>

                    @endguest


                </ul>
            </div>
        </nav>
    </div>

    <div class="col py-3">
        @if (Session::has('username'))
            <div class="alert alert-danger">
                {{ Session::get('username') }}
            </div>
        @endif
        @yield('content')
    </div>

</body>

</html>
