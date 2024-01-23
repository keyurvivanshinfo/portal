{{-- @extends('layout') --}}
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

    {{-- @section('content') --}}
    <div class="col py-3">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Register Form</h3>

                                @if (Session::has('success'))
                                    {
                                    <div class="alert alert-primary alert-dismissible fade show">
                                        {{ Session::has('success') }}</div>
                                    }
                                @endif

                                <form method="post" action="{{ route('registrationPost') }}">

                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            aria-describedby="emailHelp" placeholder="Enter First name" value="">
                                        @if ($errors->has('fname'))
                                            <span class=" text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last name</label>
                                        <input type="text" class="form-control" id="lname" name="lname"
                                            aria-describedby="emailHelp" placeholder="Enter Last name" value="">
                                        @if ($errors->has('lname'))
                                            <span class="text-danger">{{ $errors->first('lname') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            aria-describedby="emailHelp" placeholder="Enter Last name">
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>


                                    <!-- Email input -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            aria-describedby="emailHelp" placeholder="Enter email" value="">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    {{-- password --}}
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" value="">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>


                                    <input type="hidden" class="" id="_token" name="_token"
                                        value="{{ csrf_token() }}">

                                    <button type="submit" name="submit"
                                        class="btn btn-primary mt-5 ml-5">Submit</button>



                                </form>

                                <a class="mt-2" href="{{ route('login') }}">Allready hvae an account...?Click here to
                                    login</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>

</html>

{{-- @endsection --}}
