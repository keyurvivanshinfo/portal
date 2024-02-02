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

    <title>forgot password</title>
</head>

<body>

    {{-- @extends('layout') --}}


    {{-- @section('content') --}}
    <div class="col py-3">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Reset password Form</h3>


                                @if (Session::has('success'))
                                    <div class='alert alert-sucess'>{{ Session::get('success') }}</div>
                                @endif



                                <form method="post" action="{{route('resetPasswordPost')}}">
                                    {!! csrf_field() !!}
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Enter new password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" value="{{old('password')}}">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                            placeholder="Password" value="{{old('confirmPassword')}}">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('confirmPassword') }}</span>
                                        @endif
                                    </div>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="email" value="{{ $email }}">
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <button type="submit" name="submit"
                                        class="btn btn-primary mt-5 ml-5">Submit</button>
                                        
                                    </form>
                                    
                                    <a class="mt-2" href="{{ route('registration') }}"> <button class="btn btn-success mt-5 ml-5">Register</button></a>
                                    <a class="mt-2" href="{{ route('forgotPassword') }}"> <button class="btn btn-danger mt-5 ml-5">Forgot Password</button></a>
                                    

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- @endsection --}}


</body>

</html>
