<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        body {
            background-color: lightyellow,
        }

        
    </style>

    <title>Index</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <div class="container-fluid ">
            <b class="mt-1"><a class="navbar-brand" href="{{ route('userDashboard') }}">
                    <h3>Creative_.ks</h3>
                </a></b>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('userDashboard') }}">Home</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li> --}}
                </ul>
                {{-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> --}}
            </div>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-transparant">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('userDashboard') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        

                        <li>
                            <a href="{{ url('userUploadImage') }}" class="nav-link px-0 align-middle"> <i class="fs-4 bi-cloud-arrow-up-fill"></i><span
                                class="ms-2 d-none d-sm-inline">Upload Images</span> </a>
                        </li>


                        <li>
                            <a href="{{route('viewMyImages')}}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">View Images</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span
                                    class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Item</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Item</span> 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Product</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Product</span> 2</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Product</span> 3</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Product</span> 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4 text-dark">

                        {{-- <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle"> --}}
                        <button class="btn btn-outline-dark"><span class="d-none d-sm-inline mx-1 text-primary"> <i class="fs-4 bi-people ">   </i>
                                <b class="text-primary">
                                    {{ Session::get('username') }}</b></span>
                            <hr>
                            <a class="dropdown-item text-primary" href="{{ route('editUserByUserView') }}">Profile</a>
                            <hr>
                            <a class="dropdown-item text-primary" onclick="retun con()"
                                href="{{ route('logout') }}">Sign out</a>
                        </button>

                        </a>


                    </div>
                </div>
            </div>
            <div class="col py-3">
                @if (Session::has('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        function con() {
            let c = confirm("Are you Sure");
            if (c) {
                return true;
            } else {
                return false;
            }
        }
    </script>

</body>

</html>
