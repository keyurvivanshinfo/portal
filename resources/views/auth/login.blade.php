@extends('layout')


@section('content')
    <div class="col py-3">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Login Form</h3>


                                @if (Session::has('success'))
                                    <div class='alert alert-sucess'>{{ Session::get('success') }}</div>
                                @endif


                                <form method="post" action="{{ route('login.post') }}">
                                    {!! csrf_field() !!}






                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Enter email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <button type="submit" name="submit" class="btn btn-primary mt-5 ml-5">Submit</button>

                                </form>

                            <a class="mt-2" href="{{route('registration')}}">Dont hvae an account...?Click here to Register</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
